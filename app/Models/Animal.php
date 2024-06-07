<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Animal extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use SoftDeletes;

    protected $table = "animals";
    protected $primaryKey = 'id';
    protected $fillable = [
        'animal_name',
        'breed',
        'birth_date',
        'sex',
        'color',
        'weight',
        'is_sterilized',
        'entry_date',
        'origin',
        'behavior',
        'history',

    ];
    protected $guarded = [];
    public $timestamps = false;

    public function specie()
    {
        return $this->belongsTo(Specie::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('animal_gallery')->singleFile();
    }
    public function getAgeAttribute()
    {
        $birthDate = Carbon::parse($this->birth_date);
        $now = Carbon::now();

        $years = $birthDate->diffInYears($now);
        $months = $birthDate->diffInMonths($now) % 12;

        if ($years > 0) {
            return $years . ' años' . ($months > 0 ? ' y ' . $months . ' meses' : '');
        } else {
            return $months . ' meses';
        }
    }
}
