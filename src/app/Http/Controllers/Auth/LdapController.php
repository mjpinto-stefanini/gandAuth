<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use LdapRecord\Container;
use LdapRecord\Connection;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\Entry;
use App\Ldap\User;


class LdapController extends Controller
{
    public function index()
    {
        try {

            $connection = Container::getConnection('default');

            if ($connection->auth()->attempt(env('LDAP_DEFAULT_USERNAME', 'HEMOMINAS'), env('LDAP_DEFAULT_PASSWORD'))) {
                echo 'Sucesso! Credenciais válidas';

                $user = User::where('sAMAccountname', '=', '10725331')->get();

                if ($user) {
                    print_r($user);
                } else {
                    echo 'Usuário não encontrado.';
                }


            } else {
                echo 'Erro! Credenciais inválidas';
            }


        } catch (Exception|LdapRecordException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }
}
