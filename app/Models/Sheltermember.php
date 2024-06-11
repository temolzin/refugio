<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sheltermember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use SoftDeletes;

    protected $table = "sheltermember";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'last_name', 'mother_lastname', 'phone', 'email', 'state', 'city', 'colony' . 'address', 'postal_code', 'typemember', 'id_shelters'];
    protected $guarded = [];
    public $timestamps = false;

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'id_shelters');
    }
}
