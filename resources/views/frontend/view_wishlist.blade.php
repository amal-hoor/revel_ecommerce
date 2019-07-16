@extends('frontend.layouts.master')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Wishlist')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('wishlists.index') }}">{{__('Wishlist')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist items -->

                        <div class="row shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-4">
                            @foreach ($wishlists as $key => $wishlist)
                                <div class="col-6" id="wishlist_{{ $wishlist->id }}">
                                    <div class="card card-product mb-3 product-card-2">
                                        <div class="card-body p-3">
                                            <div class="card-image">
                                                <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block" style="background-image:url('{{ asset($wishlist->product->thumbnail_img) }}');">
                                                </a>
                                            </div>

                                            <h2 class="heading heading-6 strong-600 mt-2 text-truncate-2">
                                                <a href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a>
                                            </h2>
                                            <div class="star-rating star-rating-sm mb-1">
                                                {{ renderStarRating($wishlist->product->rating) }}
                                            </div>
                                            <div class="mt-2">
                                                <div class="price-box">
                                                    @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($wishlist->product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($wishlist->product->id) }}</span>
                                                </div>
                                            </div>
                                            <form id="option-choice-form" method="POST">
                                                    @php
                                                    $product=$wishlist->product;
                                                  @endphp
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $wishlist->product->id }}">

                                                    @foreach (json_decode($product->choice_options) as $key => $choice)
                                                        <div class="product-filters-container">
                                                            <div class="product-single-filter">
                                                                <label>{{ $choice->title }}:</label>
                                                                <ul class="config-swatch-list">
                                                                    @foreach ($choice->options as $key => $option)
                                                                        <li>
                                                                            <input type="radio" id="{{ $choice->name }}-{{ $option }}"
                                                                                   name="{{ $choice->name }}" value="{{ $option }}"
                                                                                   @if($key == 0) checked @endif>
                                                                            <label for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div><!-- End .product-single-filter -->
                                                        </div><!-- End .product-filters-container -->
                                                    @endforeach
                                                    @if (count(json_decode($product->colors)) > 0)
                                                        <div class="product-filters-container">
                                                            <div class="product-single-filter">
                                                                <label>{{__('Color')}}:</label>
                                                                <ul class="config-swatch-list">
                                                                    @foreach (json_decode($product->colors) as $key => $color)
                                                                        <li class="color @if($key==0) active @endif">
                                                                            <a href="javascript:void(0)"
                                                                               style="background-color: {{ $color }};"></a>
                                                                            <input type="radio" id="{{ $product->id }}-color-{{ $key }}"
                                                                                   name="color" style="display: none"
                                                                                   value="{{ $color }}" @if($key == 0) checked @endif>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div><!-- End .product-single-filter -->
                                                        </div><!-- End .product-filters-container -->
                                                    @endif

                                                    <style>
                                                        .price{
                                                            color: #21293c;
                                                            font: 600 1.5rem/1.1 "Open Sans", sans-serif;
                                                            letter-spacing: .005em;
                                                            text-transform: uppercase;
                                                            margin-right: 1.3rem;
                                                            margin-bottom: 0;

                                                        }
                                                    </style>
                                                    <div class="row form-group no-gutters pb-3 d-none" id="chosen_price_div">
                                                        <div class="input-group number-input-wrapper ">
                                                            <span class="input-group-addon price" >{{__('Total Price')}}</span>
                                                            <div class="product-price" style="padding-left: 5px">
                                                                <strong id="chosen_price">

                                                                </strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>
                                        <div class="card-footer p-3">
                                            <div class="product-buttons">
                                                <div class="row align-items-center">
                                                    <div class="col-2">
                                                        <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                                                            <i class="la la-close">__</i>
                                                        </a>
                                                    </div>
                                                    <div class="col-10">

                                                        <button type="button" class="btn btn-block btn-base-1 btn-circle btn-icon-left" onclick="showAddToCartModal({{ $product->id }})">
                                                            <i class="la la-shopping-cart mr-2">++</i>{{__('Add to cart')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $wishlists->links() }}
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been renoved from wishlist');
            })
        }
    </script>
@endsection
