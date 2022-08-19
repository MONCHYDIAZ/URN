<?php

namespace App\Http\Controllers;

/**
 * Class TipoDocumentoController
 * @package App\Http\Controllers
 */
class TipoDocumentoController extends Controller
{

    const ROUTE_BASE = 'tipo-documento';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tipoDocumentos = \App\Models\TipoDocumento::where('status', '=', 1)->paginate();

            return view('tipo-documento.index', compact('tipoDocumentos'))
                ->with('i', (request()->input('page', 1) - 1) * $tipoDocumentos->perPage());
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
            $tipoDocumento = new \App\Models\TipoDocumento();
            return view('tipo-documento.create', compact('tipoDocumento'));
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
        request()->validate(\App\Models\TipoDocumento::$rules);
        try {

            $tipoDocumento = \App\Models\TipoDocumento::create($request->all());

            return redirect()->route('tipo-documento.index')
                ->with('success', 'Tipo Documento creado correctamente.');
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
            $tipoDocumento = \App\Models\TipoDocumento::where('uuid', '=', $uuid)
                ->where('status', '=', 1)
                ->first();
            if (!empty($tipoDocumento)) {
                return view('tipo-documento.show', compact('tipoDocumento'));
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
            $tipoDocumento = \App\Models\TipoDocumento::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($tipoDocumento)) {
                return view('tipo-documento.edit', compact('tipoDocumento'));
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
     * @param  TipoDocumento $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\TipoDocumento $tipoDocumento)
    {
        try {
            request()->validate(\App\Models\TipoDocumento::$rules);
            $tipoDocumento->update($request->all());
            return redirect()->route('tipo-documento.index')
                ->with('success', 'TipoDocumento editadro correctamente ');
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
            $tipoDocumento = \App\Models\TipoDocumento::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($tipoDocumento)) {
                $tipoDocumento->status = 0;
                $tipoDocumento->update();
                return redirect()->route('tipo-documento.index')
                    ->with('success', 'TipoDocumento eliminado correctamente.');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
