<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left header-dropdowns">
                <div class="header-dropdown">
                    <a href="#">USD</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">EUR</a></li>
                            <li><a href="#">USD</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->

                <div class="header-dropdown">
                        <li class="dropdown" id="lang-change">
                                @php
                                    if(Session::has('locale')){
                                        $locale = Session::get('locale', Config::get('app.locale'));
                                    }
                                    else{
                                        $locale = 'en';
                                    }
                                @endphp
                                <a href="" class="dropdown-toggle top-bar-item" data-toggle="dropdown">
                                    <img src="{{ asset('frontend/images/icons/flags/'.$locale.'.png') }}" class="flag"><span class="language">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach (\App\Language::all() as $key => $language)
                                        <li class="dropdown-item @if($locale == $language) active @endif">
                                            <a href="#" data-flag="{{ $language->code }}"><img src="{{ asset('frontend/images/icons/flags/'.$language->code.'.png') }}" class="flag"><span class="language">{{ $language->name }}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                        </li>


                </div><!-- End .header-dropown -->

                <div class="dropdown compare-dropdown compare">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                         <i class="icon-retweet"></i>
                        <span class="nav-box-text d-none d-xl-inline-block">{{__('Compare')}}</span>
                        @if(Session::has('compare'))
                            <span class="nav-box-number">{{ count(Session::get('compare'))}}</span>
                        @else
                            <span class="nav-box-number">0</span>
                        @endif
                    </a>

                    @if(Session::has('compare'))
                    <div class="dropdown-menu compare_items_sidenav" >
                        <div class="dropdownmenu-wrapper">
                            <ul class="compare-products">
                                    @foreach (Session::get('compare') as $key => $item)
                                    @php
                                    $product=App\Product::find($item)
                                    @endphp
                                <li class="product">
                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                    <h4 class="product-title"><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></h4>
                                    <img src="{{$product->photos}}">
                                </li>
                                   @endforeach
                            </ul>

                            <div class="compare-actions">
                                <a href="{{route('compare.reset')}}" class="action-link">Clear All</a>
                                <a href="#" class="btn btn-primary">Compare</a>
                            </div>
                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->
                    @endif
                </div><!-- End .dropdown -->

            </div><!-- End .header-left -->

            <div class="header-right">
                <p class="welcome-msg">Default welcome msg! </p>

                <div class="header-dropdown dropdown-expanded">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            @auth
                            <li>
                                <a href="{{ route('dashboard') }}" class="top-bar-item">{{__('My Profile')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="top-bar-item">{{__('Logout')}}</a>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('user.login') }}" class="top-bar-item">{{__('Login')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('user.registration') }}" class="top-bar-item">{{__('Registration')}}</a>
                            </li>
                            @endauth
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->


            </div><!-- End .header-right -->

        </div><!-- End .container -->
    </div><!-- End .header-top -->


    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <a href="index-2.html" class="logo">
                    <img src="{{asset('assets/images/logo.png')}}" alt="Porto Logo">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                    <form action="{{ route('search') }}" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                            <div class="select-custom">
                                <select id="cat" name="cat">

                                    <option value="">All Categories</option>
                                    @foreach (\App\Category::all()->take(11) as $key => $category)
                                      <option value="4">{{ __($category->name) }}</option>
                                        @if(count($category->subcategories)>0)

                                            @foreach ($category->subcategories as $subcategory)
                                                <option class="sub-cat-name"><a href="{{ route('products.subcategory', $subcategory->id) }}"> _{{ __($subcategory->name) }}</a></option>

                                                        @foreach ($subcategory->subsubcategories as $subsubcategory)
                                                            <option><a href="{{ route('products.subsubcategory', $subsubcategory->id) }}"> __{{ __($subsubcategory->name) }}</a></option>
                                                       @endforeach
                                            @endforeach

                                        @endif
                                    @endforeach

                                </select>
                            </div><!-- End .select-custom -->


                            <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>


                </div><!-- End .header-search -->
            </div><!-- End .headeer-center -->

            <div class="header-right">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <div class="header-contact">
                    <span>Call us now</span>
                    <a href="tel:#"><strong>+965 45522144</strong></a>
                </div><!-- End .header-contact -->


                <div class="d-inline-block" data-hover="dropdown">
                        <div id="cart_items" class="dropdown cart-dropdown">
                                <a href="" class="nav-box-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
                                        <span class="nav-box-text d-none d-xl-inline-block">{{__('Cart')}}</span>
                                        @if(Session::has('cart'))
                                            <span class="nav-box-number">{{ count(Session::get('cart'))}}</span>
                                        @else
                                            <span class="nav-box-number">0</span>
                                        @endif
                                </a>

                                <div class="dropdown-menu" >
                                    <div class="dropdownmenu-wrapper">
                                        @if(Session::has('cart'))
                                        @if(count($cart = Session::get('cart')) > 0)
                                            <div class="dropdown-cart-header">
                                                    <span class="nav-box-number">{{ count(Session::get('cart'))}}</span>

                                            </div><!-- End .dropdown-cart-header -->
                                        @php
                                            $total = 0;
                                        @endphp
                                         @foreach($cart as $key => $cartItem)
                                            @php
                                                $product = \App\Product::find($cartItem['id']);
                                                $total = $total + $cartItem['price']*$cartItem['quantity'];
                                            @endphp
                                        <div class="dropdown-cart-products">
                                            <div class="product">
                                                <div class="product-details">
                                                    <h4 class="product-title">
                                                            <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                                                    <a href="{{ route('product', $product->slug) }}">
                                                                        {{ __($product->name) }}
                                                                    </a>
                                                                </span>

                                                                <span class="dc-quantity">x{{ $cartItem['quantity'] }}</span>
                                                                <span class="dc-price">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span class="cart-product-qty">1</span>
                                                        x $99.00
                                                    </span>
                                                </div><!-- End .product-details -->

                                                <figure class="product-image-container">
                                                        <a href="{{ route('product', $product->slug) }}">
                                                                <img src="{{ asset($product->thumbnail_img) }}" class="img-fluid" alt="">
                                                        </a>
                                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                                </figure>
                                            </div><!-- End .product -->

                                          @endforeach
                                        </div>

                                        <div class="dropdown-cart-total">
                                            {{-- <span>Total</span> --}}

                                            <span class="subtotal-text">{{__('Subtotal')}}</span>
                                            <span class="subtotal-amount">{{ single_price($total) }}</span>
                                        </div><!-- End .dropdown-cart-total -->

                                        <div class="dropdown-cart-action">
                                                <div class="py-2 text-center">

                                                        <a href="{{ route('cart') }}" class="btn btn-success  text-capitalize px-3 py-1">
                                                                     {{__('View cart')}}
                                                        </a>
                                                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn-danger text-capitalize px-3 py-1 light-text">
                                                                    {{__('Checkout')}}
                                                        </a>
                                                </div>
                                        </div><!-- End .dropdown-cart-total -->
                                    </div><!-- End .dropdownmenu-wrapper -->
                                    @else
                                    <div class="dc-header">
                                            <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                    </div>
                                    @endif
                                    @else
                                    <div class="dc-header">
                                        <h3 class="heading heading-6 strong-700">{{__('Your Cart is empty')}}</h3>
                                    </div>
                                    @endif
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .dropdown -->

                        </div>
                    </div>
                </div>

            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">

            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="active"><a href="{{ route('home') }}">HOME</a></li>

                    @foreach (\App\Category::all()->take(11) as $key => $category)
                        <li>
                            <a href="#" class="sf-with-ul">{{ __($category->name) }}</a>
                            <ul>
                                @if(count($category->subcategories)>0)
                                @foreach ($category->subcategories as $subcategory)

                                        <li><a href="{{ route('products.subcategory',$subcategory->id)}}">_{{ __($subcategory->name) }}<span class="tip tip-hot">Hot!</span></a>
                                            @if(count($subcategory->subsubcategories)>0)
                                            <ul>
                                                @foreach ($subcategory->subsubcategories as $subsubcategory)
                                                <li><a href="{{ route('products.subsubcategory', $subsubcategory->id) }}">__{{ __($subsubcategory->name) }}</a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                @endforeach
                                @endif

                            </ul>
                        </li>
                    @endforeach

                <ul>
            </nav>

        </div><!-- End .header-bottom -->
    </div><!-- End .header-bottom -->

</header><!-- End .header -->
