<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $table = 'access_token';
}

