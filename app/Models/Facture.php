<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = "facture";
    protected $primaryKey = "id";
    protected $fillable = array("montant","client_id");
    public $timestamps = false;

    /**
     * Une facture est pour un client
     * 
     * @return void
     */

     public function client() {
        return $this->belongsTo(Client::class);
     }
}
