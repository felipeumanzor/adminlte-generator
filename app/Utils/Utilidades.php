<?php

namespace App\Utils;



class Utilidades 
{

    public static function getIdNameFrom($results){
        $idName = [];
        foreach ($results as $result) {
            $idName[$result->id] = $result->name;
        }
        return $idName;
    }

    public static function getIdRoleFrom($results){
        $idName = [];
        foreach ($results as $result) {
            $idName[$result->id] = $result->role;
        }
        return $idName;
    }


}
