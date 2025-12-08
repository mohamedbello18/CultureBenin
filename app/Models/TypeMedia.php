<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMedia extends Model
{
    use HasFactory;

    protected $table = 'type_medias'; 
    protected $primaryKey = 'id_type'; 

    protected $fillable = [
        'nom',
    ];
}