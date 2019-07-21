 <div class="modal-body p-4">

        <div  class="container">
                <div class="row">
                    <div class="col-lg-6">

                         <img src="{{ $product->photos }}" alt="photo">

                    </div>



        <div class="col-lg-6">
            <!-- Product description -->
            <div class="product-description-wrapper">
                <!-- Product title -->
                <h2 class="product-title">
                    {{ $product->name }}
                </h2>

                <div class="row no-gutters pb-3" id="chosen_price_div">
                        {{-- <div class="col-2">
                            <div class="product-description-label">{{__('Total Price')}}:</div>
                        </div> --}}

                            <div class="product-price">
                                <h2>
                                   unit price: <input id="chosen_price" type="number" value="{{ $product->unit_price }}">
                                </h2>
                            </div>

                </div>

                <div class="row no-gutters mt-4">
                    <div class="col-4">
                        <div class="product-description-label">{{__('Price')}}:</div>
                    </div>
                    <div class="col-8">
                        <div class="product-price-old">
                            <del>
                                {{ home_price($product->id) }}
                                <span>/{{ $product->unit }}</span>
                            </del>
                        </div>
                    </div>
                </div>

                <div class="row no-gutters mt-3">
                    <div class="col-4">
                        <div class="product-description-label">{{__('Discount Price')}}:</div>
                    </div>
                    <div class="col-8">
                        <div class="product-price">
                            <strong>
                                {{ home_discounted_price($product->id) }}
                            </strong>
                            <span class="piece">/{{ $product->unit }}</span>
                        </div>
                    </div>
                </div>

                <hr>

                <form id="option-choice-form" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    @foreach (json_decode($product->choice_options) as $key => $choice)

                    <div class="row no-gutters">
                        <div class="col-4">
                            <div class="product-description-label">{{ $choice->title }}:</div>
                        </div>
                        <div class="col-8">
                            <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                    @foreach ($choice->options as $key => $option)
                                        <li>
                                            <input type="radio" id="{{ $choice->name }}-{{ $option }}" name="{{ $choice->name }}" value="{{ $option }}">
                                            <label for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                        </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>

                    @endforeach

                    @if(count(json_decode($product->colors)) > 0)
                        <div class="row no-gutters">
                            <div class="col-4">
                                <div class="product-description-label">{{__('Color')}}:</div>
                            </div>
                            <div class="col-8">
                                <ul class="list-inline checkbox-color mb-1">
                                    @foreach (json_decode($product->colors) as $key => $color)
                                        <li>
                                            <input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color" value="{{ $color }}">
                                            <label style="background: {{ $color }};" for="{{ $product->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <hr>

                    <!-- Quantity + Add to cart -->
                    <div class="row no-gutters">
                        <div class="col-4">
                            <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                        </div>
                        <div class="col-8">
                                <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" name="quantity" value="1" type="number">
                                </div><!-- End .product-single-qty -->
                        </div>

                    </div>


                    <hr>


                    <div class="row no-gutters pb-3" id="chosen_price_div">
                        <div class="col-2">
                           <div class="product-description-label">{{__('Total Price')}}:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="total_price">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="d-table width-100 mt-3">
                    <div class="d-table-cell">
                        <!-- Add to cart button -->
                        <button type="button" class="btn btn-danger btn-icon-left" onclick="addToCart()">
                            <i class="icon ion-bag"></i> {{__('Add to cart')}}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
$(".horizontal-quantity").TouchSpin({
                verticalbuttons: !1,
                buttonup_txt: "",
                buttondown_txt: "",
                buttondown_class: "btn btn-outline btn-down-icon",
                buttonup_class: "btn btn-outline btn-up-icon",
                initval: 1,
                min: 1
            });

    $(".horizontal-quantity").change(function(){
        getVariantPrice();
    });

    cartQuantityInitialize();
    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });
</script>
