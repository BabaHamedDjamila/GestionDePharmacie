<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $fillable = ['id','nom','catégories','compagnie','dateExpiration','prixAchats','prixVente'];
    protected $dates = ['created_at','updated_at'];
}
