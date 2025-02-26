<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\GrupoHospedagem;
use App\Hospedagem;
use App\Http\Requests\HospedagemRequest;
use App\Portador;
use App\Quarto;
use App\TipoHospedagem;
use App\Utils\Format;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HospedagemController extends CustomController
{
    protected $title = 'Hospedagem';
    protected $prefix = 'hospedagem';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = DB::table('hospedagens')
            ->join('quartos', 'quartos.id', '=', 'hospedagens.quarto_id')
            ->selectRaw('hospedagens.*, quartos.nome')
            ->selectRaw('CASE WHEN conferido = 1 THEN "Sim" ELSE "Não" END as conferido')->paginate();

        return parent::viewItems('layouts.index', $values->items());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tipos      = TipoHospedagem::all(['id', 'nome']);
        $portadores = Portador::all(['id', 'nome']);
        $quartos    = Quarto::all(['id', 'nome']);
        $grupos     = GrupoHospedagem::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', compact('tipos', 'portadores', 'quartos', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HospedagemRequest $request
     * @return Response
     */
    public function store(HospedagemRequest $request)
    {
        $hospedagem = new Hospedagem([
            'quarto_id'    => $request->get('quarto_id'),
            'tipo_id'      => $request->get('tipo_id'),
            'portador_id'  => $request->get('portador_id'),
            'grupo_id'     => $request->get('grupo_id'),
            'data_entrada' => $request->get('data_entrada'),
            'data_saida'   => $request->get('data_saida'),
            'valtotal'     => $request->get('valtotal'),
            'nro_reserva'  => $request->get('nro_reserva'),
            'obs'          => $request->get('obs'),
            'conferido'    => $request->get('conferido'),
        ]);

        $hospedagem->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hospedagem $hospedagem
     * @return Response
     */
    public function edit(Hospedagem $hospedagem)
    {
        $tipos                    = TipoHospedagem::all(['id', 'nome']);
        $portadores               = Portador::all(['id', 'nome']);
        $quartos                  = Quarto::all(['id', 'nome']);
        $grupos                   = GrupoHospedagem::all(['id', 'nome']);
        $hospedagem->data_entrada = Format::dateToStr($hospedagem->data_entrada);
        $hospedagem->data_saida   = Format::dateToStr($hospedagem->data_saida);

        return parent::view($this->prefix . '.edit', compact('hospedagem', 'tipos', 'portadores', 'quartos', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HospedagemRequest $request
     * @param Hospedagem $hospedagem
     * @return Response
     */
    public function update(HospedagemRequest $request, Hospedagem $hospedagem)
    {
        $hospedagem->quarto_id    = $request->get('quarto_id');
        $hospedagem->tipo_id      = $request->get('tipo_id');
        $hospedagem->portador_id  = $request->get('portador_id');
        $hospedagem->grupo_id     = $request->get('grupo_id');
        $hospedagem->data_entrada = $request->get('data_entrada');
        $hospedagem->data_saida   = $request->get('data_saida');
        $hospedagem->valtotal     = $request->get('valtotal');
        $hospedagem->nro_reserva  = $request->get('nro_reserva');
        $hospedagem->obs          = $request->get('obs');
        $hospedagem->conferido    = $request->get('conferido');

        $hospedagem->save();
        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hospedagem $hospedagem
     * @return Response
     * @throws Exception
     */
    public function destroy(Hospedagem $hospedagem)
    {
        $hospedagem->delete();

        return parent::redirect();
    }
}
