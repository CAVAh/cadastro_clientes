@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.update', $pais->id) }}">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="nome">{{ __('Nome') }}:</label>
                    <input type="text" id="nome" name="nome" class="form-control" maxlength="50" value="{{ old('nome', $pais->nome) }}"/>
                </div>

                <div class="form-group">
                    <label for="sigla">{{ __('Sigla') }}:</label>
                    <input type="text" id="sigla" name="sigla" class="form-control" maxlength="3" value="{{ old('sigla', $pais->sigla) }}"/>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
@endsection
