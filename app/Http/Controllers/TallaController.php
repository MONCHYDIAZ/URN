<?php

namespace App\Http\Controllers;

/**
 * Class TallaController
 * @package App\Http\Controllers
 */
class TallaController extends Controller
{

    const ROUTE_BASE = 'talla';

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
        $route = self::ROUTE_BASE;

        try {
            $tallas = \App\Models\Talla::where('status', '=', 1)->paginate();
            return view('talla.index', compact('tallas'))
                ->with('i', (request()->input('page', 1) - 1) * $tallas->perPage());
        } catch (\Exception $ex) {
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
            $talla = new \App\Models\Talla();
            return view('talla.create', compact('talla'));
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
        request()->validate(\App\Models\Talla::$rules);
        try {
            $talla = \App\Models\Talla::create($request->all());
            return redirect()->route('talla.index')
                ->with('success', 'Talla creada correctamente.');
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
            $talla = \App\Models\Talla::where('status', '=', 1)->where('uuid', '=', $uuid)->first();
            if (!empty($talla)) {
                return view('talla.show', compact('talla'));
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
            $talla = \App\Models\Talla::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($talla)) {
                return view('talla.edit', compact('talla'));
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
     * @param  Talla $talla
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Talla $talla)
    {
        $route = self::ROUTE_BASE;

        try {
            request()->validate(\App\Models\Talla::$rules);
            $talla->update($request->all());
            return redirect()->route('talla.index')
                ->with('success', 'Talla editada correctamente.');
        } catch (\Exception $ex) {
            $route = self::ROUTE_BASE;
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(string $uuid)
    {
        $route = self::ROUTE_BASE;
        try {
            $talla = \App\Models\Talla::where('status', '=', '1')->where('uuid', '=', $uuid)->first();
            if (!empty($talla)) {
                $talla->status = 0;
                $talla->update();
                return redirect()->route('talla.index')
                    ->with('success', 'Talla eliminada correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
