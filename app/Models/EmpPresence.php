<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpPresence extends Model
{
    /** @use HasFactory<\Database\Factories\EmpPresenceFactory> */
    use HasFactory;

    protected $table = 'emp_presence';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
