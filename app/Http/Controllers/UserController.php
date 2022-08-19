<?php

namespace App\Http\Controllers;


/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    const ROUTE_BASE = 'user';

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'update_password', 'update_password_action']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = \App\Models\User::where('status', '=', 1)
                ->where('users.id', '!=', auth()->id())
                ->orderBy('created_at', 'Desc')
                ->paginate();

            return view('user.index', compact('users'))
                ->with(['rol:id,nombre'])
                ->with(['TipoDocumento:id,abreviatura'])
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
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
            $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
            $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
            $user = new \App\Models\User();
            return view('user.create', compact('user', 'rols', 'tipo_documentos'));
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
        $rules = \App\Models\User::$rules;

        $rules['fecha_nacimiento'] = [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                if ($value >= date('Y-m-d')) {
                    $fail($attribute . ' the date entered cannot be greater than the current date');
                }
            },
        ];

        request()->validate($rules);
        try {
            $data = $request->all();
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['documento']);
            $user = \App\Models\User::create($data);

            return redirect()->route('user.index')
                ->with('success', 'Usuario  creado correctamente.');
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
            $user =  \Illuminate\Support\Facades\DB::table('users')
                ->join('rol', 'users.rol_id', '=', 'rol.id')
                ->join('tipo_documento', 'users.tipo_documento_id', '=', 'tipo_documento.id')
                ->select('users.*', 'tipo_documento.abreviatura', 'rol.nombre')
                ->where('users.uuid', '=', $uuid)
                ->where('users.status', '=', 1)
                ->first();
            if (!empty($user)) {
                $user->edad =  \App\Services\Utils::calculate_edad($user->fecha_nacimiento)->data->y ?? 0;
                return view('user.show', compact('user'));
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
            $rols =  \App\Models\Rol::where('status', '=', 1)->pluck('nombre', 'id');
            $tipo_documentos = \App\Models\TipoDocumento::where('status', '=', 1)->pluck('nombre', 'id');
            $user = \App\Models\User::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($user)) {
                return view('user.edit', compact('user', 'rols', 'tipo_documentos'));
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
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\User $user)
    {

        $rules = \App\Models\User::$rules;

        $rules['fecha_nacimiento'] = [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                if ($value >= date('Y-m-d')) {
                    $fail($attribute . ' the date entered cannot be greater than the current date');
                }
            },
        ];

        request()->validate($rules);
        try {

            $user->update($request->all());

            return redirect()->route('user.index')
                ->with('success', 'Usuario editado Correctamente');
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
            $user = \App\Models\User::where('uuid', '=', $uuid)->where('status', '=', 1)->first();
            if (!empty($user)) {
                $user->status = 0;
                $user->update();
                return redirect()->route('user.index')
                    ->with('success', 'Usuario Eliminado Correctamente');
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

            $users = \App\Models\User::where('status', '=', 1)
                ->where('id', '!=', auth()->id())
                ->where('email', 'LIKE', '%' . $data['email'] . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate();

            return view('user.index', compact('users'))
                ->with(['rol:id,nombre'])
                ->with(['TipoDocumento:id,abreviatura'])
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * update_password
     *
     * @return void
     */
    public function update_password()
    {
        $route = self::ROUTE_BASE;
        try {
            return view('user.update_password');
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }

    /**
     * update_password_action
     *
     * @param  mixed $request
     * @return void
     */
    public function update_password_action(\Illuminate\Http\Request $request)
    {
        $route = self::ROUTE_BASE;
        request()->validate([
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        try {
            $user = \App\Models\User::where([
                ['id', (int)auth()->id()],
                ['status', 1]
            ])->first();

            if (!empty($user)) {
                $data = $request->all();
                $user->password = \Illuminate\Support\Facades\Hash::make($data['password']);
                $user->update();
                return view('home');
            } else {
                return view('errors.notfound', compact('route'));
            }
        } catch (\Exception $ex) {
            $error = $ex->getMessage();
            return view('errors.error', compact('route', 'error'));
        }
    }
}
