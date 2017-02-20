<?php

namespace App\Http\Controllers;
use Laracasts\Flash\Flash;
use App\User;

use Illuminate\Http\Request;


class usuariosController extends Controller
{
    //

    public function index(){

        //$users= User::all();
        $users=User::orderBy('id','ASC')->paginate(5);

        //return view('admin.users.index',$users);
        return view('admin.users.index')->with('users',$users); //users nombre de var en la vista $users var con los valores obtenidos desde la bd
    }

    //http://127.0.0.1:8000/admin/users/create
    public function create(){
    	return view('admin.users.create');
    }
    
    public function store(Request $request){
    	
    	$user=new User($request->all());
    	$user->password=bcrypt($request->password);
    	$user->save();
        flash('Se ah registrado con exito a ' .$user->name, 'success')->important();
        //Flash::success("Se ah registrado con exito a " .$user->name);
        return redirect()->route('admin.users.index');


    }

    public function destroy($id){
        $user=User::find($id);
        $user->delete($user);
        Flash::warning('Se elimino correctamente el usuario '. $user->name);
        return redirect()->route('users.index');
    }

}
