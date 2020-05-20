<?php

namespace App\models;

use App\components\Model;

class KoatuuTree extends Model
{    
    const TER_TYPE_REGION = 0;
    const TER_TYPE_CITY = 1;
    const TER_TYPE_DISTRICT_OF_REGION = 2;
    const TER_TYPE_DISTRICT_OF_CITY = 3;
    const TER_TYPE_URBAN_SETTLEMENT = 4;
    const TER_TYPE_VILAGE = 5;
    const TER_TYPE_SETTLEMENT = 6;
    
    public function getRegions() 
    {
        
        $result = $this->DB_connect
                ->prepare('SELECT `ter_id`, `ter_name` '
                        . 'FROM `t_koatuu_tree` '
                        . 'WHERE `ter_type_id` = :ter_type_id');
        $result->bindParam( ':ter_type_id', $ter_type_id = self::TER_TYPE_REGION, \PDO::PARAM_INT );
        $result->execute();
        
        return $result->fetchAll( \PDO::FETCH_CLASS, 'stdClass' );
    }
    
    public function getCities( $terId ) 
    {

        // Похоже на ошибку в БД город в составе г.Севастополя
        // след.  IF - для того чтобы получить районы Севастополя 
        if( '8500000000' == $terId ){
            return false;            
        }
        
        if( empty( $terId ) ){
            return false;
        }
        $result = $this->DB_connect
                ->prepare('SELECT `ter_id`, `ter_name` '
                        . 'FROM `t_koatuu_tree` '
                        . 'WHERE `ter_type_id` = :ter_type_id '
                        . 'AND `reg_id` = :reg_id');
        $result->bindParam( ':ter_type_id', $ter_type_id = self::TER_TYPE_CITY, \PDO::PARAM_INT );
        $result->bindParam( ':reg_id', substr( $terId, 0, 2 ) );
        $result->execute();

        
        return $result->fetchAll(\PDO::FETCH_CLASS, 'stdClass');
    }
    
    public function getCityDistricts( $terId ) 
    {
        
        if(empty($terId)){
            return false;
        }
        $result = $this->DB_connect
                ->prepare('SELECT `ter_id`, `ter_name` '
                        . 'FROM `t_koatuu_tree` '
                        . 'WHERE `ter_type_id` = :ter_type_id '
                        . 'AND reg_id = :reg_id '
                        . 'AND `ter_address` LIKE ( SELECT CONCAT("%", `ter_name`, "%") FROM `t_koatuu_tree` WHERE ter_id = :ter_id)'
                        );
        $result->bindParam( ':ter_type_id', $ter_type_id = self::TER_TYPE_DISTRICT_OF_CITY, \PDO::PARAM_INT );
        $result->bindParam( ':reg_id', substr($terId, 0, 2 ) );
        $result->bindParam( ':ter_id', $terId );
        
        $result->execute();
        
        return $result->fetchAll( \PDO::FETCH_CLASS, 'stdClass' );
    }

    public function getTerritoryInfoForUser( $userId )
    {            
        $result = $this->DB_connect
                ->prepare('SELECT * FROM t_koatuu_tree JOIN User ON info.user_id = User.id WHERE user_id = :user_id');
        $result->bindParam( ':user_id', $userId, \PDO::PARAM_INT );
        $result->setFetchMode( \PDO::FETCH_CLASS, 'App\models\KoatuuTree' );
        $result->execute();
        
        return $result->fetch();
    }
    
}
