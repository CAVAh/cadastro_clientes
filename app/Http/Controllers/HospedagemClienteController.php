<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Cliente;
use App\GrupoHospedagem;
use App\Hospedagem;
use App\HospedagemCliente;
use App\Http\Requests\HospedagemClienteRequest;
use App\Pais;
use App\Portador;
use App\Profissao;
use App\Quarto;
use App\TipoHospedagem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HospedagemClienteController extends CustomController
{
    protected $title = 'Hosp Cli';
    protected $prefix = 'hospedagem_cliente';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = DB::table('hospedagens')
            ->join('quartos', 'quartos.id', '=', 'hospedagens.quarto_id')
            ->selectRaw('hospedagens.*, quartos.nome as quarto_nome')
            ->selectRaw('CASE WHEN conferido = 1 THEN "Sim" ELSE "Não" END as conferido')->paginate();

        return parent::viewItems('layouts.index', $values->items(), ['class' => HospedagemCliente::class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //$tipos      = TipoHospedagem::all(['id', 'nome']);
        //$portadores = Portador::all(['id', 'nome']);
        $profissoes = Profissao::all(['id', 'nome']);
        $bairros    = Bairro::all(['id', 'nome']);
        $cidades    = Cidade::all(['id', 'nome']);
        $quartos    = Quarto::all(['id', 'nome']);
        $grupos     = GrupoHospedagem::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', compact('profissoes', 'bairros', 'cidades', 'quartos', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HospedagemClienteRequest  $request
     * @return Response
     */
    public function store(HospedagemClienteRequest $request)
    {
        $hospedagem = new Hospedagem([
            'quarto_id'    => $request->get('quarto_id'),
            'grupo_id'     => $request->get('grupo_id'),
            'data_entrada' => $request->get('data_entrada'),
            'data_saida'   => $request->get('data_saida'),
            'obs'          => $request->get('obs_hosp'),
            'conferido'    => 0
        ]);

        $clientes[] = new Cliente([
            'nome'          => $request->get('nome'),
            'rg'            => $request->get('rg'),
            'cpf'           => $request->get('cpf'),
            'profissao_id'  => $request->get('profissao_id'),
            'data_nasc'     => $request->get('data_nasc'),
            'sexo'          => $request->get('sexo'),
            'endereco'      => $request->get('endereco'),
            'cidade_id'     => $request->get('cidade_id'),
            'bairro_id'     => $request->get('bairro_id'),
            'cep'           => $request->get('cep'),
            'fone'          => $request->get('fone'),
            'celular'       => $request->get('celular'),
            'celular2'      => $request->get('celular2'),
            'email'         => $request->get('email'),
            'obs'           => $request->get('obs_cli'),
            'cpf_conferido' => 0,
            'verificado'    => 0,
            'hospedou'      => 1
        ]);

        $data_pivot = [
            ['is_acompanhante' => 0]
        ];

        if (!empty($request->get('acompanhante1_nome'))) {
            $clientes[] = new Cliente([
                'nome'      => $request->get('acompanhante1_nome'),
                'cpf'       => $request->get('acompanhante1_cpf'),
                'data_nasc' => $request->get('acompanhante1_data_nasc'),
            ]);
            $data_pivot[]    = ['is_acompanhante' => 1];
        }

        if (!empty($request->get('acompanhante2_nome'))) {
            $clientes[] = new Cliente([
                'nome'      => $request->get('acompanhante2_nome'),
                'cpf'       => $request->get('acompanhante2_cpf'),
                'data_nasc' => $request->get('acompanhante2_data_nasc'),
            ]);
            $data_pivot[]    = ['is_acompanhante' => 1];
        }

        if (!empty($request->get('acompanhante3_nome'))) {
            $clientes[] = new Cliente([
                'nome'      => $request->get('acompanhante3_nome'),
                'cpf'       => $request->get('acompanhante3_cpf'),
                'data_nasc' => $request->get('acompanhante3_data_nasc'),
            ]);
            $data_pivot[]    = ['is_acompanhante' => 1];
        }

        $clientes[] = new Cliente([
            'nome'      => 'acompanhante1',
            'cpf'       => '123.456.789-01',
            'data_nasc' => null
        ]);
        $data_pivot[] = ['is_acompanhante' => 1];

        $clientes[] = new Cliente([
            'nome'      => 'acompanhante2',
            'cpf'       => '123.456.789-01',
            'data_nasc' => '1995-03-05'
        ]);
        $data_pivot[]  = ['is_acompanhante' => 1];

        $hospedagem->save();

        $hospedagem->clientes()->saveMany($clientes, $data_pivot);

        dd($request->all());
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HospedagemCliente  $hospedagemCliente
     * @return Response
     */
    public function edit(HospedagemCliente $hospedagemCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request            $request
     * @param HospedagemCliente  $hospedagemCliente
     * @return Response
     */
    public function update(Request $request, HospedagemCliente $hospedagemCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HospedagemCliente  $hospedagemCliente
     * @return Response
     */
    public function destroy(HospedagemCliente $hospedagemCliente)
    {
        //
    }
}
