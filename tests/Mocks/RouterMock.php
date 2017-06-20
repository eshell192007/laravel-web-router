<?php

namespace Tests\Mocks;

use Illuminate\Routing\Router;

class RouterMock extends Router {

    public function __construct() {
        
    }

    private $uri, $action, $getIsCalled = false, $postIsCalled = false;
    
    public function getUri() {
        return $this->uri;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function tearDown(){
        $this->uri = null;
        $this->action = null;
        $this->getIsCalled = false;
        $this->postIsCalled = false;
    }
    
    public function getIsCalled(){
        return $this->getIsCalled;
    }
    
    public function postIsCalled(){
        return $this->postIsCalled;
    }

    public function get($uri, $action) {
        $this->uri = $uri;
        $this->action = $action;
        $this->getIsCalled = true;
        return $this;
    }

    public function post($uri, $action) {
        $this->uri = $uri;
        $this->action = $action;
        $this->postIsCalled = true;
        return $this;
    }

}
