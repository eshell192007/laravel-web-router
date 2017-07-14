<?php

namespace Tests\LaravelWebRouterExtension;

use WebRouter\LaravelWebRouterExtension as Route;
use Illuminate\Container\Container as Container;
use Illuminate\Support\Facades\Facade as Facade;
use Illuminate\Support\Facades\Request;
use Tests\Mocks\RequestMock;
use Tests\Mocks\RouterMock;
use PHPUnit_Framework_TestCase as TestCase;

class commandTest extends TestCase {

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
        Route::command('create-post');
    }

    /**
     * @test
     */
    public function WhenPassSecondParameterIsNotAString_ThenMethodShouldThrowRunTimeException() {
        $this->expectException(\RuntimeException::class);
        Route::command('create-post', function() {
            return 'any thing';
        });
    }

    /**
     * @test
     */
    public function PassValidArgument_WhenRequestMethodIsPOST_ThenCommandMethodShouldBeCalled() {
        //TODO:
        $return_value = Route::command('create-post', 'Post\CreatePost');

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
