<li class="dropdown">
  <a data-toggle="dropdown" data-target="#" href="/page.html">
    {{ trans("frontend.$frontendNumber.navbar.T12") }} <span class="caret"></span>
  </a>
  <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
    @foreach($publicProdcutsCats[0] as $cat1)
      <li class="dropdown-submenu">
        <?php
          $cat_href1 = implode('-', explode(' ', $cat1->name)) ;
          $category_code1 = $hashids->encode([1, $cat1->id]);
          $products_count1 = App\Models\Product\Product::users_roles()->nested_categories(1, $cat1->id)->count();
        ?>
        <a tabindex="-1" href="/products/category/{{$category_code1}}/{{$cat_href1}}">{{ $cat1->name }} ({{ $products_count1 }})</a>
        <ul class="dropdown-menu">
          @foreach($publicProdcutsCats[1] as $cat2)
            @if($cat2->related_id == $cat1->id)
              <li class="dropdown-submenu">
                <?php
                  $cat_href2 = implode('-', explode(' ', $cat2->name));
                  $category_code2 = $hashids->encode([2, $cat2->id]);
                ?>
                <a tabindex="-1" href="/products/category/{{$category_code2}}/{{$cat_href2}}">{{ $cat2->name }}</a>
                <ul class="dropdown-menu">
                  @foreach($publicProdcutsCats[2] as $cat3)
                    @if($cat3->related_id == $cat2->id)
                      <li class="dropdown-submenu">
                        <?php
                          $cat_href3 = implode('-', explode(' ', $cat3->name));
                          $category_code3 = $hashids->encode([3, $cat3->id]);
                        ?>
                        <a tabindex="-1" href="/products/category/{{$category_code3}}/{{$cat_href3}}">{{ $cat3->name }}</a>
                        <ul class="dropdown-menu">
                          @foreach($publicProdcutsCats[3] as $cat4)
                            @if($cat4->related_id == $cat3->id)
                              <li>
                                <?php
                                  $cat_href4 = implode('-', explode(' ', $cat4->name));
                                  $category_code4 = $hashids->encode([4, $cat4->id]);
                                ?>
                                <a tabindex="-1" href="/products/category/{{$category_code4}}/{{$cat_href4}}">{{ $cat4->name }}</a>
                              </li>
                            @endif
                          @endforeach
                        </ul>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </li>
            @endif
          @endforeach
        </ul>
      </li>
    @endforeach
  </ul>
</li>