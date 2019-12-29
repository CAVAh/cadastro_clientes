@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.store') }}">
                @csrf

                <div class="form-group">
                    <label for="nome">{{ __('Nome') }}:</label>
                    <input type="text" id="nome" name="nome" class="form-control" maxlength="30" value="{{ old('nome') }}"/>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Adicionar') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection