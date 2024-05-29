<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey= 'id';
    protected $fillable=['name','last_name','phone','email','email_verified_at','password'];
    protected $guarded= [];
    public $timestamps=false;

}
