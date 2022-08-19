<?php

namespace App\Http\Controllers;


/**
 * Class RolController
 * @package App\Http\Controllers
 */
class RolController extends Controller
{

    const ROUTE_BASE = 'rol';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $rols = \App\Models\Rol::where('status', '=', 1)->paginate();
            return view('rol.index', compact('rols'))
                ->with('i', (request()->input('page', 1) - 1) * $rols->perPage());
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
            $rol = new \App\Models\Rol();
            return view('rol.create', compact('rol'));
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
        request()->validate(\App\Models\Rol::$rules);
        try {

            $rol = \App\Models\Rol::create($request->all());

            return redirect()->route('rol.index')
                ->with('success', 'Rol creado  correctamente.');
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
            $rol = \App\Models\Rol::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($rol)) {
                return view('rol.show', compact('rol'));
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
            $rol = \App\Models\Rol::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($rol)) {
                return view('rol.edit', compact('rol'));
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
     * @param  Rol $rol
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Rol $rol)
    {

        request()->validate(\App\Models\Rol::$rules);
        try {

            $rol->update($request->all());

            return redirect()->route('rol.index')
                ->with('success', 'Rol editado correctamente');
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
            $rol = \App\Models\Rol::where('uuid', '=', $uuid)->where('status', '=', 1)->first();

            if (!empty($rol)) {
                $rol->status = 0;
                $rol->update();
                return redirect()->route('rol.index')
                    ->with('success', 'Rol eliminada correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
