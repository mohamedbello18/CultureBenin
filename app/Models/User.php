<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

// Importation des modèles de relation
use App\Models\Role;
use App\Models\Langue;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'id_role', // Clé étrangère vers la table 'roles'
        'sexe',
        'id_langue',
        'date_inscription',
        'date_naissance',
        'statut',
        'two_factor_secret',        // ← AJOUTÉ
        'two_factor_recovery_codes', // ← AJOUTÉ
        'two_factor_confirmed_at',   // ← AJOUTÉ
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
        'two_factor_secret',         // ← AJOUTÉ
        'two_factor_recovery_codes', // ← AJOUTÉ
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mot_de_passe' => 'hashed', // Gère le hachage automatique lors de l'enregistrement
        'date_naissance' => 'date',
        'date_inscription' => 'date',
        'two_factor_confirmed_at' => 'datetime', // ← AJOUTÉ
    ];

    // =========================================================
    // MODIFICATIONS CRUCIALES POUR L'AUTHENTIFICATION LARAVEL
    // =========================================================

    /**
     * Surcharger la méthode pour indiquer à Laravel la colonne de mot de passe.
     * Par défaut, Laravel cherche 'password'.
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    /**
     * Surcharger la méthode pour indiquer à Laravel la clé primaire utilisée.
     * Par défaut, Laravel cherche 'id'.
     */
    public function getAuthIdentifierName()
    {
        return 'id_utilisateur';
    }

    // =========================================================
    // MÉTHODES 2FA
    // =========================================================

    /**
     * Vérifie si la 2FA est activée
     */
    public function hasTwoFactorEnabled(): bool
    {
        return !is_null($this->two_factor_secret) && !is_null($this->two_factor_confirmed_at);
    }

    /**
     * Vérifie si la 2FA est configurée mais pas encore confirmée
     */
    public function hasTwoFactorPending(): bool
    {
        return !is_null($this->two_factor_secret) && is_null($this->two_factor_confirmed_at);
    }

    // =========================================================
    // MÉTHODES D'AIDE POUR L'AUTORISATION (RÔLES)
    // =========================================================

    /**
     * Vérifie si l'utilisateur a le rôle d'Admin.
     */
    public function isAdmin(): bool
    {
        // Supposons que votre modèle Role a une propriété 'nom' ou que vous comparez directement l'ID
        // Si Role est lié :
       return $this->id_role == 3;

        // Si vous utilisez une colonne 'role' directement sur l'utilisateur (comme dans l'exemple précédent) :
        // return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un Manager.
     */
    public function isManager(): bool
    {
        // On suppose que le nom du rôle dans la BDD est 'Manager'
        return $this->id_role == 1;
    }

    /**
     * Vérifie si l'utilisateur a le rôle de Manager ou supérieur.
     */
    public function isManagerOrAdmin(): bool
    {
        // Adapter la logique selon les noms de rôles dans votre table 'roles'
        // Si Role est lié :
       return $this->isAdmin() || $this->isManager();
    }

    // --- RELATIONS ---

    /**
     * Relation avec le rôle de l'utilisateur.
     * Assurez-vous que la colonne 'id_role' existe dans la table 'utilisateurs'
     * et qu'elle pointe vers la clé primaire de la table 'roles'.
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'id_role');
    }

    // Dans app/Models/User.php

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class, 'user_id', 'id_utilisateur');
    }


    /**
     * Relation avec la langue préférée de l'utilisateur.
     */
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }
}
