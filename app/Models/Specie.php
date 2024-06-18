<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specie extends Model
{
    use SoftDeletes;

    protected $table = "species";
    protected $primaryKey= 'id';
    protected $fillable=['name','description','id_shelters'];
    protected $guarded= [];
    public $timestamps=false;
    
    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'id_shelters');
    }
}
