<?php

namespace Tests\Mocks;

use Illuminate\Http\Request;

class RequestMock extends Request {

    protected $method;

    public function setMethod($method){
        $this->method = $method;
    }

    public function isMethod($method) {
        if ($this->method !== $method) {
            return false;
        }
        
        return true;
    }
    
    public function tearDown(){
        $this->method = null;
    }

}
