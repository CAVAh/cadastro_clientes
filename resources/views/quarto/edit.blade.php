@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.update', $quarto->id) }}">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="nome">{{ __('attr.nome') }}:</label>
                    <input type="text" id="nome" name="nome" class="form-control" maxlength="50" value="{{ old('nome', $quarto->nome) }}"/>
                </div>

                <div class="form-group">
                    <label for="categoria_id">{{ __('attr.categoria') }}:</label>
                    <select class="form-control" id="categoria_id" name="categoria_id">
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $categoria->id) === $quarto->categoria_id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check">
                    <input type="checkbox" id="multiplas_hosp" name="multiplas_hosp" class="form-check-input" {{ old('multiplas_hosp', $quarto->multiplas_hosp) ? 'checked' : '' }}/>
                    <label for="multiplas_hosp">{{ __('attr.multiplas_hosp') }}</label>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
@endsection
