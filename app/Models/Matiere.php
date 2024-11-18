<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $table = 'matieres';

    protected $primaryKey = 'CodeMat';

    public $incrementing = false; // Since CodeMat is not auto-incremented
    public $keyType = 'string';  // Adjust if primary key is a string

    protected $fillable = [
        'CodeMat',
        'CodeSp',
        'niveau',
        'coef',
        'credit',
    ];
}
