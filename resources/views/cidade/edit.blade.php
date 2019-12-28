@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.update', $cidade->id) }}">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="nome">{{ __('attr.nome') }}:</label>
                    <input type="text" id="nome" name="nome" class="form-control" maxlength="50" value="{{ old('nome', $cidade->nome) }}"/>
                </div>

                <div class="form-group">
                    <label for="ddd">{{ __('attr.ddd') }}:</label>
                    <input type="text" id="ddd" name="ddd" class="form-control" maxlength="2" value="{{ old('ddd', $cidade->ddd) }}"/>
                </div>

                <div class="form-group">
                    <label for="cep_padrao">{{ __('attr.cep_padrao') }}:</label>
                    <input type="text" id="cep_padrao" name="cep_padrao" class="form-control" maxlength="9" value="{{ old('cep_padrao', $cidade->cep_padrao) }}"/>
                </div>

                <div class="form-group">
                    <label for="cod_ibge">{{ __('attr.cod_ibge') }}:</label>
                    <input type="number" id="cod_ibge" name="cod_ibge" class="form-control" maxlength="5" value="{{ old('cod_ibge', $cidade->cod_ibge) }}"/>
                </div>

                <div class="form-group">
                    <label for="estado_id">{{ __('attr.estado_id') }}:</label>
                    <select class="form-control" id="estado_id" name="estado_id">
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}" {{ old('estado_id', $estado->id) === $cidade->estado_id ? 'selected' : '' }}>{{ $estado->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

@endsection