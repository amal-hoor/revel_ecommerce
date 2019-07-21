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