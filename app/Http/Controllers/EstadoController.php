<?php

namespace App\Http\Controllers;

use App;
use App\Estado;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Request, Response};

class EstadoController extends CustomController
{
    protected $title = 'Estado';
    protected $prefix = 'estado';
    protected $validation = [
        'nome'    => 'bail|required|between:3,50',
        'uf'      => 'bail|required|size:2',
        'pais_id' => 'bail|required|exists:paises,id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = DB::table('estados')
            ->join('paises', 'paises.id', '=', 'estados.pais_id')
            ->selectRaw('estados.*, paises.nome as pais')->paginate();

        return parent::viewItems('layouts.index', $values->items());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $paises = App\Pais::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', ['paises' => $paises]);
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

        $estado = new Estado([
            'nome'    => $request->get('nome'),
            'uf'      => strtoupper($request->get('uf')),
            'pais_id' => $request->get('pais_id')
        ]);

        $estado->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Estado $estado
     * @return Response
     */
    public function edit(Estado $estado)
    {
        $paises = App\Pais::all(['id', 'nome']);

        return parent::view($this->prefix . '.edit', compact('estado', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Estado $estado
     * @return Response
     */
    public function update(Request $request, Estado $estado)
    {
        $request->validate($this->validation);

        $estado->nome    = $request->get('nome');
        $estado->uf      = strtoupper($request->get('uf'));
        $estado->pais_id = $request->get('pais_id');
        $estado->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Estado $estado
     * @return Response
     * @throws Exception
     */
    public function destroy(Estado $estado)
    {
        $estado->delete();

        return parent::redirect();
    }
}
