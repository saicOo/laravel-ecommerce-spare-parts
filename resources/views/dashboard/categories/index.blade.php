@extends('dashboard.layouts.app')
@section('content')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"> {{ __('site.dashboard') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)"> {{ __('site.categories') }}</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="container-fluid">
            <div class="row justify-content-between mb-3">
                <div class="col-12 ">
                    <h2 class="page-heading">{{ __('site.list') }} {{ __('site.categories') }}</h2>
                    <p class="mb-0">{{ __('site.count') }} {{ __('site.categories') }} : {{ $categories->total() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <a href="{{ route('dashboard.categories.create') }}"
                                        class="btn btn-primary mb-2">{{ __('site.create') }}</a>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                        data-target="#filterModal">{{ __('site.filter') }}</button>
                                    <form action="{{ route('dashboard.categories.destroy', 'delete') }}" method="post"
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
                                            <th scope="col">{{ __('site.type') }}</th>
                                            <th scope="col">{{ __('site.sub_category') }}</th>
                                            <th scope="col">{{ __('site.action') }}</th>
                                            <th scope="col"><input type="checkbox" value=""
                                                    id="check-box-delete-all"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $index => $category)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>@lang('site.' . $category->category_type)</td>
                                                <td>
                                                    @foreach ($category->subCategories as $sub_category)
                                                       ( {{ $sub_category->name }} )
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                            class="mr-4" data-toggle="tooltip" data-placement="top"
                                                            title="" data-original-title="Edit"><i
                                                                class="fa fa-pencil color-muted"></i> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <input type="checkbox" value="{{ $category->id }}"
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
                            <nav>
                                <ul class="pagination pagination-sm pagination-style-2">
                                    @php
                                        $append_url = '';
                                        if (isset(request()->query()['search'])) {
                                            $append_url = '&search=' . request()->query()['search'];
                                        }
                                    @endphp
                                    <li
                                        class="page-item page-indicator {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $categories->previousPageUrl() . $append_url }}">
                                            <i class="icon-arrow-left"></i></a>
                                    </li>
                                    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $num_page => $url_page)
                                        <li
                                            class="page-item {{ $num_page === $categories->currentPage() ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $url_page . $append_url }}">{{ $num_page }}</a>
                                        </li>
                                    @endforeach
                                    <li
                                        class="page-item page-indicator {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link " href="{{ $categories->nextPageUrl() . $append_url }}">
                                            <i class="icon-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <div class="modal fade" id="filterModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('site.filter') }} {{ __('site.categories') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.categories.index') }}" method="GET" id="filter-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('site.close') }}</button>
                    <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault();
                document.getElementById('filter-form').submit();">{{ __('site.filter') }}</button>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('js')
    <script src="{{ asset('dashboard/assets/js/massDelete.js') }}"></script>
@endpush
