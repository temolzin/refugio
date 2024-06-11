<?php

namespace App\Models;

use App\Enums\TypememberEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sheltermember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = "sheltermember";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'last_name', 'mother_lastname', 'phone', 'email', 'state', 'city', 'colony' . 'address', 'postal_code', 'typemember', 'id_shelters'];
    protected $casts = ['typemember' => TypememberEnum::class];
    protected $guarded = [];
    public $timestamps = false;

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'id_shelters');
    }
}
