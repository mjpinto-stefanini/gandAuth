<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use LdapRecord\Auth\PasswordRequiredException;
use LdapRecord\Auth\UsernameRequiredException;
use LdapRecord\Container;
use LdapRecord\ContainerException;
use LdapRecord\LdapRecordException;
use LdapRecord\Models\ActiveDirectory\User;
use LdapRecord\Query\ObjectNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use \Illuminate\Http\JsonResponse;


class LdapController extends Controller
{

    /**
     * Valida Usuário AD retornando true ou false
     *
     * @param string $username
     * @param string $password
     * @return bool
     * @throws PasswordRequiredException
     * @throws UsernameRequiredException
     * @throws ContainerException
     * @throws ObjectNotFoundException
     */
    public function validateLdapUserWeb(string $username, string $password): bool
    {
        $connection = Container::getConnection('default');
        $user = User::findByOrFail('samaccountname', $username);

        if ($connection->auth()->attempt($user->getDn(), $password))
            return true;

        return false;
    }

    /**
     * Valida Usuário AD através de usuário (masp) e senha
     *
     * @param Request $request
     * @param $masp
     * @return JsonResponse
     */
    public function validateLdapUser(Request $request, $masp): JsonResponse
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

    /**
     * Retorna informações de usuário AD
     *
     * @param string $masp
     * @return JsonResponse
     */
    public function searchLdapUser(string $masp): JsonResponse
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

                    if (isset($ldapuser['mail'][0])) {
                        $mail = $ldapuser['mail'][0];
                    } else if (isset($ldapuser['userprincipalname'][0])) {
                        $mail = $ldapuser['userprincipalname'][0];
                    } else {
                        $mail = 'naocadastrado@hemominas.mg.gov.br';
                    }

                    return response()->json([
                        "status" => true,
                        "message"   => "User found",
                        "name" => $ldapuser['cn'][0],
                        "email" => $mail,
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
