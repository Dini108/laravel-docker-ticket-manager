<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'events';

    protected $dates = [
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'finish_time',
    ];

    protected $fillable = [
        'name',
        'start_time',
        'finish_time',
        'place_id',
        'created_at',
        'updated_at',
        'price',
        'description',
        'performer_id'
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function performer()
    {
        return $this->belongsTo(Performer::class, 'performer_id');
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'event_id', 'id');
    }

    /**
     * @param $value
     * @return string
     */
    public function getFinishTimeAttribute($value): string
    {
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @param $value
     * @return string
     */
    public function getStartTimeAttribute($value): string
    {
        $date = Carbon::parse($value);
        return $date->format('Y-m-d H:i:s');
    }

}
