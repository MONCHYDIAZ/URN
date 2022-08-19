<?php

namespace App\Http\Controllers;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    const ROUTE_BASE = 'producto';

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
            $productos = \App\Models\Producto::where('status', 1)->paginate();
            $categorias = \App\Models\categoria::where('status', 1)->pluck('nombre', 'id');
            return view('producto.index', compact('productos', 'categorias'))
                ->with(['categorium:id,nombre'])
                ->with('i', (request()->input('page', 1) - 1) * $productos->perPage(), 'categorium:id,nombre');
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
        try {
            $producto = new \App\Models\Producto();
            $categorias = \App\Models\categoria::where('status', '=', 1)->pluck('nombre', 'id');
            $tallas = \App\Models\Talla::where('status', '=', 1)->get(['id', 'nombre']);

            return view('producto.create', compact('producto', 'categorias', 'tallas'));
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
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
        request()->validate(\App\Models\Producto::$rules);
        try {
            $data = $request->all();

            $producto = \App\Models\Producto::create($data);
            if (!empty($data['tallas'])) {
                $producto->tallasProductos()->sync($data['tallas']);
            }
            return redirect()->route('producto.index')
                ->with('success', 'Producto creado correctamente.');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
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
            $producto = \App\Models\Producto::where('uuid', $uuid)
                ->where('status',  1)
                ->with(['categorium:id,nombre', 'tallasProductos:id,nombre'])
                ->first();

            return view('producto.show', compact('producto'));
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
            $producto = \App\Models\Producto::where('uuid', '=', $uuid)
                ->where('status', '=', 1)
                ->with(['tallasProductos:id,nombre'])
                ->first();
            if (!empty($producto)) {
                $tallas = $producto->tallasProductos->toArray();
                unset($producto->tallasProductos);
                $producto->tallas = !empty($tallas) ? array_column($tallas, 'id') : [];
                $categorias = \App\Models\categoria::where('status', '=', 1)->pluck('nombre', 'id');
                $tallas = \App\Models\Talla::where('status', '=', 1)->get(['id', 'nombre']);
                return view('producto.edit', compact('producto', 'tallas', 'categorias'));
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
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Producto $producto)
    {
        try {
            request()->validate(\App\Models\Producto::$rules);
            $data = $request->all();
            $producto->update($request->all());
            if (!empty($data['tallas'])) {
                $producto->tallasProductos()->sync($data['tallas']);
            }
            return redirect()->route('producto.index')
                ->with('success', 'Producto editado correctamente.');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
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
            $producto = \App\Models\Producto::where('uuid', $uuid)->where('status', 1)->first();
            if (!empty($producto)) {
                $producto->status = 0;
                $producto->update();
                return redirect()->route('producto.index')
                    ->with('success', 'Producto eliminado correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * search
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function search(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;

        try {
            $data = $request->all();

            $productos = \App\Models\Producto::where('status', 1)
                ->where('id_categoria', $data['id_categoria'])
                ->orderBy('created_at', 'DESC')
                ->paginate();
            $categorias = \App\Models\categoria::where('status', 1)->pluck('nombre', 'id');

            return view('producto.index', compact('productos', 'categorias'))
                ->with(['categorium:id,nombre'])
                ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
