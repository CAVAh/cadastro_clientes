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

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string|null $view
     * @param Arrayable|array $data
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
     * @param string|null $view
     * @param Arrayable|array $items
     * @param Arrayable|array $data
     * @return View|Factory|Response
     */
    protected function viewItems($view, array $items, $data = []) {
        if(isset($data['class'])) {
            $class = $data['class'];
        } else {
            $class = 'App\\' . ucwords($this->prefix, '_');
            $data['class'] = $class;
        }

        $items = $class::hydrate($items);
        $page = Paginator::resolveCurrentPage('page');

        $values = new LengthAwarePaginator($items, count($items), 15, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);

        $data['values'] = $values;
        return self::view($view, $data);
    }
}

