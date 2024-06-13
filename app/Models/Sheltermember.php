<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sheltermember extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia,SoftDeletes;

    protected $table = "shelter_member";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'last_name', 'mother_lastname', 'phone', 'email', 'state', 'city', 'colony' . 'address', 'postal_code', 'type_member', 'shelter_id'];
    const TYPEMEMBER_STAFF = 'Personal';
    const TYPEMEMBER_DONOR = 'Donante';
    const TYPEMEMBER_GODFATHER = 'Padrino';
    const TYPEMEMBER_ADOPTER = 'Adoptante';

    const TYPEMEMBER = [self::TYPEMEMBER_STAFF, self::TYPEMEMBER_DONOR, self::TYPEMEMBER_GODFATHER, self::TYPEMEMBER_ADOPTER];

    protected $guarded = [];
    public $timestamps = false;

    public function shelter()
    {
        return $this->belongsTo(Shelter::class, 'id_shelters');
    }
}
