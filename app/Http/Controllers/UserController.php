<?php

namespace App\Http\Controllers;

use App\Embarque;
use App\Rol;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware(['auth']);
     }
    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        $usuarios = User::all();
        $roles = DB::table('rols')->get();

        // sleep(3);

        return view('users.index', compact('usuarios', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // modificar request
        $request->request->add(['username' => Str::slug($request->username)]);

        sleep(5);
        //
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|max:20',
            'email' => 'required|unique:users|max:60',
            'rol_id' => 'required',
            'cliente_id' => 'nullable',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->rol_id = $request['rol_id'];
        $user->cliente_id = $request['cliente_id'];
        $user->password = Hash::make($request['password']);

        $user->save();

        return back()->with('mensaje', 'Usuario Registrado Correctamente');
    }

    public function validarEmail($email)
    {
        return User::where('email', $email)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $this->authorize('viewAny', $user);
        $roles = DB::table('rols')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->authorize('viewAny', $user);
        $this->validate($request, [
            'name' => 'required|string',
            'rol_id' => 'required',
            'cliente_id' => 'nullable',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->name = $request['name'];
        $user->rol_id = $request['rol_id'];
        $user->cliente_id = $request['cliente_id'];
        $user->password = Hash::make($request['password']);

        $user->save();

        if($user->id == Auth::id())
        {
            Auth::logout();
        }


        return redirect()->action('UserController@index')->with('mensaje', 'Usuario Actualizado Correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
    }
}
