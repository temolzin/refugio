<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey= 'id';
    protected $fillable=['nombre','last_name','maternal_lastName','phone','email','email_verified_at','password'];
    protected $guarded= [];
    public $timestamps=false;

}
