<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Std extends Model
{
    use HasFactory;
    protected $table = 'class'; 
    protected $fillable = ['standard', 'capacity'];

    public function students()
    {
        return $this->belongsTo(Student::class, 'detailable');
    }
}
