@extends('front.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @auth
            <div class="card">
                <div class="card-header">Front</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                    <div class="text-center">
                        @if (Auth::user())
                        {{Auth::user()->name}}
                        @endif
                    </div>
                </div>
            </div>
                @endauth
        </div>
    </div>
</div>
@endsection
