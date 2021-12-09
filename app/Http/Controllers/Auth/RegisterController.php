<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{

    use RegistersUsers;

   
    protected $redirectTo = '/registre';

    
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'numImm' => 'required|string|max:6|',
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

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

   /* public function userListe(){
        $listeUtilisateur=User::all();
        //dd($listeUtilisateur);
        return view('auth/register')->with(['userliste'=>$listeUtilisateur]);
    }

    public function userDelete($numImm){
        $userDelete=User::where('numImm',$numImm)->delete();
        return redirect()->back();
    }

    public function userEdit($numImm){
        $userDelete=User::where('numImm',$numImm)->first();
        return redirect()->back();
    }*/

}
