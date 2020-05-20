<?php

namespace App\controllers;

use App\models\User;

class UserController
{
    public function actionCard($userId)
    {
        $title = 'Карточка пользователя';                
        $user = ( new User )->getUserCardByUserId($userId);        
        require_once dirname(__DIR__, 2) . '/views/user.php';
    }


    public function actionCreate()
    {        
        $data = $_POST?: [];
        
        
        $newUser = new User();
        $user = $newUser->getUserByEmail( $data['email'] );
        
        if($user){
            $url = '/user/'. $user->id;
            die( json_encode( ['status' => false, 'url' => $url] ) );
        }
        if( !empty( $data['territory']['city_districts'] ) ){
            $territory = $data['territory']['city_districts'];
        } elseif (!empty ($data['territory']['city'])) {
            $territory = $data['territory']['city'];
        }else{
            $territory = $data['territory']['region'];            
        }
        
        $data['territory'] = $territory;
        
        $result = $newUser->create( $data );
        
        die( json_encode( ['status' => $result] ) );         
    }
}
