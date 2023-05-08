<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthCode extends \Laravel\Passport\AuthCode
{
    public $incrementing = false;
}
