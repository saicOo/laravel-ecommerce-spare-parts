<div class="col-md-8 card padding-y-sm card">
                    <!-- Search form -->
                    <div class="container mt-2" style="position: relative">
                        <input class="form-control" id="listSearch" type="text" v-model="inputSearch"
                            placeholder="ابحث عن اسم المنتج او الباركود" autofocus >
                        <ul class="list-group" id="search-box"
                            style="position: absolute;
                        z-index: 10;
                        width: calc(100% - 30px);">
                            <div class="result-search" id="result-search" v-if="inputSearch != ''">
                            <li class="list-group-item li-search" v-for="product in resultSearch">
                            <a href="javascript:void(0)" style="color: #88c2ff;"
                            @click.prevent="addProduct(product.id,product.name,product.stock,product.units)"
                            >
                            @{{product.name}} | @{{product.barcode}}
                            </a>
                            </li>
                        </div>
                        </ul>
                    </div>
                    <!-- Search form.// -->
                    <br>
                    <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
                      
                        <li class="nav-item">
                                <a class="nav-link active show"
                                    id="custom-content-below-all-tab" data-toggle="pill"
                                    href="#custom-content-below-all" role="tab"
                                    aria-controls="custom-content-below-all"
                                    aria-selected="true">
                                    <i class="fa fa-tags "></i>all</a>
                            </li>
                        @foreach ($categories as $index => $category)
                            <li class="nav-item">
                                <a class="nav-link "
                                    id="custom-content-below-{{ $category->id }}-tab" data-toggle="pill"
                                    href="#custom-content-below-{{ $category->id }}" role="tab"
                                    aria-controls="custom-content-below-{{ $category->id }}"
                                    aria-selected="false">
                                    <i class="fa fa-tags "></i> {{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <span id="item">
                        <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active"
                                    id="custom-content-below-all" role="tabpanel"
                                    aria-labelledby="custom-content-below-all-tab">
                                    <span class="items-products">
                                        <div class="row">
                                            @foreach ($allProducts as $product)
                                                <div class="col-md-3">
                                                    <figure class="card card-product">
                                                        <span class="badge-new"> ... </span>
                                                        <div class="img-wrap"> <img src="{{ $product->image_path }}">
                                                            <a class="btn-overlay" href="#"><i
                                                                    class="fa fa-search-plus"></i> ...</a>
                                                        </div>
                                                        <figcaption class="info-wrap">
                                                            <a href="#" class="title">{{ $product->name }}</a>
                                                            <div class="action-wrap">
                                                                <a href="#" class="btn btn-primary btn-sm float-right"
                                                                    @click.prevent="addProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->stock }}, {{ $product->units }})"> <i
                                                                    @click.stop class="fa fa-cart-plus"></i> @lang('site.add') </a>
                                                                <div class="price-wrap h5">
                                                                    <span
                                                                        class="price-new">${{ number_format($product->units[0]->sale_price, 2) }}</span>
                                                                </div> <!-- price-wrap.// -->
                                                            </div> <!-- action-wrap -->
                                                        </figcaption>
                                                    </figure> <!-- card // -->
                                                </div> <!-- col // -->
                                                @endforeach
                                        </div> <!-- row.// -->

                                    </span>
                                </div>
                            @foreach ($categories as $index => $category)
                                <div class="tab-pane fade"
                                    id="custom-content-below-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="custom-content-below-{{ $category->id }}-tab">
                                    <span class="items-products">
                                        <div class="row">
                                            @foreach ($category->products as $product)
                                                <div class="col-md-3">
                                                    <figure class="card card-product">
                                                        <span class="badge-new"> ... </span>
                                                        <div class="img-wrap"> <img src="{{ $product->image_path }}">
                                                            <a class="btn-overlay" href="#"><i
                                                                    class="fa fa-search-plus"></i> ...</a>
                                                        </div>
                                                        <figcaption class="info-wrap">
                                                            <a href="#" class="title">{{ $product->name }}</a>
                                                            <div class="action-wrap">
                                                                <a href="#" class="btn btn-primary btn-sm float-right"
                                                                    @click.prevent="addProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->stock }}, {{ $product->units }})"> <i
                                                                    @click.stop class="fa fa-cart-plus"></i> @lang('site.add') </a>
                                                                <div class="price-wrap h5">
                                                                    <span
                                                                        class="price-new">${{ number_format($product->units[0]->sale_price, 2) }}</span>
                                                                </div> <!-- price-wrap.// -->
                                                            </div> <!-- action-wrap -->
                                                        </figcaption>
                                                    </figure> <!-- card // -->
                                                </div> <!-- col // -->
                                            @endforeach
                                        </div> <!-- row.// -->

                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </span>
                </div>