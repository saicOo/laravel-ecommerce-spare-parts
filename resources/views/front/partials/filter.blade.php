<div class="col-12 col-sm-12 col-md-12 col-lg-3 sidebar filterbar order-2 order-lg-0 order-md-2 order-sm-2">
    <div class="closeFilter d-block"><i class="cps cp-times"></i></div>
    <div class="sidebar-filters">
        <div class="shopby-title text-uppercase">
            <h3>{{$setting->name}}</h3>
        </div>
        <!--Category Block-->
        <div class="block clearfix block-categories">
            <div class="block-title">
                <h3>@lang('site.categories')</h3>
            </div>
            <div class="block-content">
                <ul class="items">
                    @foreach ($primary_categories as $primary_category)
                        <li class="lvl-1 sub-level"><a href="#;">{{ $primary_category->name }}</a>
                            <ul class="sublinks">
                                @foreach ($primary_category->subCategories as $sub_category)
                                    <li class="level2" ><a href="javascript:void(0)" class="filter-category" data-category="{{$sub_category->id}}" >{{ $sub_category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--End Category Block-->

        <!--Price Filter Block-->
        <div class="block filterBox filter-widget">
            <div class="block-title">
                <h3>@lang('site.price')</h3>
            </div>
            <form action="#" method="post" class="price-filter filterDD mt-3">
                <div id="slider-range"
                    class="mt-2 ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div><span
                        class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span><span
                        class="ui-slider-handle ui-state-default ui-corner-all" tabindex=""
                        style="left: 73.4043%;"></span>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p class="no-margin"><input id="amount" type="text" class="rounded"></p>
                    </div>
                </div>
            </form>
        </div>
        <!--End Price Filter Block-->
        <!--Brand Block-->
        <div class="block filterBox filter-widget size-swacthes brand-filter">
            <div class="block-title">
                <h3 class="mb-0">@lang('site.brands')</h3>
            </div>
            <div class="filterDD" style="">
                <ul class="clearfix">
                    @foreach ($brands as $brand)
                        <li><input type="checkbox" class="filter-brand" value="{{ $brand->id }}" id="{{ 'filter-brand-'.$brand->id }}"><label
                                for="{{ 'filter-brand-'.$brand->id }}"><span></span>{{ $brand->name }}</label></li>
                    @endforeach

                </ul>
            </div>
        </div>
        <!--End Brand Block-->

        <div class="block mb-0">
            <div class="block-title">
                <h3>@lang('site.filter')</h3>
            </div>
            <div class="row">
                <div class="col-12 text-center margin-25px-top">
                    <form action="{{ route('products.index') }}" method="get" id="filterForm">
                        <input type="hidden" id="category_id" name="category_id" value="{{request()->category_id}}">
                        <input type="hidden" id="max_price" name="max_price" value="{{request()->max_price}}">
                        <input type="hidden" id="min_price" name="min_price" value="{{request()->min_price}}">
                        <input type="hidden" id="brand_id" name="brand_id" value="{{request()->brand_id}}">
                        <input type="hidden" id="f_car_id" name="car_id" value="{{request()->car_id}}">
                        <input type="hidden" id="f_year" name="year" value="{{request()->year}}">
                        <button class="btn btn--small rounded">@lang('site.filter')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
