<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'passwords', 'email','last_name','first_name','middle_name','address','department_id','city_id','state_id','country_id','zip','birthdate','date_hired'
    ];

    public function username()
    {
        return 'last_name';
    }
    protected $table = "employees";
}
