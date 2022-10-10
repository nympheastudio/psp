<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usagers extends Model
{
    use HasFactory;

    
    /**
     * Show the name and firstname.
     *
     * @return \Illuminate\Http\Response
     */
     
    public static function getNamebyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->nom!='' && $usager->prenom !='') return $usager->nom . " " . $usager->prenom;
        return '';
    }

    public static function getNomNaissancebyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->nom_naissance!='') return $usager->nom_naissance;
        return '';
    }

    public static function getAdressebyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->adresse!='') return $usager->adresse;
        return '';
    }

    public static function getCpbyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->cp!='') return $usager->cp;
        return '';
    }


    public static function getVillebyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->ville!='') return $usager->ville;
        return '';
    }

    public static function getTelbyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->tel!='') return $usager->tel;
        return '';
    }

    public static function getEmailbyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->email!='') return $usager->email;
        return '';
    }

    public static function getNumSecubyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->num_secu!='') return $usager->num_secu;
        return '';
    }

    public static function getNumAllocbyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->num_alloc!='') return $usager->num_alloc;
        return '';
    }

    public static function getCategorieSocioprobyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->categorie_sociopro!='') return $usager->categorie_sociopro;
        return '';
    }

    public static function getAutrebyId($id){
        if(!$id) return '';
        $usager = Usagers::find($id);
        if($usager->autre!='') return $usager->autre;
        return '';
    }

    
}
