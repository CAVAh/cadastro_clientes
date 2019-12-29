<?php

namespace App\Http\Controllers;

use App;
use App\Pais;
use Exception;
use Illuminate\Http\{Request, Response};

class PaisController extends CustomController
{
    protected $title = 'País';
    protected $prefix = 'pais';
    protected $validation = [
        'nome' => 'bail|required|between:3,50|unique:paises',
        'sigla' => 'bail|required|size:3|unique:paises'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = Pais::paginate();
        //$values = DB::table('paises')->paginate(20);

        return parent::view('layouts.index', ['values' => $values, 'class' => Pais::class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation);

        $pais = new Pais([
            'nome' => $request->get('nome'),
            'sigla' => $request->get('sigla')
        ]);

        $pais->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pais $pais
     * @return Response
     */
    public function edit(Pais $pais)
    {
        return parent::view($this->prefix . '.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pais $pais
     * @return Response
     */
    public function update(Request $request, Pais $pais)
    {
        $validation = $this->validation;
        $validation['nome'] = 'bail|required|between:3,50|unique:paises,nome,' . $pais->id . ',id';
        $validation['sigla'] = 'bail|required|size:3|unique:paises,sigla,' . $pais->id . ',id';
        $request->validate($validation);

        $pais->nome = $request->get('nome');
        $pais->sigla = $request->get('sigla');
        $pais->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pais $pais
     * @return Response
     * @throws Exception
     */
    public function destroy(Pais $pais)
    {
        $pais->delete();

        return parent::redirect();
    }
}
