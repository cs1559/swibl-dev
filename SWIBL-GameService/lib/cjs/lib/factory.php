<?php
namespace cjs\lib;

class Factory {
    
    var $dbparms = array();
    
    public static function getService() {
        return new Service();
    }
    
    public static function getDatabase() {
        
        $parms = array();
        
        $parms["driver"] = "MySQL";
        $parms["host"] = "127.0.0.1";
        $parms["database"] = "games";
        $parms["user"] = "swibl";
        $parms["password"] = "bas3!ball";
        
        $db = & Database::getInstance($parms);
        return $db;
    }
    
}