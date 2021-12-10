<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Session;


class RegisterController extends Controller
{

    use RegistersUsers;

   
    protected $redirectTo = '/registre';

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'numImm' => 'required|string|max:6|unique:users',
            'nom' => 'required|string|max:255|',
            'prenom' => 'string|max:255|',
            'type' => 'required|string|max:255|',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    
    protected function create(array $data)
    {
        return User::create([
            'numImm' => $data['numImm'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'type' => $data['type'],
            'password' => bcrypt($data['password']),
        ]);
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Session::flash('succes','ajout utilisateur avec succés');
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    public function userListe(){
        $listeUtilisateur=User::all();
        return view('auth/register')->with(['userliste'=>$listeUtilisateur]);
    }

    public function userDelete($numImm){
        $userDelete=User::where('numImm',$numImm)->delete();
        if(is_null($userDelete)){
            Session::flash('failed','modification utilisateur non succés');
        }else{
            Session::flash('succes','suppression utilisateur avec succés');
            return redirect()->back();
        }
    }

    public function userEdit($numImm){
        $userEdit=User::where('numImm',$numImm)->first();
        $listeUtilisateur=User::all();
        //return view('auth/update')->with(['userEdit'=>$userEdit]);
        return view('auth/register')->with(['userEdit'=>$userEdit,'userliste'=>$listeUtilisateur]);
    }

    public function userUpdate(Request $request, $numImm){
        $this->validate($request,[
            'numImm' => 'required|string|max:6|unique:users',
            'nom' => 'required|string|max:255|',
            'prenom' => 'string|max:255|',
            'type' => 'required|string|max:255|',
        ]);

        $data=[
            'numImm'=>$request->numImm,
            'nom'=>$request->nom,
            'prenom'=>$request->prenom,
            'type'=>$request->type,
        ];
    
        $userUpdate=User::where('numImm',$numImm)->update($data);
        if(is_null($userUpdate)){
            Session::flash('failed','modification utilisateur non succés');
        }else{
            Session::flash('succes','modification utilisateur avec succés');
            return redirect()->route('registre');
        }
     }

}
