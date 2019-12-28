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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return parent::view('pais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @return Response
     */
    public function store(Request $req)
    {
        $req->validate([
            'nome' => 'bail|required|max:50|unique:paises',
            'sigla' => 'bail|required|max:3'
        ]);

        $pais = new Pais([
            'nome' => $req->get('nome'),
            'sigla' => $req->get('sigla')
        ]);

        $pais->save();
        return redirect('/pais')->with('success', 'Registro adicionado!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pais $pais
     * @return Response
     */
    public function edit(Pais $pais)
    {
        return parent::view('pais.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $req
     * @param Pais $pais
     * @return Response
     */
    public function update(Request $req, Pais $pais)
    {
        $req->validate([
            'nome' => 'bail|required|max:50|unique:paises,nome,' . $pais->id . ',id',
            'sigla' => 'bail|required|max:3'
        ]);

        $pais->nome = $req->get('nome');
        $pais->sigla = $req->get('sigla');
        $pais->save();

        return redirect('/pais')->with('success', 'Registro atualizado!');
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

        return redirect('/pais')->with('success', 'Registro apagado!');
    }
}
