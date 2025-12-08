<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'id_media'; 

    protected $fillable = [
        'id_type_media',
        'Chemin',
        'description',
    ];

    // --- RELATION ---

    // Relation avec le Type de Média (TypeMedia)
    public function typeMedia()
    {
        // Supposons que la clé primaire de 'type_medias' est 'id_type' (comme dans votre entité précédente)
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type');
    }
    
    // Si la clé primaire est 'id_type_media', utilisez simplement :
    // return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type_media');
}