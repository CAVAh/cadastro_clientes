@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.store') }}">
                @csrf

                <div class="form-group">
                    <label for="nome">{{ __('attr.nome') }}:</label>
                    <input type="text" id="nome" name="nome" class="form-control" maxlength="50" value="{{ old('nome') }}"/>
                </div>

                <div class="form-group">
                    <label for="categoria_id">{{ __('attr.categoria_id') }}:</label>
                    <select class="form-control" id="categoria_id" name="categoria_id">
                        <option value="">--- Selecione ---</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') ? (old('$categoria_id') === $categoria->categoria_id ? 'selected' : '') : '' }}>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check">
                    <input type="checkbox" id="multiplas_hosp" name="multiplas_hosp" class="form-check-input" {{ !! old('multiplas_hosp') ? 'checked' : '' }}/>
                    <label for="multiplas_hosp">{{ __('attr.multiplas_hosp') }}</label>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Add') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection
