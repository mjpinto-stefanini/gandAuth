<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use LdapRecord\Container;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\ActiveDirectory\User;
use Symfony\Component\HttpFoundation\Request;


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

    public function validateLdapUserWeb(string $username, string $password): bool
    {
        $connection = Container::getConnection('default');
        $user = User::findByOrFail('samaccountname', $username);

        if ($connection->auth()->attempt($user->getDn(), $password))
            return true;

        return false;
    }

    public function validateLdapUser(Request $request, $masp)
    {
        $password = $request->password;

        if ($masp && $password) {

            try {
                $connection = Container::getConnection('default');
                $user = User::findByOrFail('samaccountname', $masp);

                if ($connection->auth()->attempt($user->getDn(), $password)) {
                    return response()->json([
                        "status" => true,
                        "message" => "User credentials are valid"
                    ], 200);
                }
                return response()->json([
                    "status" => false,
                    "message" => "Credentials are not valid"
                ], 404);

            } catch (Exception|LdapRecordException $e) {
                return response()->json([
                    "status" => false,
                    'message' => $e->getMessage(),
                ], 400);
            }

        } else {
            return response()->json([
                "status" => false,
                "message" => "Bad request"
            ], 400);
        }
    }

    public function searchLdapUser(string $masp)
    {
        try {
            $connection = Container::getConnection('default');

            if ($connection->auth()->attempt(env('LDAP_DEFAULT_USERNAME', 'HEMOMINAS'), env('LDAP_DEFAULT_PASSWORD'))) {

                $user = $connection->query()->where('samaccountname', '=', $masp)->get();

                if(!$user) {
                    return response()->json([
                        "status" => false,
                        'message'   => 'Record not found',
                    ], 404);
                }

                try {
                    $ldapuser = $user[0];

                    return response()->json([
                        "status" => true,
                        "message"   => "User found",
                        "name" => $ldapuser['cn'][0],
                        "email" => $ldapuser['userprincipalname'][0],
                        "masp" => $ldapuser['samaccountname'][0],
                    ], 200);
                } catch (Exception $e) {
                    return response()->json([
                        "status" => false,
                        'message'   => $e->getMessage(),
                    ], 400);
                }

            } else {
                return response()->json([
                    "status" => false,
                    'message'   => 'Invalid search credentials',
                ], 404);
            }

        } catch (Exception|LdapRecordException $e) {

            return response()->json([
                "status" => false,
                'message'   => $e->getMessage(),
            ], 400);
        }
    }
}
