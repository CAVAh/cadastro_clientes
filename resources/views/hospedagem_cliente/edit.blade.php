@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.update', $hospedagem->id) }}">
                @method('PUT')
                @csrf

                {{ \App\Utils\FormEdit::select('quarto_id', $quartos, $hospedagem->quarto_id, 'id', 'nome', true) }}
                {{ \App\Utils\FormEdit::select('grupo_id', $grupos, $hospedagem->grupo_id) }}
                {{ \App\Utils\FormEdit::select('tipo_id', $tipos, $hospedagem->tipo_id) }}
                {{ \App\Utils\FormEdit::select('portador_id', $portadores, $hospedagem->portador_id) }}
                {{ \App\Utils\FormEdit::money('valtotal', $hospedagem->valtotal) }}
                {{ \App\Utils\FormEdit::date('data_entrada', $hospedagem->data_entrada) }}
                {{ \App\Utils\FormEdit::date('data_saida', $hospedagem->data_saida) }}
                {{ \App\Utils\FormEdit::text('nro_reserva', $hospedagem->nro_reserva, 10) }}
                {{ \App\Utils\FormEdit::checkbox('conferido', $hospedagem->conferido) }}
                {{ \App\Utils\FormEdit::textarea('obs', $hospedagem->obs) }}

                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
@endsection
