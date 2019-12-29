<?php

namespace App\Http\Controllers;

use App\Categoria;
use Exception;
use Illuminate\Http\{Request, Response};

class CategoriaController extends CustomController
{
    protected $title = 'Categoria';
    protected $prefix = 'categoria';
    protected $validation = [
        'nome' => 'bail|required|between:3,50|unique:categorias'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = Categoria::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => Categoria::class]);
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

        $categoria = new Categoria([
            'nome' => $request->get('nome')
        ]);

        $categoria->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Categoria $categoria
     * @return Response
     */
    public function edit(Categoria $categoria)
    {
        return parent::view($this->prefix . '.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Categoria $categoria
     * @return Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validation = $this->validation;
        $validation['nome'] = 'bail|required|between:3,50|unique:categorias,nome,' . $categoria->id . ',id';
        $request->validate($validation);

        $categoria->nome = $request->get('nome');
        $categoria->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Categoria $categoria
     * @return Response
     * @throws Exception
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return parent::redirect();
    }
}
