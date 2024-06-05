<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Shelter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'shelters';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'phone',
        'facebook',
        'tiktok',
        'state',
        'city',
        'colony',
        'address',
        'postal_code'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
