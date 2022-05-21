<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ], [
            'name.required' => 'Campo nome é obrigatório',
            'name.string' => 'Formato inválido para o nome.',
            'name.max' => 'Campo nome não pode ter mais que 200 caracteres.',
            'email.required' => 'Campo email é obrigatório',
            'email.string' => 'Formato inválido para o email.',
            'email.email' => 'Insira um email válido.',
            'email.max' => 'Campo email não pode ter mais que 200 caracteres.',
            'email.unique' => 'Já existe um usuário com esse email.',
            'password.required' => 'Campo senha é obrigatório.',
            'password.string' => 'Formato inválido para o nome.',
            'password.min' => 'Senha deve ter no mínimo 4 caracteres.',
            'password.confirmed' => 'Senhas não conferem.',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(){
        return view('auth.register');
    }

    public function saveRegistration(Request $request){
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);

        $validator = $this->validator($data);

        //die(print_r($validator));
        if($validator->fails()){
            return redirect()->route('register')
                             ->withErrors($validator)
                             ->withInput();
        }
        else{
            $this->create($data);

            return redirect()->route('login')->with('registro_sucesso', 'Registro feito com sucesso! Efetue o login para utilizar a plataforma.');
        }
    }
}
