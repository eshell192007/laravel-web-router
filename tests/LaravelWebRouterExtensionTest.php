<?php

namespace Tests;

use WebRouter\LaravelWebRouterExtension as Route;
use Illuminate\Container\Container as Container;
use Illuminate\Support\Facades\Facade as Facade;
use Illuminate\Support\Facades\Request;
use Tests\Mocks\RequestMock;
use Tests\Mocks\RouterMock;
use PHPUnit_Framework_TestCase as TestCase;

class LaravelWebRouterExtensionTest extends TestCase {

    public static function setUpBeforeClass() {
        $app = new Container();
        Facade::setFacadeApplication($app);
        $app->bind('request', RequestMock::class);
        $app->bind('router', RouterMock::class);
        class_alias(Request::class, 'Request');
    }

    /**
     * @test
     */
    public function WhenMissingParameter_MethodShouldThrowRunTimeException() {
        $this->expectException(\RuntimeException::class);
        Route::web('create-post');
    }
    
    /**
     * @test
     */
    public function WhenPassSecondParameterIsNotAString_ThenMethodShouldThrowRunTimeException() {
        $this->expectException(\RuntimeException::class);
        Route::web('create-post', function() {
            return 'any thing';
        });
    }

    /**
     * @test
     */
    public function PassValidArgument_WhenRequestMethodIsGET_ThenQueryMethodShouldBeCalled() {
        //TODO: set up fake HTTP method
        Request::setMethod('get');

        //TODO: run method to test
        $return_value = Route::web('create-post', 'Post\CreatePost');

        //TODO:
        $this->assertTrue(Route::getIsCalled());
        $this->assertFalse(Route::postIsCalled());
        $actual_action = Route::getAction();
        $expected_action = 'Post\CreatePost@query';
        $this->assertEquals($expected_action, $actual_action);
        $this->assertInstanceOf(\Illuminate\Routing\Router::class, $return_value);
    }

    /**
     * @test
     */
    public function PassValidArgument_WhenRequestMethodIsPOST_ThenCommandMethodShouldBeCalled() {
        //TODO: set up fake HTTP method
        Request::setMethod('post');

        //TODO:
        $return_value = Route::web('create-post', 'Post\CreatePost');

        //TODO:
        $this->assertTrue(Route::postIsCalled());
        $this->assertFalse(Route::getIsCalled());
        $actual_action = Route::getAction();
        $expected_action = 'Post\CreatePost@command';
        $this->assertEquals($expected_action, $actual_action);
        $this->assertInstanceOf(\Illuminate\Routing\Router::class, $return_value);
    }

    protected function tearDown() {
        Request::tearDown();
        Route::tearDown();
    }

}
