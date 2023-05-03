<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use LdapRecord\Container;
use LdapRecord\Connection;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\Entry;


class LdapController extends Controller
{
    public function index()
    {
        try {

            $connection = Container::getConnection('default');

            if ($connection->auth()->attempt(env('LDAP_DEFAULT_USERNAME', 'HEMOMINAS'), env('LDAP_DEFAULT_PASSWORD'))) {
                echo 'Sucesso! Credenciais válidas';
            } else {
                echo 'Erro! Credenciais inválidas';
            }


        } catch (Exception|LdapRecordException $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }
}
