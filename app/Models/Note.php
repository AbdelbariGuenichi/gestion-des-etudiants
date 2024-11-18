<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $primaryKey = 'nci'; // Adjust based on your primary key setup

    public $incrementing = false; // If `nci` is not auto-incrementing
    public $keyType = 'string';  // If `nci` is a string

    protected $fillable = [
        'nci',
        'CodeMat',
        'DateResultat',
        'NoteControle',
        'NoteExamen',
        'resultat',
    ];
}
