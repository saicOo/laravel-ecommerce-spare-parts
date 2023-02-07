@extends('dashboard.layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Display factory car</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('site.name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($factory_cars as $factory_car)
                                    <tr>
                                        <th scope="row">{{ $factory_car->id }}</th>
                                        <td>{{ $factory_car->name}}</td>
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
