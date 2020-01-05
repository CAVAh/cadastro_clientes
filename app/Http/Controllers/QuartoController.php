<?php

namespace App\Http\Controllers;

use App;
use App\Quarto;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Request, Response};

class QuartoController extends CustomController
{
    protected $title = 'Quarto';
    protected $prefix = 'quarto';
    protected $validation = [
        'nome' => 'bail|required|max:50|unique:quartos',
        'categoria_id' => 'bail|required|exists:categorias,id'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $values = DB::table('quartos')
            ->join('categorias', 'categorias.id', '=', 'quartos.categoria_id')
            ->selectRaw('quartos.id, quartos.categoria_id, quartos.nome')
            ->selectRaw('CASE WHEN multiplas_hosp = 1 THEN "Sim" ELSE "Não" END as multiplas_hosp, categorias.nome as categoria')->paginate();

        return parent::viewItems('layouts.index', $values->items());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categorias = App\Categoria::all(['id', 'nome']);

        return parent::view($this->prefix . '.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $req
     * @return Response
     */
    public function store(Request $req)
    {
        $req->validate($this->validation);

        $multiplas_hosp = 0;
        if ($req->has('multiplas_hosp')) {
            $multiplas_hosp = 1;
        }

        $quarto = new Quarto([
            'nome' => $req->get('nome'),
            'multiplas_hosp' => $multiplas_hosp,
            'categoria_id' => $req->get('categoria_id')
        ]);

        $quarto->save();
        return parent::redirect();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quarto $quarto
     * @return Response
     */
    public function edit(Quarto $quarto)
    {
        $categorias = App\Categoria::all(['id', 'nome']);

        return parent::view($this->prefix . '.edit', compact('quarto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $req
     * @param Quarto $quarto
     * @return Response
     */
    public function update(Request $req, Quarto $quarto)
    {
        $validation = $this->validation;
        $validation['nome'] = 'bail|required|max:50|unique:quartos,nome,' . $quarto->id . ',id';
        $req->validate($validation);

        $multiplas_hosp = 0;
        if ($req->has('multiplas_hosp')) {
            $multiplas_hosp = 1;
        }

        $quarto->nome = $req->get('nome');
        $quarto->categoria_id = $req->get('categoria_id');
        $quarto->multiplas_hosp = $multiplas_hosp;
        $quarto->save();

        return parent::redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quarto $quarto
     * @return Response
     * @throws Exception
     */
    public function destroy(Quarto $quarto)
    {
        $quarto->delete();

        return parent::redirect();
    }
}
