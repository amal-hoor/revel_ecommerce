<div  class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $total = 0;
                            @endphp
                            @foreach (Session::get('cart') as $key => $cartItem)
                                @php
                                $product = \App\Product::find($cartItem['id']);
                                $total = $total + $cartItem['price']*$cartItem['quantity'];
                                $product_name_with_choice = $product->name;
                                if(isset($cartItem['color'])){
                                    $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                }
                                foreach (json_decode($product->choice_options) as $choice){
                                    $str = $choice->name; // example $str =  choice_0
                                    $product_name_with_choice .= ' - '.$cartItem[$str];
                                }
                                @endphp
                                   <tr class="product-row">
                                        <td class="product-col">
                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="{{ asset($product->thumbnail_img) }}">
                                                </a>

                                            </figure>
                                        </td>



                                        <td class="">
                                                <span class="pr-3 d-block">{{ single_price($cartItem['price']) }}</span>
                                        </td>

                                        <td class="product-quantity d-none d-md-table-cell">


                                                    <input class="vertical-quantity form-control" type="text" name="quantity[{{ $key }}]" class="form-control input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="10" onchange="updateQuantity({{ $key }}, this)">


                                        </td>

                                        <td class="product-total">
                                                <span>{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                                        </td>


                                        <td class="product-remove">
                                                <a href="#" onclick="removeFromCartView(event, {{ $key }})" class="text-right pl-4">
                                                    <i class="la la-remove"></i>
                                                </a>
                                        </td>
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="4" class="clearfix">
                                    <div class="float-left">
                                        <a href="{{route('products')}}" class="btn btn-outline-secondary">Continue Shopping</a>
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="#" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                        <a href="#" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->

                <div class="cart-discount">
                    <h4>Apply Discount Code</h4>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"  required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                            </div>
                        </div><!-- End .input-group -->
                    </form>
                </div><!-- End .cart-discount -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">

                @include('frontend.partials.cart_summary')
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div>

<script type="text/javascript">
    cartQuantityInitialize();
</script>
