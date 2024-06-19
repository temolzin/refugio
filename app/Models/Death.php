<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Death extends Model
{
    use HasFactory;

    protected $table = 'deaths';
    protected $primaryKey = 'death_id';
    protected $fillable = ['animal_id', 'date', 'cause'];
    protected $guarded= [];
    public $timestamps = false;

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
    

}

class Post extends Model{
    use SoftDeletes;
}
