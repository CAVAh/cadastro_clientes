@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.update', $bairro->id) }}">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="nome">{{ __('Nome') }}:</label>
                    <input type="text" id="nome" name="nome" class="form-control" maxlength="50" value="{{ old('nome', $bairro->nome) }}"/>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
@endsection
