<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logic\Product\ProductRepository;

use App\Models\Product\Tag;
use App\Models\Product\TagRelationship;

use Hashids\Hashids;
use Validator;
use Response;

class tagsController extends Controller
{

	public function __construct(){
        $this->middleware('admin_function:tags_controls');
    }

    public function index(){
    	$tags = Tag::orderBy('id', 'DESC')->paginate(20);

        return view('back.products.tags.view')
            ->withTags($tags);
    }

    public function store(Request $request){
        $input = (object) $request->all();
        $validator = Validator::make((array) $input, Tag::$rules);

        if ($validator->fails()) {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);
        }

        $productTag = new Tag;
        $productTag->tag_name = $input->tag_name;
        $productTag->save();

        return Response::json([
            'error' => false,
            'code' => 200,
            'tag_name' => $input->tag_name
        ], 200);
    }

    public function show($tagName) {
        $tag_id = Tag::where("tag_name", $tagName)->value('id');
        $tag = Tag::find($tag_id);

        $redirectFrom = 'tags';
        $caller = $tag->products();
        $products = $caller->paginate(10);

        $productsIds = $caller->lists('products.id');
        $productsIds = trim($productsIds, '[]');
        $productsIds = explode(',', $productsIds);

        $hashids = new Hashids('', 0, '13524796abogmtndlvt');
        $productsIds = $hashids->encode($productsIds);

        $productRepository = new ProductRepository;
        $products = $productRepository->optimizeIndexProductContoller($products);

        return view("back.products.view")->with(compact(
            'products', 'redirectFrom', 'productsIds'
        ));
    }

    public function update($id, Request $request){
    	$input = (object) $request->all();

        $tag = Tag::find($id);
        $tag->tag_name = $input->tag_name;
        $tag->save();

        return $tag->tag_name;
    }

    public function destroy($id, Request $request){
    	$input = (object) $request->all();

    	Tag::destroy($id);

    	if($input->delete_products) 
            TagRelationship::where('tag_id', $id)->delete();

    	return back();
    } 

    public function viewByKeyword(Request $request){
        $keyword = $request->keyword;
        $appended_ids = (array) json_decode($request->appended_ids);

        if($keyword != ""){
            $tags = Tag::where("tag_name", "like", $keyword."%")
                ->whereNotIn('id', $appended_ids)
                ->get();

            return json_encode($tags);
        } 
    }

    public function viewAppendModal(){
        return view("back.products.tags.modals.append");
    }
}
