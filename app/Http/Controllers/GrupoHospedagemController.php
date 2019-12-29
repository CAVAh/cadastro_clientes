<?php

namespace App\Http\Controllers;

use App;
use App\GrupoHospedagem;
use Exception;
use Illuminate\Http\{Request, Response};

class GrupoHospedagemController extends CustomController
{
    protected $title = 'Grupo de Hospedagem';
    protected $prefix = 'grupo_hospedagem';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = GrupoHospedagem::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => GrupoHospedagem::class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tipo_hospedagens = App\TipoHospedagem::all(['id', 'nome']);
        $portadores       = App\Portador::all(['id', 'nome']);

        return parent::view($this->prefix.'.create', compact('tipo_hospedagens', 'portadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\GrupoHospedagemRequest  $request
     * @return Response
     */
    public function store(App\Http\Requests\GrupoHospedagemRequest $request)
    {
        $grupoHospedagem = new GrupoHospedagem([
            'tipo_id'      => $request->get('tipo_id'),
            'portador_id'  => $request->get('portador_id'),
            'nome'         => $request->get('nome'),
            'data_entrada' => $request->get('data_entrada'),
            'data_saida'   => $request->get('data_saida'),
            'obs'          => $request->get('obs'),
            'valor_quarto' => $request->get('valor_quarto')
        ]);

        $grupoHospedagem->save();
        return parent::redirect();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  GrupoHospedagem  $grupoHospedagem
     * @return Response
     */
    public function edit(GrupoHospedagem $grupoHospedagem)
    {
        $tipo_hospedagens = App\TipoHospedagem::all(['id', 'nome']);
        $portadores       = App\Portador::all(['id', 'nome']);
        $grupoHospedagem->data_entrada = App\Utils\Format::dateToStr($grupoHospedagem->data_entrada);
        $grupoHospedagem->data_saida = App\Utils\Format::dateToStr($grupoHospedagem->data_saida);

        return parent::view($this->prefix.'.edit', compact('grupoHospedagem', 'tipo_hospedagens', 'portadores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\GrupoHospedagemRequest  $request
     * @param  GrupoHospedagem  $grupoHospedagem
     * @return Response
     */
    public function update(App\Http\Requests\GrupoHospedagemRequest $request, GrupoHospedagem $grupoHospedagem)
    {
        $grupoHospedagem->tipo_id      = $request->get('tipo_id');
        $grupoHospedagem->portador_id  = $request->get('portador_id');
        $grupoHospedagem->nome         = $request->get('nome');
        $grupoHospedagem->data_entrada = $request->get('data_entrada');
        $grupoHospedagem->data_saida   = $request->get('data_saida');
        $grupoHospedagem->obs          = $request->get('obs');
        $grupoHospedagem->valor_quarto = $request->get('valor_quarto');

        $grupoHospedagem->save();
        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GrupoHospedagem  $grupoHospedagem
     * @return Response
     * @throws Exception
     */
    public function destroy(GrupoHospedagem $grupoHospedagem)
    {
        $grupoHospedagem->delete();

        return parent::redirect();
    }
}
