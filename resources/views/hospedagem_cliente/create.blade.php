@extends('layouts.create')

@section('form')
    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route($prefix . '.store') }}">
                @csrf

                @if ($errors->any())
                    {{ \App\Utils\FormCreate::setErrors($errors) }}
                @endif

                <fieldset>
                    <legend>Hospedagem</legend>
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::selectCol('quarto_id', $quartos, 'col-4 col-sm-4 col-md-2', true) }}
                        <div class="w-100 d-block d-sm-none"></div>
                        {{ \App\Utils\FormCreate::selectCol('grupo_id', $grupos, 'col-md-6', false) }}
                        {{ \App\Utils\FormCreate::date('data_entrada', false, 'col-6 col-sm-4 col-md-2') }}
                        {{ \App\Utils\FormCreate::date('data_saida', false, 'col-6 col-sm-4 col-md-2') }}
                        {{ \App\Utils\FormCreate::textarea('obs_hosp', 'col-12') }}
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Cliente</legend>
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::cpf('cpf', false, 'col-sm-4 col-md-3') }}
                        {{ \App\Utils\FormCreate::text('nome', 80, true, '', 'col-sm-8 col-md-6') }}
                        {{ \App\Utils\FormCreate::text('rg', 13, false, '', 'col-sm-4 col-md-3') }}
                        {{ \App\Utils\FormCreate::selectCol('profissao_id', $profissoes, 'col-sm-8 col-md-5 col-lg-6') }}
                        {{ \App\Utils\FormCreate::enum('sexo', ['F', 'M'], true, 'col-6 col-sm-7 col-md-4 col-lg-3 ml-2 mr-n2', 'mt-md-2') }}
                        {{ \App\Utils\FormCreate::date('data_nasc', false, 'col-6 col-sm-5 col-md-3') }}
                    </div>
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::text('endereco', 100, false, '', 'col-md-5') }}
                        {{ \App\Utils\FormCreate::selectCol('cidade_id', $cidades, 'col-10 col-md-3') }}
                        {{ \App\Utils\FormCreate::selectCol('bairro_id', $bairros, 'col-sm-6 col-md-2') }}
                        {{ \App\Utils\FormCreate::cep('cep', false, 'col-6 col-md-2') }}
                        <div class="w-100 d-none d-sm-block"></div>
                        {{ \App\Utils\FormCreate::phone('fone', false, 'col-6 col-sm-4 col-md-2') }}
                        {{ \App\Utils\FormCreate::cellphone('celular', false, 'col-6 col-sm-4 col-md-2') }}
                        {{ \App\Utils\FormCreate::cellphone('celular2', false, 'col-6 col-sm-4 col-md-2') }}
                        {{ \App\Utils\FormCreate::email('email', false, 'col-md-6') }}
                    </div>
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::textarea('obs_cli', 'col-12') }}
                    </div>
                </fieldset>
                <hr>
                <fieldset class="form-group">
                    <legend>Acompanhantes</legend>
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::text('acompanhante1_nome', 80, false, '', 'col-md-7') }}
                        {{ \App\Utils\FormCreate::cpf('acompanhante1_cpf', false, 'col-7 col-md-3') }}
                        {{ \App\Utils\FormCreate::date('acompanhante1_data_nasc', false, 'col-5 col-md-2') }}
                    </div>
                    <hr class="d-block d-md-none">
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::text('acompanhante2_nome', 80, false, '', 'col-md-7') }}
                        {{ \App\Utils\FormCreate::cpf('acompanhante2_cpf', false, 'col-7 col-md-3') }}
                        {{ \App\Utils\FormCreate::date('acompanhante2_data_nasc', false, 'col-5 col-md-2') }}
                    </div>
                    <hr class="d-block d-md-none">
                    <div class="form-row">
                        {{ \App\Utils\FormCreate::text('acompanhante3_nome', 80, false, '', 'col-md-7') }}
                        {{ \App\Utils\FormCreate::cpf('acompanhante3_cpf', false, 'col-7 col-md-3') }}
                        {{ \App\Utils\FormCreate::date('acompanhante3_data_nasc', false, 'col-5 col-md-2') }}
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary">{{ __('Add') }} {{ $title }}</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/hospedagem_cliente.js') }}"></script>
    <script type="text/javascript">
        (function () {
            $('#cpf').blur(function () {
                const _this = $(this);

                $.ajax({
                    dataType: 'json',
                    type: 'get',
                    url: '{{URL::to('/cliente/findByCpf/' )}}',
                    data: {
                        'cpf': _this.val()
                    },
                    success: function (data) {
                        if(!$.isEmptyObject(data)) {
                            console.log(data);
                            _this.val('');
                            _this.removeClass('is-valid');
                            alert('CPF já cadastrado, passe para a próxima ficha.');
                            _this.get(0).focus();
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        })();
    </script>
@endsection
