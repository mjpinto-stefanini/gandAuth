<?php

namespace App\Ldap;

use App\Models\User as DatabaseUser;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class LdapAttributeHandler
{
    public function handle(LdapUser $ldap, DatabaseUser $database)
    {
        $mailHM = $ldap->getFirstAttribute('mail');
        $mailGeral = $ldap->getFirstAttribute('userprincipalname');
        $mailPadrao = 'naocadastrado@hemominas.mg.gov.br';

        $database->email = $mailPadrao;
        if (isset($mailHM)) {
            $database->email = $mailHM;
        } elseif (isset($mailGeral)) {
            $database->email = $mailGeral;
        }

        $database->name = $ldap->getFirstAttribute('cn');
        $database->masp = $ldap->getFirstAttribute('samaccountname');
        $database->cpf = $ldap->getFirstAttribute('samaccountname');
    }
}
