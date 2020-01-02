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
                    <label for="tipo_id">{{ __('attr.tipo_id') }}:</label>
                    <select class="form-control" id="tipo_id" name="tipo_id">
                        <option value="">--- Selecione ---</option>
                        @foreach($tipo_hospedagens as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('tipo_id') ? (old('tipo_id') === $tipo->id ? 'selected' : '') : '' }}>{{ $tipo->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="portador_id">{{ __('attr.portador_id') }}:</label>
                    <select class="form-control" id="portador_id" name="portador_id">
                        <option value="">--- Selecione ---</option>
                        @foreach($portadores as $portador)
                            <option value="{{ $portador->id }}" {{ old('portador_id') ? (old('portador_id') === $portador->id ? 'selected' : '') : '' }}>{{ $portador->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_entrada">{{ __('attr.data_entrada') }}:</label>
                    <input type="text" id="data_entrada" name="data_entrada" class="form-control date" maxlength="10" value="{{ old('data_entrada') }}"/>
                </div>

                <div class="form-group">
                    <label for="data_saida">{{ __('attr.data_saida') }}:</label>
                    <input type="text" id="data_saida" name="data_saida" class="form-control date" maxlength="10" value="{{ old('data_saida') }}"/>
                </div>

                <div class="form-group">
                    <label for="valor_quarto">{{ __('attr.valor_quarto') }}:</label>
                    <input type="text" id="valor_quarto" name="valor_quarto" class="form-control money" maxlength="8" value="{{ old('valor_quarto') }}"/>
                </div>

                <div class="form-group">
                    <label for="obs">{{ __('attr.obs') }}:</label>
                    <textarea id="obs" class="form-control" name="obs" rows="3">{{ old('obs') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Add') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection
