<?php
// @todo: see if we can marry slims DI with King23/DI.
$container->register(
    \Slim\App::class,
    function() {

        // our slim app, now, in any realistic case you wouldn't want to completely configure it here, but
        // for this example this should be good enough
        $app = new \Slim\App();


        // overwrite slim3's build in notFound handler,
        // as that one is not psr-7 compliant atm
        $app->getContainer()['notFoundHandler'] = function () {
            return
                function($request, $response) {
                /** @var Psr\Http\Message\ResponseInterface $response */

                // we return a 404 error
                return $response->withStatus(404);
            };
        };


        // we want to register at least some route to do something, right?
        $app->get('/hello/{name}', function($request, $response, $args) {
            /** @var Psr\Http\Message\ResponseInterface $response */
            $response->getBody()->write('hello ' . $args['name']);
            return $response->withStatus(200);
        });

        // and don't forget to return the app here
        return $app;
    }
);

