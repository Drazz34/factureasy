<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "client";
    protected $primaryKey = "id";
    protected $fillable = array("nom", "prenom", "email", "raison_sociale", "telephone", "adresse_id");
    public $timestamps = false;

    /**
     * Un client a une adresse
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'adresse_id');
    }

    /**
     * Un client peut avoir plusieurs factures
     * 
     * @return void
     */
    public function factures()
    {
        return $this->hasMany(Facture::class, 'client_id');
    }
}
