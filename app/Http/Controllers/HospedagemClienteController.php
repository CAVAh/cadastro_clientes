<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\GrupoHospedagem;
use App\HospedagemCliente;
use App\Pais;
use App\Portador;
use App\Profissao;
use App\Quarto;
use App\TipoHospedagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospedagemClienteController extends CustomController
{
    protected $title = 'Hosp Cli';
    protected $prefix = 'hospedagem_cliente';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$tipos      = TipoHospedagem::all(['id', 'nome']);
        //$portadores = Portador::all(['id', 'nome']);
        $profissoes = Profissao::all(['id', 'nome']);
        $bairros    = Bairro::all(['id', 'nome']);
        $cidades    = Bairro::all(['id', 'nome']);
        $quartos    = Quarto::all(['id', 'nome']);
        $grupos     = GrupoHospedagem::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', compact('profissoes', 'bairros', 'cidades', 'quartos', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\HospedagemCliente $hospedagemCliente
     * @return \Illuminate\Http\Response
     */
    public function show(HospedagemCliente $hospedagemCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\HospedagemCliente $hospedagemCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(HospedagemCliente $hospedagemCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\HospedagemCliente $hospedagemCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HospedagemCliente $hospedagemCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\HospedagemCliente $hospedagemCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(HospedagemCliente $hospedagemCliente)
    {
        //
    }
}
