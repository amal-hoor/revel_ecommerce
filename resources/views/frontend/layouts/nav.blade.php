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
                    <a href="#"><img src="{{asset('assets/images/flags/en.png')}}" alt="England flag">ENGLISH</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#"><img src="{{asset('assets/images/flags/en.png')}}" alt="England flag">ENGLISH</a></li>
                            <li><a href="#"><img src="{{asset('assets/images/flags/fr.png')}}" alt="France flag">FRENCH</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->

                <div class="dropdown compare-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-retweet"></i> Compare (2)
                    </a>

                    <div class="dropdown-menu" >
                        <div class="dropdownmenu-wrapper">
                            <ul class="compare-products">
                                <li class="product">
                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                    <h4 class="product-title"><a href="product.html">Lady White Top</a></h4>
                                </li>
                                <li class="product">
                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                    <h4 class="product-title"><a href="product.html">Blue Women Shirt</a></h4>
                                </li>
                            </ul>

                            <div class="compare-actions">
                                <a href="#" class="action-link">Clear All</a>
                                <a href="#" class="btn btn-primary">Compare</a>
                            </div>
                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <p class="welcome-msg">Default welcome msg! </p>

                <div class="header-dropdown dropdown-expanded">
                    <a href="#">Links</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="my-account.html">MY ACCOUNT </a></li>
                            <li><a href="#">DAILY DEAL</a></li>
                            <li><a href="#">MY WISHLIST </a></li>
                            <li><a href="blog.html">BLOG</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="#" class="login-link">LOG IN</a></li>
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
                    <form action="#" method="get">
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
                    <div class="nav-cart-box dropdown" id="cart_items">
                        <a href="" class="nav-box-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
                            <span class="nav-box-text d-none d-xl-inline-block">{{__('Cart')}}</span>
                            @if(Session::has('cart'))
                                <span class="nav-box-number">{{ count(Session::get('cart'))}}</span>
                            @else
                                <span class="nav-box-number">0</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right px-0">
                            <li>
                                <div class="dropdown-cart px-0">
                                    @if(Session::has('cart'))
                                        @if(count($cart = Session::get('cart')) > 0)
                                            <div class="dc-header">
                                                <h3 class="heading heading-6 strong-700">{{__('Cart Items')}}</h3>
                                            </div>
                                            <div class="dropdown-cart-items c-scrollbar">
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach($cart as $key => $cartItem)
                                                    @php
                                                        $product = \App\Product::find($cartItem['id']);
                                                        $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                    @endphp
                                                    <div class="dc-item">
                                                        <div class="d-flex align-items-center">
                                                            <div class="dc-image">
                                                                <a href="{{ route('product', $product->slug) }}">
                                                                    <img src="{{ asset($product->thumbnail_img) }}" class="img-fluid" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="dc-content">
                                                                <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                                                    <a href="{{ route('product', $product->slug) }}">
                                                                        {{ __($product->name) }}
                                                                    </a>
                                                                </span>

                                                                <span class="dc-quantity">x{{ $cartItem['quantity'] }}</span>
                                                                <span class="dc-price">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                                                            </div>
                                                            <div class="dc-actions">
                                                                <button onclick="removeFromCart({{ $key }})">
                                                                    <i class="la la-close"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="dc-item py-3">
                                                <span class="subtotal-text">{{__('Subtotal')}}</span>
                                                <span class="subtotal-amount">{{ single_price($total) }}</span>
                                            </div>
                                            <div class="py-2 text-center dc-btn">
                                                <ul class="inline-links inline-links--style-3">
                                                    <li class="pr-3">
                                                        <a href="{{ route('cart') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1">
                                                            <i class="la la-shopping-cart"></i> {{__('View cart')}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('checkout.shipping_info') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1 light-text">
                                                            <i class="la la-mail-forward"></i> {{__('Checkout')}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
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
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="active"><a href="index-2.html">Home</a></li>



                        @foreach (\App\Category::all()->take(11) as $key => $category)
                            <li>
                            <a href="category.html" class="sf-with-ul">{{ __($category->name) }}</a>
                                @if(count($category->subcategories)>0)
                                    <div class="megamenu megamenu-fixed-width">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <ul>
                                                            @foreach ($category->subcategories as $subcategory)
                                                                <li><a href="{{ route('products.subcategory',$subcategory->id)}}">_{{ __($subcategory->name) }}<span class="tip tip-hot">Hot!</span></a></li>

                                                                        @foreach ($subcategory->subsubcategories as $subsubcategory)
                                                                        <li><a href="{{ route('products.subsubcategory', $subsubcategory->id) }}">__{{ __($subsubcategory->name) }}</a></li>
                                                                        @endforeach

                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach



                    <li class="float-right buy-effect"><a href="#"><span>Buy Porto!</span></a></li>
                    <li class="float-right"><a href="#">Special Offer!</a></li>
                </ul>
            </nav>
        </div><!-- End .header-bottom -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->
