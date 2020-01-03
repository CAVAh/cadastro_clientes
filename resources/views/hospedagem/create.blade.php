@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.store') }}">
                @csrf

                {{ \App\Utils\FormCreate::select('quarto_id', $quartos, 'id', 'nome', true) }}
                {{ \App\Utils\FormCreate::select('grupo_id', $grupos) }}
                {{ \App\Utils\FormCreate::select('tipo_id', $tipos) }}
                {{ \App\Utils\FormCreate::select('portador_id', $portadores) }}
                {{ \App\Utils\FormCreate::money('valtotal') }}
                {{ \App\Utils\FormCreate::date('data_entrada') }}
                {{ \App\Utils\FormCreate::date('data_saida') }}
                {{ \App\Utils\FormCreate::text('nro_reserva', 10) }}
                {{ \App\Utils\FormCreate::checkbox('conferido') }}
                {{ \App\Utils\FormCreate::textarea('obs') }}

                <button type="submit" class="btn btn-primary">{{ __('Add') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection
