<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position', 'superior', 'start_date', 'end_date',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function employees()
    {
        return $this->hasMany( Employee::class, 'superior', 'id' );
    }

    public function superior()
    {
        return $this->hasOne( Employee::class, 'id', 'superior' );
    }
}
