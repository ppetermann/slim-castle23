<?php
$container->register(
    \Slim\App::class,
    function () use ($container) {

        // our slim app, now, in any realistic case you wouldn't want to completely configure it here, but
        // for this example this should be good enough
        $app = new \Slim\App($container);

        // we want to register at least some route to do something, right?
        $app->get(
            '/hello/{name}',
            function ($request, $response, $args) {

                /** @var \Knight23\Core\RunnerInterface $runner */
                $runner = $this->getcontainer()->get(\Knight23\Core\RunnerInterface::class);

                /** @var Psr\Http\Message\ResponseInterface $response */
                $response->getBody()->write(
                    sprintf(
                        "hello %s\n\napp: %s\nversion: %s",
                        $args['name'],
                        $runner->getPackageName(),
                        $runner->getVersion()
                    )
                );

                return $response->withStatus(200);
            }
        );

        // and don't forget to return the app here
        return $app;
    }
);
