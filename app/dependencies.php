<?php

use Slim\Views\Twig;

use League\OAuth2\Server\ResourceServer;
use STUN\Repositories\AccessTokenRepository;

// DIC configuration
$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Handlers
// -----------------------------------------------------------------------------


// error handler
if ($container->get('settings')['authserver']['errorHandler']) {
    $container['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
            return $c['response']->withStatus(500)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->withJson(array('info' => 'Something went wrong!'));
        };
    };
}

// notFound handler
if ($container->get('settings')['authserver']['notFoundHandler']) {
    $container['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $c['response']
                ->withStatus(404)
                ->withHeader('Content-Type', 'application/json')
                ->withJson(array('info' => 'Route not defined'));
        };
    };
}

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
    return $view;
};

//pdo
$container['pdo'] = function ($c) {
    $settings = $c->get('settings')['pdo'];
    $pdo = new \PDO($settings['dsn'], $settings['username'], $settings['password'], $settings['options']);
    return $pdo;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


//Repositories
$container['ltc_users'] = function ($c) {
    return new STUN\Repositories\UserRepository($c->get('pdo'), $c->get('logger'));
};

$container['ltc_servers'] = function ($c) {
    return new STUN\Repositories\ServerRepository($c->get('pdo'), $c->get('logger'),'ltc');
};

$container['rest_tokens'] = function ($c) {
    return new STUN\Repositories\TokenRepository($c->get('pdo'), $c->get('logger'));
};

$container['rest_servers'] = function ($c) {
    return new STUN\Repositories\ServerRepository($c->get('pdo'), $c->get('logger'),'rest');
};


$container['oauth_clients'] = function ($c) {
    return new STUN\Repositories\ClientRepository($c->get('pdo'), $c->get('logger'));
};

$container['oauth_servers'] = function ($c) {
    return new STUN\Repositories\ServerRepository($c->get('pdo'), $c->get('logger'),'oauth');
};


$container['access_tokens'] = function ($c) {
    return new STUN\Repositories\AccessTokenRepository($c->get('logger'));
};

// resource server
$container['resource_server'] = function ($c) {
        $settings = $c->get('settings')['resourceserver'];
        $server = new ResourceServer(
            $c->get('access_tokens'),            // instance of AccessTokenRepositoryInterface
            'file://' . __DIR__ . '/' . $settings['publickey']  // the authorization server's public key
        );
        return $server;
};



// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------
$container[STUN\Actions\LTCAction::class] = function ($c) {
    return new STUN\Actions\LTCAction($c->get('logger'),
                                      $c->get('ltc_users'),
                                      $c->get('ltc_servers')
                                    );
};

$container[STUN\Actions\RESTAction::class] = function ($c) {
    return new STUN\Actions\TokenAction($c->get('logger'),
                                        $c->get('rest_tokens'),
                                        $c->get('rest_servers')
                                      );
};

$container[STUN\Actions\OAuthAction::class] = function ($c) {
    return new STUN\Actions\OAuthAction($c->get('logger'),
                                        $c->get('pdo'),
                                        $c->get('oauth_clients'),
                                        $c->get('oauth_servers')
                                      );
};

$container[STUN\Actions\GeneralAction::class] = function ($c) {
    return new STUN\Actions\GeneralAction($c->get('logger'),
                                          $c->get('settings')['phpmailer']
                                        );
};
