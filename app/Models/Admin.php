<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 

class Admin extends Model
{
    use hasfactory;
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
