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
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = "animals";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
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
    const SEX_MALE ='Macho';
    const SEX_FEMALE ='Hembra';

    const ORIGIN_RESCUED ='Rescatado';
    const ORIGIN_TRANSFERRRED ='Transferido';
    const ORIGIN_ABANDONED ='Abandonado';

    const BEHAVIOR_FRIENDLY = 'Amigable';
    const BEHAVIOR_SHY = 'Tímido';
    const BEHAVIOR_AGGRESSIVE = 'Agresivo';

    const ORIGINS = [self::ORIGIN_RESCUED, self::ORIGIN_TRANSFERRRED, self::ORIGIN_ABANDONED];
    const BEHAVIORS = [self::BEHAVIOR_FRIENDLY, self::BEHAVIOR_SHY, self::BEHAVIOR_AGGRESSIVE];
    const SEXES = [self::SEX_MALE, self::SEX_FEMALE];

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
