<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class CustomController extends Controller
{
    protected $title;
    protected $prefix;
    protected $validation;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return self::view($this->prefix . '.create');
    }

    /**
     * @param  string  $key
     * @param  string  $msg
     * @return Response
     */
    protected function redirect($key = 'success', $msg = '')
    {
        $func = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        $value = $msg;

        if(empty($value)) {
            switch ($func) {
                case 'store':
                    $value = 'Record added!';
                    break;
                case 'destroy':
                    $value = 'Record deleted!';
                    break;
                case 'update':
                    $value = 'Record updated!';
                    break;
            }
        }

        return redirect('/' . $this->prefix)->with($key, __($value));
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  Arrayable|array  $data
     * @return View|Factory|Response
     */
    protected function view($view, $data = [])
    {
        $viewData = ['title' => $this->title, 'prefix' => $this->prefix];

        if (!empty($data)) {
            $viewData = array_merge($viewData, $data);
        }

        return view($view, $viewData);
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  Arrayable|array  $items
     * @param  Arrayable|array  $data
     * @return View|Factory|Response
     */
    protected function viewItems($view, array $items, $data = [])
    {
        if (isset($data['class'])) {
            $class = $data['class'];
        } else {
            $class         = 'App\\'.ucwords($this->prefix, '_');
            $data['class'] = $class;
        }

        $items = $class::hydrate($items);
        $page  = Paginator::resolveCurrentPage('page');

        $values = new LengthAwarePaginator($items, count($items), 15, $page, [
            'path'     => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);

        $data['values'] = $values;
        return self::view($view, $data);
    }
}

