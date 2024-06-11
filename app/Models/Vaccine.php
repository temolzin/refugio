<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;
    protected $table = "vaccines";
    protected $primaryKey= 'vaccine_id';
    protected $fillable=['shelter_id','name','type','description'];
    protected $guarded= [];
    public $timestamps=false;

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'shelters_id');
    }
}
