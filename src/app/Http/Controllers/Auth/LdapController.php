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

                $query = $connection->query();
                $record = $query->findByOrFail('samaccountname', '10725331');

                if ($record) {
                    print_r($record);
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
