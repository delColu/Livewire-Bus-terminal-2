<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    protected $table = 'admins';

    protected $cast = [ 
        'password'=>'encrypted'
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
