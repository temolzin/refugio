<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VetAppointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'animal_id',
        'appointment_date_and_time',
        'reason_for_appointment',
        'appointment_status',
        'observations'
    ];


    const STATUS_EARRING ='Pendiente';
    const STATUS_COMPLETED ='Finalizada'; 
    const STATUS_CANCELLED ='Cancelada';

    const APPOINTMENT_STATUS = [self::STATUS_EARRING, self::STATUS_COMPLETED, self::STATUS_CANCELLED];
    protected $dates = ['deleted_at'];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}