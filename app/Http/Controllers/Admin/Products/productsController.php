<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;

use App\Logic\Product\ProductRepository;
use App\Logic\Product\InsertConditions;
use App\Logic\Product\Categories;

use App\Models\Product\Product;
use App\Models\Product\Tag;
use App\Models\Product\Image;
use App\Models\Product\Carousel;
use App\Models\Product\Comment;
use App\Models\Product\LiveCarousel;
use App\Models\Product\Category1;

use DB;
use File;
use Image as ImageManager;
use Storage;
use Session;
use Response;
use Validator;

class productsController extends Controller {

    public function __construct(){
        $this->middleware('admin_function:create_products', ['only' => ['create', 'store']]);
        $this->middleware('admin_function:edit_products', ['only' => ['edit', 'update']]);
        $this->middleware('admin_function:delete_products', ['only' => 'destroy']);
        $this->middleware('admin_function:product_live_status', ['only' => 'liveStatus']);
    }

    protected function checkPage($paginate_number)
    {
        $paginate_count = ceil(Product::count() / $paginate_number);

        if(isset($_GET['page']) && $_GET['page'] > $paginate_count)
            return abort(404);
    }

    public function index()
    {
        $paginate_number = 3;
        $this->checkPage($paginate_number);

        $products = Product::orderBy('id', 'DESC')->paginate($paginate_number);

        $productRepository = new ProductRepository;
        $products = $productRepository->optimizeIndexProductContoller($products);

        return view("back.products.view")->with(compact(
            'products', 'SF_price', 'SF_sales'
        ));
    }

    public function create($step_id = NULL)
    {
        if (!isset($step_id)) return redirect(route("admin.products..create")."/step/1");

        $faker = Faker::create();

        switch($step_id){
            case 1:
                Session::forget('products_step1');

                $p_cat1 = Category1::lists('name', 'id');
                return view('back.products.create.steps.1')
                    ->withFaker($faker)
                    ->withP_cat1($p_cat1);
            break;
            case 2:
                if(!Session::has('products_step1'))
                    return abort(404);

                return view('back.products.create.steps.2')
                    ->withFaker($faker);
            break;
            default:
                return abort(404);
        }
    }

    public function store($step_id, Request $request)
    {
        $regex = "~^[A-Za-z0-9\(<->:.,%؟?)\s]{1,9999}$~iu";

        switch($step_id){
            case 1:
                $input = (object) $request->all();
                $validator = Validator::make((array) $input, Product::rulesStep1($regex));

                if ($validator->fails())
                    return back()->withErrors($validator)->withInput();

                $product = new Product;
                $product->serial_number = $input->serial_number;
                $product->name = $input->product_name;
                $product->description = $input->product_description;
                $product->price = $input->product_price;
                $product->discount_percentage = $input->discount_percentage;
                $product->category_table_number = $input->category_table_number;
                $product->category_id = $input->category_id;

                $insertConditions = new InsertConditions;
                $insertConditions->isAmountUnlimited($input, $product);
                $insertConditions->isStartViewNow($input, $product);
                $insertConditions->expiresCondition($input, $product);

                $product->save();
                $request->session()->set('products_step1', [
                    'product_id' => $product->id
                ]);

                return redirect(route('admin.products..create').'/step/2');
            break;
            case 2:
                $input = (object) $request->all();
                $validator = Validator::make((array) $input, Product::rulesStep2($regex));

                if ($validator->fails())
                    return back()->withErrors($validator);

                $product = Product::find($input->product_id);

                $product->is_real = 1;
                $product->is_new = $input->is_new;
                $product->is_live = $input->is_live;

                $product->is_payment_on_delivery = $input->is_payment_on_delivery;
                $product->is_payment_by_paypal = $input->is_payment_by_paypal;

                $product->primary_image_id = isset($input->primary_image_id) ? $input->primary_image_id : null;
                $product->primary_carousel_id = isset($input->primary_carousel_id) ? $input->primary_carousel_id : null;

                if($input->is_payment_by_paypal == 0 && $input->is_payment_on_delivery == 0){
                    return back()->withErrors(["Please choose 1 payment method at least."]);
                }

                $products_tags = explode(',', $input->product_tags);

                foreach ($products_tags as $tag) {
                    $isSaveTag = DB::table('products_tags_relationship')->insert([
                        'product_id' => $input->product_id,
                        'tag_id' => $tag
                    ]);

                    if(!$isSaveTag)
                        return back()->withErrors(['Some error in save tags.']);
                }

                $product->timestamps = false;
                $product->save();

                if($input->is_carousel_live) {
                    $liveCarousel = new LiveCarousel;
                    $liveCarousel->product_id = $input->product_id;
                    $liveCarousel->save();
                }

                $request->session()->forget('products_step1');
                $request->session()->flash('flashMessage', [
                    "type" => "success",
                    "content" => trans('admin_panel.ACPP.T45')
                ]);

                if($input->create_again){
                    return redirect(route('admin.products..create').'/step/1');
                } else {
                    return redirect('/admin/products');
                }
            break;
            default:
                return abort(404);
        }
    }

    public function show($id)
    {
    	$product = Product::find($id);

        if($product == null) abort(404);

        $productRepository = new ProductRepository;
        $product = $productRepository->optimizeShowProduct($product);

        $products_tags = $product->tags()->select("products_tags.tag_name")->lists('tag_name');

        return view("back.products.show")->with(compact(
            'product', 'products_tags'
        ));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $product_images = Image::where('parent_id', $product->id)->lists('image_name');
        $product_categories_list = Product::categories_list($product->category_table_number, $product->category_id);

        $productCats = new Categories;
        $product_trueCats = $productCats->getCategories();

        return view("back.products.edit")->with(compact(
            'product', 'product_images', 'product_trueCats', 'product_categories_list'
        ));
    }

    public function update(Request $request, $id)
    {
        $regex = "~^[A-Za-z0-9\(<->:.,%؟?)\s]{1,9999}$~iu";

        $input = (object) $request->all();
        $validator = Validator::make((array) $input, Product::rulesStep1($regex));

        if ($validator->fails())
            return back()->withErrors($validator);

        $product = Product::find($id);
        $product->serial_number = $input->serial_number;
        $product->name = $input->product_name;
        $product->description = $input->product_description;
        $product->price = $input->product_price;
        $product->discount_percentage = $input->discount_percentage;
        $product->category_table_number = $input->category_table_number;
        $product->category_id = $input->category_id;
        $product->is_payment_on_delivery = $input->is_payment_on_delivery;
        $product->is_payment_by_paypal = $input->is_payment_by_paypal;

        $insertConditions = new InsertConditions;
        $insertConditions->isAmountUnlimited($input, $product);
        $insertConditions->isStartViewNow($input, $product);
        $insertConditions->expiresCondition($input, $product);

        if($input->is_payment_by_paypal == 0 && $input->is_payment_on_delivery == 0){
            return back()->withErrors(["Please choose 1 payment method at least."]);
        }

        $product->save();

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "product was updated successfully."
        ]);

        return redirect("/admin/products/$id");
    }

    public function destroy($id)
    {
        $carousel_list = Carousel::where("parent_id", $id)->lists('carousel_name');
        $images_list = Image::where("parent_id", $id)->lists('image_name');

    	Product::destroy($id);
        Carousel::where("parent_id", $id)->delete();
        Image::where("parent_id", $id)->delete();
        LiveCarousel::where('product_id', $id)->delete();

        foreach ($carousel_list as $name) {
            File::delete("uploaded/products/carousel_gallery/$name");
        }

        foreach ($images_list as $name) {
            File::delete("uploaded/products/images/full_size/$name");
            File::delete("uploaded/products/images/icon_size/$name");
        }

    	return back();
    }

    public function liveStatus(Request $request){
        $input = (object) $request->all();

        $product = Product::find($input->product_id);

        if($input->status == 1){
            $product->is_live = 0;
            $status = 0;
        } else {
            $product->is_live = 1;
            $status = 1;
        }

        $product->save();
        return json_encode($status);
    }

    public function isNewStatus(Request $request){
        $input = (object) $request->all();

        $product = Product::find($input->product_id);

        if($input->status == 1){
            $product->is_new = 0;
            $status = 0;
        } else {
            $product->is_new = 1;
            $product->new_status_time = time(); // reset time controller
            $status = 1;
        }

        $product->save();

        return json_encode($status);
    }
}
