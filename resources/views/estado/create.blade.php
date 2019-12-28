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
                    <label for="uf">{{ __('attr.uf') }}:</label>
                    <input type="text" id="uf" name="uf" class="form-control" maxlength="2" value="{{ old('uf') }}"/>
                </div>

                <div class="form-group">
                    <label for="pais_id">{{ __('attr.pais_id') }}:</label>
                    <select class="form-control" id="pais_id" name="pais_id">
                        @foreach($paises as $pais)
                            <option value="{{ $pais->id }}" {{ old('pais_id') ? (old('pais_id') === $pais->id ? 'selected' : '') : ($pais->nome === 'Brasil' ? 'selected' : '') }}>{{ $pais->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Add') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection