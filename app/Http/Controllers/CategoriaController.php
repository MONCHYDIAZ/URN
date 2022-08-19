<?php

namespace App\Http\Controllers;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{

    const ROUTE_BASE = 'categoria';

    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categoria = \App\Models\Categoria::Where('status', '=', 1)->paginate();
            return view('categorium.index', compact('categoria'))
                ->with('i', (request()->input('page', 1) - 1) * $categoria->perPage());
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route = self::ROUTE_BASE;
        try {
            $categorium = new \App\Models\Categoria();
            return view('categorium.create', compact('categorium'));
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;
        request()->validate(\App\Models\Categoria::$rules);

        try {
            $categorium = \App\Models\Categoria::create($request->all());

            return redirect()->route('categoria.index')
                ->with('success', 'Categoria creada correctamente.');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $categorium = \App\Models\Categoria::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($categorium)) {
                return view('categorium.show', compact('categorium'));
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $categorium = \App\Models\Categoria::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($categorium)) {
                return view('categorium.edit', compact('categorium'));
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Categoria $categorium)
    {
        $route = self::ROUTE_BASE;
        request()->validate(\App\Models\Categoria::$rules);

        try {
            $categorium->update($request->all());
            return redirect()->route('categoria.index')
                ->with('success', 'Categoria editada correctamente');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $categoria = \App\Models\Categoria::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($categoria)) {
                $categoria->status = 0;
                $categoria->update();
                return redirect()->route('categoria.index')
                    ->with('success', 'Categoria Eliminada correctamente');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
