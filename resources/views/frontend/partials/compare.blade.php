



    <a href="{{ route('compare') }}" class="nav-box-link">
        <i class="la la-refresh d-inline-block nav-box-icon"></i>
        <span class="nav-box-text d-none d-lg-inline-block">{{__('Compare')}}</span>
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

            </div>
        </div><!-- End .dropdownmenu-wrapper -->
    </div><!-- End .dropdown-menu -->
    @endif



