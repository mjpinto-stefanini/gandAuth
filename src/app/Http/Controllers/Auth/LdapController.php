<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use LdapRecord\Container;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\ActiveDirectory\User;


class LdapController extends Controller
{
    public function index()
    {
        try {
            $username = '03860313';
            $password = '03860313';

            $login = $this->validateLdapUser($username, $password);

            var_dump($login);

        } catch (Exception|LdapRecordException $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";
        }
    }

    public function validateLdapUser(string $username, string $password): bool
    {
        $connection = Container::getConnection('default');
        $user = User::findByOrFail('samaccountname', $username);

        if ($connection->auth()->attempt($user->getDn(), $password))
            return true;

        return false;
    }

    public function searchLdapUser()
    {
        try {
            $connection = Container::getConnection('default');

            if ($connection->auth()->attempt(env('LDAP_DEFAULT_USERNAME', 'HEMOMINAS'), env('LDAP_DEFAULT_PASSWORD'))) {
                echo 'Sucesso! Credenciais válidas';

                $user = $connection->query()->where('sAMAccountname', '=', '10725331')->get();

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
