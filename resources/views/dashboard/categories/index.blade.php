@extends('dashboard.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Display Parent Categories</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('site.name') }}</th>
                                    <th scope="col">{{ __('site.type') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    {{ $category->name }}
                                                </button>
                                                <div class="dropdown-menu">
                                                    @foreach ($category->subCategories as $sub_category)
                                                        <a class="dropdown-item"
                                                            href="#">{{ $sub_category->name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </td>
                                        <td>@lang('site.' . $category->category_type)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
