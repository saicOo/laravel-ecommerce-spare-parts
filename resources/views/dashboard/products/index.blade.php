@extends('dashboard.layouts.app')
@push('css')
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/plugins/select2/css/select2.min.css') }}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.products') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.products') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.products') }} : {{ $products->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <a href="{{ route('dashboard.products.create') }}"
                                        class="btn btn-primary mb-2">{{ __('site.create') }}</a>
                                        {{-- btn-filter --}}
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                        {{-- btn-excel --}}
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#excelModal">Excel</button>
                                        {{-- btn-mass-delete --}}
                                    <form action="{{ route('dashboard.products.destroy', 'delete') }}" method="post"
                                        style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <input type="hidden" value="" name="mass_delete" id="mass-delete">
                                        <button type="submit" id="btn-mass-delete" class="btn btn-danger mb-2"
                                            disabled>{{ __('site.mass_delete') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table verticle-middle table-responsive-lg mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('site.name') }}</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">{{ __('site.purchase_price') }}</th>
                                            <th scope="col">{{ __('site.sale_price') }}</th>
                                            <th scope="col">{{ __('site.stock') }}</th>
                                            <th scope="col">{{ __('site.country') }}</th>
                                            <th scope="col">{{ __('site.action') }}</th>
                                            <th scope="col"><input type="checkbox" value=""
                                                    id="check-box-delete-all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><a
                                                    href="{{ route('dashboard.products.show', $product->id) }}">{{ $product->name }}</a>
                                                </td>
                                                <td>#{{ $product->id }}</td>
                                                <td>${{number_format($product->purchase_price,2)}}</td>
                                                <td>${{number_format($product->price,2)}}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->country }}</td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Edit"><i
                                                                class="fa fa-pencil color-muted"></i> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" value="{{ $product->id }}"
                                                            class="check-box-delete">
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <!-- start filter modal -->
    <div class="modal fade" id="filterModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.products') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.products.index') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                        <div class="form-group">
                            <select name="category_id" class="dropdown-groups @error('category_id') is-invalid @enderror">
                                <option value="" disabled selected>@lang('site.choose') @lang('site.category')...
                                    @foreach ($primary_categories as $primary_category)
                                        <optgroup label="{{ $primary_category->name }}">
                                            @foreach ($primary_category->subCategories as $sub_category)
                                                <option value="{{ $sub_category->id }}"
                                                    {{ request()->category_id == $sub_category->id ? 'selected' : '' }}>
                                                    {{ $sub_category->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                            </select>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('site.close') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                document.getElementById('filter-form').submit();">{{ __('site.filter') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end filter modal -->
    <!-- start excel modal -->
    <div class="modal fade" id="excelModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excel</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.import-products') }}" method="POST" enctype="multipart/form-data" id="excel-form">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" class="form-control mb-2 @error('file') is-invalid @enderror">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('site.close') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                document.getElementById('excel-form').submit();">@lang('site.import')</button>
                <a class="btn btn-warning" href="{{ route('dashboard.export-products') }}">
                    @lang('site.export')
                </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end excel modal -->
@endpush
@push('js')
    <script src="{{ asset('dashboard/assets/js/massDelete.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('dashboard/assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Select 2 init -->
    <script src="{{ asset('dashboard/assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/custom-init/select2-init.js') }}"></script>
@endpush
