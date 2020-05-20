<?php

namespace App\models;

use App\components\Model;

class User extends Model 
{

    public $name;
    public $email;
    public $territory;

    public function getUserCardByUserId( $userId ) 
    {
        $result = $this->DB_connect->prepare('SELECT u.*, tkt.ter_address AS address 
                                            FROM `users` AS u
                                            LEFT JOIN t_koatuu_tree AS tkt ON u.territory = tkt.ter_id
                                            WHERE u.`id` = :user_id');
        $result->bindParam( ':user_id', $userId, \PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(\PDO::FETCH_OBJ);
    }
    
    public function getUserByEmail( $email ) 
    {

        $result = $this->DB_connect->prepare('SELECT * FROM users WHERE email = :email');
        $result->bindParam(':email', $email);
        $result->execute();
        
        return $result->fetch(\PDO::FETCH_OBJ);
    }

    public function create( $params = [] ) 
    {
        if (empty($params)) {
            return false;
        } else {
            
            $sql = "INSERT INTO users (name, email, territory) VALUES (:name, :email, :territory)";
            $result = $this->DB_connect->prepare($sql);
            $result->execute($params);
            return (bool) $result->rowCount();
        }
    }

}
