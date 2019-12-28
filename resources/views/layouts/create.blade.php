@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><strong>{{ $title }}</strong></h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><strong>{{ __('Error') }}!</strong> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                    @endif

                    @yield('form')
                </div>
            </div>
        </div>
    </div>

@endsection
