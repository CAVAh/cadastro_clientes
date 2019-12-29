<?php

namespace App\Http\Controllers;

use App\Portador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PortadorController extends CustomController
{
    protected $title = 'Portador';
    protected $prefix = 'portador';
    protected $validation = [
        'nome' => 'bail|required|between:3,30|unique:portadores'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = Portador::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => Portador::class]);
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

        $portador = new Portador([
            'nome' => $request->get('nome')
        ]);

        $portador->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Portador  $portador
     * @return Response
     */
    public function edit(Portador $portador)
    {
        return parent::view($this->prefix . '.edit', compact('portador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Portador  $portador
     * @return Response
     */
    public function update(Request $request, Portador $portador)
    {
        $request->validate($this->validation);

        $portador->nome = $request->get('nome');
        $portador->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Portador  $portador
     * @return Response
     * @throws Exception
     */
    public function destroy(Portador $portador)
    {
        $portador->delete();

        return parent::redirect();
    }
}
