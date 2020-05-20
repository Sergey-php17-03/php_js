<?php

namespace App\components;

    use \App\components\DB;
    
abstract class Model {

    protected $DB_connect;

    public function __construct() {
        $this->DB_connect = DB::getConnection();
    }

}
