<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Documentos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "documentos";

    protected $fillable = [
        "paciente_id",
        "titulo",
        "texto",
        "firma",

    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

}
