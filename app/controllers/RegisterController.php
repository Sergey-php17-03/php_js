<?php

namespace App\controllers;

use App\models\KoatuuTree;
use App\helpers\HtmlHelper;
use App\models\User;

class RegisterController 
{

    public function actionIndex() 
    {
        
        $title = 'Регистрация';                
        $regions = ( new KoatuuTree )->getRegions();
        
        require_once dirname(__DIR__, 2) . '/views/register.php';
    }
    
    public function actionCities() 
    {
        $status = false;
        
        if( $terId = $_POST['terId'] ){        
            $cities = ( new KoatuuTree )->getCities( $terId );            
        }
        
        if( $cities ){
            $html = HtmlHelper::getHtmlOptions( $cities );
            $status = true;
        }
        die( json_encode( ['status' => $status, 'htmlOptions' => $html] ) );
        
    }
    
    public function actionCityDistricts() 
    {
        
        $status = false;
        
        if( $terId = $_POST['terId'] ){        
            $cityDistricts = ( new KoatuuTree )->getCityDistricts( $terId );            
        }
        
        if( $cityDistricts ){
            $html = HtmlHelper::getHtmlOptions($cityDistricts);
            $status = true;
        }
        die(json_encode(['status' => $status, 'htmlOptions' => $html]));        
    }
    
}
