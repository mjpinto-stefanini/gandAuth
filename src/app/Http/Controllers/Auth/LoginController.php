<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LdapRecord\Laravel\Auth\ListensForLdapBindFailure;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ListensForLdapBindFailure;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'masp';
    }

    protected function credentials(Request $request)
    {
        return [
            'samaccountname' => $request->get('masp'),
            'password'       => $request->get('password'),
            'fallback' => [
                'masp' => $request->get('masp'),
                'password' => $request->get('password'),
            ],
        ];
    }


    public function login(Request $request)
    {
        $request->validate([
            'masp' => "required|string",
            'password' => "required|string"
        ]);

        $masp = $request->get('masp');
        $password = $request->get('password');

        $ldapCredentials = [
            'samaccountname' => $masp,
            'password' => $password,
        ];

        $message = 'Usuário não encontrado';

        //Ldap auth
        if (Auth::guard('web')->attempt($ldapCredentials)) {
            $user = Auth::user();

            // Returns true:
            $user instanceof \LdapRecord\Models\Model;
            return redirect()->intended($this->redirectTo);
        } else {
            $message = 'Usuário não autenticado na Rede da Hemominas. Favor verificar!';
        }

        //Database auth
        $user = User::where('masp', $masp)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                $request->session()->regenerate();
                $request->session()->put('user', $user);
                Auth::login($user);

                return redirect()->intended($this->redirectTo);
            } else {
                $message = 'Usuário e/ou senha incorretos.';
            }
        }

        return back()->withErrors([
            'masp' => $message,
        ])->onlyInput('masp');
    }

    /**
     * Recebe logout do client
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request) {
        Auth::logout();
        $redirectUrl = $request->redirect_url ?: null;

        //TODO verificar o logout de todos so clients - verificado com o Miniarmazem
        // Redireciona para o client que pediu o logout
        if ($redirectUrl)
            return redirect($redirectUrl);

        return redirect('/home');
    }

}
