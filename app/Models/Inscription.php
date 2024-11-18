<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    // Define the table name if it does not follow Laravel's naming conventions
    protected $table = 'inscriptions';

    // Set the primary key if it's not the default `id`
    protected $primaryKey = 'nci';

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'nci',
        'CodeSp',
        'DateInscription',
        'niveau',
        'resultatFinale',
        'Mention',
    ];

    // Timestamps are enabled by default, no need to add this unless you disable them
    public $timestamps = true;
}
