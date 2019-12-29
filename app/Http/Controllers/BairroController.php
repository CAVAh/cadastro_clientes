<?php

namespace App\Http\Controllers;

use App\Bairro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BairroController extends CustomController
{
    protected $title = 'Bairro';
    protected $prefix = 'bairro';
    protected $validation = [
        'nome' => 'bail|required|between:3,50|unique:bairros'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = Bairro::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => Bairro::class]);
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

        $bairro = new Bairro([
            'nome' => $request->get('nome')
        ]);

        $bairro->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bairro  $bairro
     * @return Response
     */
    public function edit(Bairro $bairro)
    {
        return parent::view($this->prefix . '.edit', compact('bairro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Bairro  $bairro
     * @return Response
     */
    public function update(Request $request, Bairro $bairro)
    {
        $request->validate($this->validation);

        $bairro->nome = $request->get('nome');
        $bairro->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bairro  $bairro
     * @return Response
     * @throws Exception
     */
    public function destroy(Bairro $bairro)
    {
        $bairro->delete();

        return parent::redirect();
    }
}
