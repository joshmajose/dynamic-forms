@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p> {{ __('You are logged in!') }}</p>

                    <div class="d-grid gap-2">

                        <a href="{{route('forms.index')}}" class="mb-3 btn-primary btn btn-block">Go to Forms</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection