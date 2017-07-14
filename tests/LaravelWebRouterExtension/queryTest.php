<?php

namespace Tests\LaravelWebRouterExtension;

use WebRouter\LaravelWebRouterExtension as Route;
use Illuminate\Container\Container as Container;
use Illuminate\Support\Facades\Facade as Facade;
use Illuminate\Support\Facades\Request;
use Tests\Mocks\RequestMock;
use Tests\Mocks\RouterMock;
use PHPUnit_Framework_TestCase as TestCase;

class queryTest extends TestCase {

    public static function setUpBeforeClass() {
        $app = new Container();
        Facade::setFacadeApplication($app);
        $app->bind('request', RequestMock::class);
        $app->bind('router', RouterMock::class);
        if (!class_exists('Request')){
            class_alias(Request::class, 'Request');
        }
    }

    /**
     * @test
     */
    public function WhenMissingParameter_MethodShouldThrowRunTimeException() {
        $this->expectException(\RuntimeException::class);
        Route::query('create-post');
    }

    /**
     * @test
     */
    public function WhenPassSecondParameterIsNotAString_ThenMethodShouldThrowRunTimeException() {
        $this->expectException(\RuntimeException::class);
        Route::query('create-post', function() {
            return 'any thing';
        });
    }

    /**
     * @test
     */
    public function PassValidArgument_WhenRequestMethodIsGET_ThenQueryMethodShouldBeCalled() {
        //TODO: run method to test
        $return_value = Route::query('create-post', 'Post\CreatePost');

        //TODO:
        $this->assertTrue(Route::getIsCalled());
        $this->assertFalse(Route::postIsCalled());
        $actual_action = Route::getAction();
        $expected_action = 'Post\CreatePost@query';
        $this->assertEquals($expected_action, $actual_action);
        $this->assertInstanceOf(\Illuminate\Routing\Router::class, $return_value);
    }

    protected function tearDown() {
        Request::tearDown();
        Route::tearDown();
    }

}
