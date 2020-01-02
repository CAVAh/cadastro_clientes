@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.store') }}">
                @csrf

                {{ \App\Utils\FormCreate::text('nome', 80, true) }}

                {{ \App\Utils\FormCreate::text('rg', 12) }}

                {{ \App\Utils\FormCreate::text('cpf', 11, false, 'cpf') }}

                {{ \App\Utils\FormCreate::select('profissao_id', $profissoes) }}

                {{ \App\Utils\FormCreate::date('data_nasc') }}

                {{ \App\Utils\FormCreate::enum('sexo', ['M', 'F'], true) }}

                {{ \App\Utils\FormCreate::text('endereco', 100) }}

                {{ \App\Utils\FormCreate::select('cidade_id', $cidades) }}

                {{ \App\Utils\FormCreate::select('bairro_id', $bairros) }}

                {{ \App\Utils\FormCreate::text('cep', 8, false, 'cep') }}

                {{ \App\Utils\FormCreate::text('fone', 14, false, 'phone') }}

                {{ \App\Utils\FormCreate::text('celular', 15, false, 'cellphone') }}

                {{ \App\Utils\FormCreate::text('celular2', 15, false, 'cellphone') }}

                {{ \App\Utils\FormCreate::text('email', 100) }}

                {{ \App\Utils\FormCreate::textarea('obs') }}

                <button type="submit" class="btn btn-primary">{{ __('Add') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection
