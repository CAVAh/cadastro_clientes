<?php

namespace App\Http\Controllers;

use App\TipoHospedagem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TipoHospedagemController extends CustomController
{
    protected $title = 'Tipo Hospedagem';
    protected $prefix = 'tipo_hospedagem';
    protected $validation = [
        'nome' => 'bail|required|between:3,30|unique:tipo_hospedagens'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = TipoHospedagem::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => TipoHospedagem::class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $tipo_hospedagem = new TipoHospedagem([
            'nome' => $request->get('nome')
        ]);

        $tipo_hospedagem->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TipoHospedagem  $tipo_hospedagem
     * @return Response
     */
    public function edit(TipoHospedagem $tipo_hospedagem)
    {
        return parent::view($this->prefix . '.edit', compact('tipo_hospedagem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  TipoHospedagem  $tipo_hospedagem
     * @return Response
     */
    public function update(Request $request, TipoHospedagem $tipo_hospedagem)
    {
        $request->validate($this->validation);

        $tipo_hospedagem->nome = $request->get('nome');
        $tipo_hospedagem->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TipoHospedagem  $tipo_hospedagem
     * @return Response
     * @throws Exception
     */
    public function destroy(TipoHospedagem $tipo_hospedagem)
    {
        $tipo_hospedagem->delete();

        return parent::redirect();
    }
}
