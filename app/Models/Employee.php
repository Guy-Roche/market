<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
        protected $guarded = [];
    
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'phone',
    //     'address',
    //     'experience',
    //     'image',
    //     'salary',
    //     'vacation',
    //     'city',
    // ];

    public function advance()
    {
        return $this->belongsTo(AdvanceSalary::class, 'id','employee_id');
    }
}

