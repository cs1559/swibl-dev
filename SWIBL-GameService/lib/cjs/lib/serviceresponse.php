<?php
namespace cjs\lib;

class ServiceResponse {
    
    const SUCCESS = true;
    const FAIL = false;

    var $code = null;
    var $status = null;
    var $message = null;
    var $errors = array();
    var $data = null;

    public function setData($content) {
        $this->data = $content;
    }
    public function getData() {
        return $this->data;
    }
    
    public function addError(Error $error) {
        $this->errors[] = $error;
    }
    
    public function getErrors() {
        return $this->errors;
    }
}