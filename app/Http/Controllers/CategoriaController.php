<?php

namespace App\Http\Controllers;

use App\Categoria;
use Exception;
use Illuminate\Http\{Request, Response};

class CategoriaController extends CustomController
{
    protected $title = 'Categoria';
    protected $prefix = 'categoria';

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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return parent::view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'bail|required|max:50|unique:categorias'
        ]);

        $categoria = new Categoria([
            'nome' => $request->get('nome')
        ]);

        $categoria->save();
        return redirect('/categoria')->with('success', 'Registro adicionado!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Categoria $categoria
     * @return Response
     */
    public function edit(Categoria $categoria)
    {
        return parent::view('categoria.edit', compact('categoria'));
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
        $request->validate([
            'nome' => 'bail|required|max:50|unique:categorias,nome,' . $categoria->id . ',id'
        ]);

        $categoria->nome = $request->get('nome');
        $categoria->save();

        return redirect('/categoria')->with('success', 'Registro atualizado!');
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

        return redirect('/categoria')->with('success', 'Registro apagado!');
    }
}
