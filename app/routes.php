<?php
// Routes

use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;

$app->group('/v1',function() {

  // root redirect to doc
  $this->get('',function ($request, $response, $args) {
    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('docs'));
  });

  $this->group('/docs',function ($request, $response, $args) {
    $this->get('',function ($request, $response, $args) {
      //TODO add twig swagger index
      return $response->withStatus(200);
    });

    // swagger.json
    $this->get('/swagger.json',function ($request, $response, $args) {
      $swagger = \Swagger\scan('../app');
        return $response->withHeader('Content-Type', 'application/json')
        ->write($swagger);
    })->setName('swagger');

  })->setName('docs');


  // LTC
  $this->group('/ltc',function(){

    // user
    $this->get('/user',STUN\Actions\LTCAction::class . ':getUser');
    $this->post('/user',STUN\Actions\LTCAction::class . ':addUser');
    $this->put('/user',STUN\Actions\LTCAction::class . ':updateUser');
    $this->delete('/user',STUN\Actions\LTCAction::class . ':deleteUser');

    // servers
    $this->get('/servers',STUN\Actions\LTCAction::class .':serverList');
  })->add(
    new ResourceServerMiddleware(
        $app->getContainer()->get('resourceserver')
    )
  );

  // REST
  $this->group('/rest',function(){

    // token
    $this->get('/token',STUN\Actions\LTCAction::class . ':getToken');
    $this->post('/token',STUN\Actions\LTCAction::class . ':addToken');
    $this->delete('/token',STUN\Actions\LTCAction::class . ':deleteToken');

    // servers
    $this->get('/servers',STUN\Actions\LTCAction::class .':serverList')

  })->add(
    new ResourceServerMiddleware(
        $app->getContainer()->get('resourceserver')
    )
  );

  // OAUTH
  $this->group('/oauth',function(){

    //client
    $this->get('/client',STUN\Actions\LTCAction::class . ':getClient');
    $this->post('/client',STUN\Actions\LTCAction::class . ':addClient');
    $this->delete('/client',STUN\Actions\LTCAction::class . ':deleteClient');

    // servers
    $this->get('/servers',STUN\Actions\LTCAction::class .':serverList')
  });

  // General
  $this->group('/general',function(){
    $this->post('/feedback',STUN\Actions\LTCAction::class .':feedback')
  })->add(
    new ResourceServerMiddleware(
        $app->getContainer()->get('resourceserver')
    )
  );

}
