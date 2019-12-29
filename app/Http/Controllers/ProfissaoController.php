<?php

namespace App\Http\Controllers;

use App\Profissao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfissaoController extends CustomController
{
    protected $title = 'Profissão';
    protected $prefix = 'profissao';
    protected $validation = [
        'nome' => 'bail|required|between:3,50|unique:profissoes'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = Profissao::paginate();

        return parent::view('layouts.index', ['values' => $values, 'class' => Profissao::class]);
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

        $portador = new Profissao([
            'nome' => $request->get('nome')
        ]);

        $portador->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profissao  $portador
     * @return Response
     */
    public function edit(Profissao $portador)
    {
        return parent::view($this->prefix . '.edit', compact('profissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Profissao  $portador
     * @return Response
     */
    public function update(Request $request, Profissao $portador)
    {
        $request->validate($this->validation);

        $portador->nome = $request->get('nome');
        $portador->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Profissao  $portador
     * @return Response
     * @throws Exception
     */
    public function destroy(Profissao $portador)
    {
        $portador->delete();

        return parent::redirect();
    }
}
