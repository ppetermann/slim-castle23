<?php
/**
 * this file contains the defaults that slim requires a DI container to provide
 * as long as you don't want to change those defaults, you shouldn't need to touch this.
 */


$container->register(
    'notFoundHandler',
    function () {
        return
            function ($request, $response) {
                /** @var Psr\Http\Message\ResponseInterface $response */

                // we return a 404 error
                return $response->withStatus(404);
            };
    }
);

// @todo integrate with King23 Settings
$container->register(
    'settings',
    function () {
        return [
            'cookieLifetime' => '20 minutes',
            'cookiePath' => '/',
            'cookieDomain' => null,
            'cookieSecure' => false,
            'cookieHttpOnly' => false,
            'httpVersion' => '1.1',
            'responseChunkSize' => 4096,
            'outputBuffering' => 'append',
        ];
    }
);

$container->register(
    'environment',
    function () {
        return new \Slim\Http\Environment([]);
    }
);


// hopefully those are never used, but the ones from the middleware
$container->registerFactory('response',
    function ($c) {
        $headers = new \Slim\Http\Headers(['Content-Type' => 'text/html']);
        $response = new \Slim\Http\Response(200, $headers);
        return $response->withProtocolVersion($c['settings']['httpVersion']);
    }
);

// hopefully those are never used, but the ones from the middleware
$container->registerFactory(
    'request',
    function () use($container) {
        return \Slim\Http\Request::createFromEnvironment($container->get('environment'));
    }
);

$container->register(
    'router',
    function () {
        return new \Slim\Router();
    }
);

$container->register(
    'errorHandler',
    function () {
        return new \Slim\Handlers\Error();
    }
);

$container->register(
    'notAllowedHandler',
    function() {
        return new \Slim\Handlers\NotAllowed();
    }
);

$container->registerFactory(
    'callableResolver',
    function () use($container) {
        return new \Slim\CallableResolver($container);
    }
);
