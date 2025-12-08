<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contenu_id',
        'montant',
        'reference_paiement',
        'statut_paiement',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_utilisateur');
    }

    public function contenu(): BelongsTo
    {
        return $this->belongsTo(Contenu::class, 'contenu_id', 'id_contenu');
    }
}
