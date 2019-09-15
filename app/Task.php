<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    const PRIORITY_CRITICAL = 0;
    const PRIORITY_HIGH     = 1;
    const PRIORITY_MEDIUM   = 2;
    const PRIORITY_LOW      = 3;
    
    const STATUS_PENDING    = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_COMPLETE   = 2;

    public static $priorityNames = [
        self::PRIORITY_CRITICAL => "Critical",
        self::PRIORITY_HIGH     => "High",
        self::PRIORITY_MEDIUM   => "Medium",
        self::PRIORITY_LOW      => "Low",
    ];
    
    public static $statusNames = [
        self::STATUS_PENDING    => "Pending",
        self::STATUS_INPROGRESS => "In Progress",
        self::STATUS_COMPLETE   => "Complete",
    ];
    
    protected $fillable = [
        'description',
        'priority',
        'asignee',
        'due',
        'status'
    ];

    public $timestamps = true;
    
    public function setDueAttribute($value){
        $dateValue = Carbon::parse($value);
        $this->attributes['due'] = $dateValue;
    }
    
    public function getDueAttribute(){
        return Carbon::parse($this->attributes['due']);
    }
    
    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
