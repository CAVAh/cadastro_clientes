<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Cliente;
use App\Http\Requests\ClienteRequest;
use App\Profissao;
use App\Utils\Format;
use Exception;
use Illuminate\Http\Response;

class ClienteController extends CustomController
{
    protected $title = 'Cliente';
    protected $prefix = 'cliente';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = Cliente::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => Cliente::class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cidades    = Cidade::all(['id', 'nome']);
        $profissoes = Profissao::all(['id', 'nome']);
        $bairros    = Bairro::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', compact('cidades', 'profissoes', 'bairros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClienteRequest $request
     * @return Response
     */
    public function store(ClienteRequest $request)
    {
        $cliente = new Cliente([
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
            'obs'           => $request->get('obs'),
            'cpf_conferido' => $request->get('cpf_conferido'),
            'verificado'    => $request->get('verificado'),
            'hospedou'      => $request->get('hospedou'),
        ]);

        $cliente->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cliente $cliente
     * @return Response
     */
    public function edit(Cliente $cliente)
    {
        $cidades            = Cidade::all(['id', 'nome']);
        $profissoes         = Profissao::all(['id', 'nome']);
        $bairros            = Bairro::all(['id', 'nome']);
        $cliente->data_nasc = Format::dateToStr($cliente->data_nasc);

        return parent::view($this->prefix . '.edit', compact('cliente', 'cidades', 'profissoes', 'bairros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClienteRequest $request
     * @param Cliente $cliente
     * @return Response
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->nome          = $request->get('nome');
        $cliente->rg            = $request->get('rg');
        $cliente->cpf           = $request->get('cpf');
        $cliente->profissao_id  = $request->get('profissao_id');
        $cliente->data_nasc     = $request->get('data_nasc');
        $cliente->sexo          = $request->get('sexo');
        $cliente->endereco      = $request->get('endereco');
        $cliente->cidade_id     = $request->get('cidade_id');
        $cliente->bairro_id     = $request->get('bairro_id');
        $cliente->cep           = $request->get('cep');
        $cliente->fone          = $request->get('fone');
        $cliente->celular       = $request->get('celular');
        $cliente->celular2      = $request->get('celular2');
        $cliente->email         = $request->get('email');
        $cliente->obs           = $request->get('obs');
        $cliente->cpf_conferido = $request->get('cpf_conferido');
        $cliente->verificado    = $request->get('verificado');
        $cliente->hospedou      = $request->get('hospedou');

        $cliente->save();
        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cliente $cliente
     * @return Response
     * @throws Exception
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return parent::redirect();
    }
}
