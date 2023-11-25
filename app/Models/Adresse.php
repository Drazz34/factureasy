<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $table = "adresse";
    protected $primaryKey = "id";
    protected $fillable = array("numero_et_rue", "code_postal", "ville");
    public $timestamps = false;

    /**
     * Une adresse peut correspondre à plusieurs clients
     * 
     * @return void
     */

    public function clients()
    {
        return $this->hasMany(Client::class, 'adresse_id');
    }
}
