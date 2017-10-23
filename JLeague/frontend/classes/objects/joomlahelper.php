<?php

class mJoomlaHelper {
    
    public static function getUser() {
        return JFactory::getUser();
    }
    
    public static function getDocument() {
        return &JFactory::getDocument();
    }
    
    public static function getUriBase() {
        return JURI::base();
    }
    public static function getApplication() {
        return JFactory::getApplication();
    }
    public static function getConfig() {
        return &JFactory::getConfig();
    }
    public function getDBO() {
        return & JFactory::getDBO();
    }
}