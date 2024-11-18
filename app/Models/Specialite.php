<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    protected $table = 'specialites';

    protected $primaryKey = 'CodeSp'; // Custom primary key
    public $incrementing = false; // If the primary key is not an integer
    protected $keyType = 'string'; // If the primary key is a string

    protected $fillable = [
        'CodeSp',
        'DesignationSp',
    ];
}
