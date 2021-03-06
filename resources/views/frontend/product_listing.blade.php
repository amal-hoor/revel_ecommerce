@extends('frontend.layouts.master')


@section('content')
    <div class="container">
    <div class="breadcrumb-area">

            <div class="row">
                <div class="col-3">
                    <ul class="list">
                        <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                        <li><a href="{{ route('products') }}">{{__('All Categories')}}</a></li>
                        @if(isset($category_id))
                            <li class="list-item"><a href="{{ route('products.category', $category_id) }}">{{ \App\Category::find($category_id)->name }}</a><i class="fal fa-sign-in"></i></li>
                        @endif
                        @if(isset($subcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->id) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>
                            <li class="list-item"><a href="{{ route('products.subcategory', $subcategory_id) }}">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>
                        @endif
                        @if(isset($subsubcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->id) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                            <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->id) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                            <li class="list-item"><a href="{{ route('products.subsubcategory', $subsubcategory_id) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
    </div>


    <section class="gry-bg py-4">

            <div class="row">
                <div class="col-xl-3 d-none d-xl-block">

                    <div class="bg-white sidebar-box mb-3">
                        <div class="box-title text-center">
                            <h2>
                            {{__('Categories')}}
                            </h2>
                        </div>
                        <div class="">
                            <div class="category-accordion">
                                @foreach (\App\Category::all() as $key => $category)
                                    <div class="single-category breadcrumb-area">
                                        <ul class="list">
                                           <li>
                                               {{--<button class="btn w-100" type="button" data-toggle="collapse" data-target="#category-{{ $key }}" aria-expanded="true">--}}
                                                <a href="" data-toggle="collapse" data-target="#category-{{ $key }}">{{ __($category->name) }}<i class="fas fa-arrow-to-right"></i></a>
                                               {{--</button>--}}
                                           </li>
                                        </ul>

                                        <div id="category-{{ $key }}" class="collapse">
                                            @if($category->subcategories)
                                            @foreach ($category->subcategories as $key2 => $subcategory)
                                                <div class="single-sub-category">
                                                    {{--<button class="btn w-100 sub-category-name" type="button" data-toggle="collapse" data-target="#subCategory-{{ $key }}-{{ $key2 }}" aria-expanded="true">--}}
                                                    <ul class="list ml-4">
                                                       <li><a href="" data-toggle="collapse" data-target="#subCategory-{{ $key }}-{{ $key2 }}">{{ __($subcategory->name) }}</a></li>
                                                    </ul>
                                                    {{--</button>--}}
                                                    @if($subcategory->subsubcategories)
                                                    <div id="subCategory-{{ $key }}-{{ $key2 }}" class="collapse">
                                                        <ul class="list ml-5">
                                                            @foreach ($subcategory->subsubcategories as $key3 => $subsubcategory)
                                                                <li><a href="{{ route('products.subsubcategory', $subsubcategory->id) }}">{{ __($subsubcategory->name) }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif

                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="bg-white sidebar-box mb-3">
                        <div class="box-content">
                            <div class="range-slider-wrapper mt-3">
                                <!-- Range slider container -->
                                <div id="input-slider-range" data-range-value-min="{{ filter_products(\App\Product::all())->min('unit_price') }}" data-range-value-max="{{ filter_products(\App\Product::all())->max('unit_price') }}"></div>

                                <!-- Range slider values -->
                                <div class="row">
                                    <div class="col-6">
                                        <span class="range-slider-value value-low"
                                            @if (isset($min_price))
                                                data-range-value-low="{{ $min_price }}"
                                            @elseif($products->min('unit_price') > 0)
                                                data-range-value-low="{{ $products->min('unit_price') }}"
                                            @else
                                                data-range-value-low="0"
                                            @endif
                                            id="input-slider-range-value-low">
                                    </div>

                                    <div class="col-6 text-right">
                                        <span class="range-slider-value value-high"
                                            @if (isset($max_price))
                                                data-range-value-high="{{ $max_price }}"
                                            @elseif($products->max('unit_price') > 0)
                                                data-range-value-high="{{ $products->max('unit_price') }}"
                                            @else
                                                data-range-value-high="0"
                                            @endif
                                            id="input-slider-range-value-high">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <!-- <div class="bg-white"> -->
                        <div class="brands-bar row no-gutters pb-3 bg-white p-3">
                            <div class="col-11">
                                <div class="brands-collapse-box" id="brands-collapse-box">
                                    <ul class="inline-links">
                                        @php
                                            $brands = array();
                                        @endphp
                                        @if(isset($subsubcategory_id))
                                            @php
                                                foreach (json_decode(\App\SubSubCategory::find($subsubcategory_id)->brands) as $brand) {
                                                    if(!in_array($brand, $brands)){
                                                        array_push($brands, $brand);
                                                    }
                                                }
                                            @endphp
                                        @elseif(isset($subcategory_id))
                                            @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key => $subsubcategory)
                                                @php
                                                    foreach (json_decode($subsubcategory->brands) as $brand) {
                                                        if(!in_array($brand, $brands)){
                                                            array_push($brands, $brand);
                                                        }
                                                    }
                                                @endphp
                                            @endforeach
                                        @elseif(isset($category_id))
                                            @foreach (\App\Category::find($category_id)->subcategories as $key => $subcategory)
                                                @foreach ($subcategory->subsubcategories as $key => $subsubcategory)
                                                    @php
                                                        foreach (json_decode($subsubcategory->brands) as $brand) {
                                                            if(!in_array($brand, $brands)){
                                                                array_push($brands, $brand);
                                                            }
                                                        }
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                        @else
                                            @php
                                                foreach (\App\Brand::all() as $key => $brand){
                                                    if(!in_array($brand->id, $brands)){
                                                        array_push($brands, $brand->id);
                                                    }
                                                }
                                            @endphp
                                        @endif

                                    </ul>
                                </div>
                            </div>

                        </div>

                        <form class="" id="search-form" action="{{ route('search') }}" method="GET">
                            @isset($category_id)
                                <input type="hidden" name="category_id" value="{{ $category_id }}">
                            @endisset
                            @isset($subcategory_id)
                                <input type="hidden" name="subcategory_id" value="{{ $subcategory_id }}">
                            @endisset
                            @isset($subsubcategory_id)
                                <input type="hidden" name="subsubcategory_id" value="{{ $subsubcategory_id }}">
                            @endisset

                            <div class="sort-by-bar row no-gutters bg-white mb-3 px-3">
                                <div class="col-lg-4 col-md-5">
                                    <div class="sort-by-box">
                                        <div class="form-group">
                                            <label>{{__('Search')}}</label>
                                            <div class="search-widget">
                                                <input class="form-control input-lg" type="text" name="q" placeholder="{{__('Search products')}}" @isset($query) value="{{ $query }}" @endisset>
                                                {{-- <button type="submit" class="btn-inner">
                                                    <i class="fa fa-search"></i>
                                                </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 offset-lg-1">
                                    <div class="row no-gutters">
                                        <div class="col-4">
                                            <div class="sort-by-box px-1">
                                                <div class="form-group">
                                                    <label>{{__('Sort by')}}</label>
                                                    <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                                        <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{__('Newest')}}</option>
                                                        <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{__('Oldest')}}</option>
                                                        <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{__('Price low to high')}}</option>
                                                        <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{__('Price high to low')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="min_price" value="">
                            <input type="hidden" name="max_price" value="">
                        </form>
                        <!-- <hr class=""> -->
                        <div class="products-box-bar p-3 bg-white">
                            <div class="row sm-no-gutters gutters-5">
                                @foreach ($products as $key => $product)
                                    <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-6">
                                        <div class="card mb-2">

                                            <figure class="card-img-top">
                                                {{-- <a href="{{ route('product', $product->slug) }}" class="product-image d-block" style="background-image:url('{{ asset($product->thumbnail_img) }}');">
                                                </a> --}}
                                            <a href="{{ route('product', $product->slug) }}"><img src="{{asset($product->thumbnail_img)}}"></a>

                                            </figure>
                                            <div class="product-details text-center">
                                                <h2 class="product-title text-truncate mb-0">
                                                    <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                                </h2>
                                                <div class="star-rating star-rating-sm mt-1 mb-2">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                                <div class="price-box">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <span class="old-product-price strong-300">{{ home_base_price($product->id) }}</span>
                                                    @endif
                                                    <span class="product-price strong-300"><strong>{{ home_discounted_base_price($product->id) }}</strong></span>
                                                </div><!-- End .price-box -->

                                        <div class="card-footer">
                                                    {{--<button class="paction add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">--}}
                                                        {{--<i class="la la-heart-o"></i>--}}
                                                    {{--</button>--}}

                                                    {{--<button type="button" class="paction add-cart btn btn-base-1 btn-circle btn-icon-left" onclick="showAddToCartModal({{ $product->id }})">--}}
                                                        {{--<i class="fa la la-shopping-cart mr-0 mr-sm-2"></i><span class="d-none d-sm-inline-block">{{__('Add to cart')}}</span>--}}
                                                    {{--</button>--}}

                                                    {{--<button class="paction add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">--}}
                                                        {{--<i class="la la-refresh"></i>--}}
                                                    {{--</button>--}}

                                            <div class="product-action">
                                                <a href="#" class="paction add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                    <span>Add to Wishlist</span>
                                                </a>

                                                <a href="#" class="paction add-cart" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})">
                                                    <span>Add to Cart</span>
                                                </a>

                                                <a href="#" class="paction add-compare" id="compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                    <span>Add to Compare</span>
                                                </a>

                                            </div><!-- End .product-action -->
                                                </div><!-- End .product-action -->
                                            </div><!-- End .product-details -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
@endsection
