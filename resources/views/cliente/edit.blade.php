@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <form method="post" action="{{ route($prefix . '.update', $cliente->id) }}">
                @method('PUT')
                @csrf

                {{ \App\Utils\FormEdit::text('nome', $cliente->nome, 80, true) }}

                {{ \App\Utils\FormEdit::text('rg', $cliente->rg, 12) }}

                {{ \App\Utils\FormEdit::text('cpf', $cliente->cpf, 11, false, 'cpf') }}

                {{ \App\Utils\FormEdit::select('profissao_id', $profissoes, $cliente->profissao_id) }}

                {{ \App\Utils\FormEdit::date('data_nasc', $cliente->data_nasc, true) }}

                {{ \App\Utils\FormEdit::enum('sexo', $cliente->sexo, ['M', 'F'], true) }}

                {{ \App\Utils\FormEdit::text('endereco', $cliente->endereco, 100) }}

                {{ \App\Utils\FormEdit::select('cidade_id', $cliente->cidade_id, $cidades) }}

                {{ \App\Utils\FormEdit::select('bairro_id', $cliente->bairro_id, $bairros) }}

                {{ \App\Utils\FormEdit::text('cep', $cliente->cep, 8, false, 'cep') }}

                {{ \App\Utils\FormEdit::text('fone', $cliente->fone, 14, false, 'phone') }}

                {{ \App\Utils\FormEdit::text('celular', $cliente->celular, 15, false, 'cellphone') }}

                {{ \App\Utils\FormEdit::text('celular2', $cliente->celular2, 15, false, 'cellphone') }}

                {{ \App\Utils\FormEdit::text('email', $cliente->email, 100) }}

                {{ \App\Utils\FormEdit::textarea('obs', $cliente->obs) }}

                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
@endsection
