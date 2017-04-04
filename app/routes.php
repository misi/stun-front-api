<?php
// Routes

use League\OAuth2\Server\ResourceServer;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;

$app->group('/v1',function() {

  // root redirect to doc
  $this->get('',function ($request, $response, $args) {
    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('doc'));
  });

  $this->group('/doc',function () {

    // swagger.json
    $this->get('/swagger.json',function ($request, $response, $args) {
      $swagger = \Swagger\scan('../app');
        return $response->withHeader('Content-Type', 'application/json')
        ->write($swagger);
    })->setName('swagger');

    $this->get('',function ($request, $response, $args) {
      $view=$this->get('view');
      $uri=$request->getUri();
      return $view->render($response, 'swagger3.twig',
              [
                'json_url' => $uri->getScheme()."://".$uri->getAuthority().$this->router->pathFor('swagger'),
                'assets_url' => '../swagger3/assets'
		          ]
            );
    })->setName('doc');

    $this->get('/oauth2-redirect.html',function ($request, $response, $args) {
      $view=$this->get('view');
      return $view->render($response, 'oauth2-redirect.twig',[]);
    })->setName('oauth2-redirect');


    $this->get('/redoc',function ($request, $response, $args) {
      $view=$this->get('view');
      $uri=$request->getUri();
      return $view->render($response, 'redoc.twig',
              [
                'json_url' => $uri->getScheme()."://".$uri->getAuthority().$this->router->pathFor('swagger')
		          ]
            );
    })->setName('redoc');

    $this->get('/swagger2',function ($request, $response, $args) {
      $view=$this->get('view');
      $uri=$request->getUri();
      return $view->render($response, 'swagger2.twig',
              [
                'json_url' => $uri->getScheme()."://".$uri->getAuthority().$this->router->pathFor('swagger'),
                'assets_url' => '../../swagger2'
		          ]
            );
    })->setName('swagger2');

  });


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
        $this->getContainer()->get('resource_server')
    )
  );

  // REST
  $this->group('/rest',function(){

    // token
    $this->get('/token',STUN\Actions\RESTAction::class . ':getToken');
    $this->post('/token',STUN\Actions\RESTAction::class . ':addToken');
    $this->delete('/token',STUN\Actions\RESTAction::class . ':deleteToken');

    // servers
    $this->get('/servers',STUN\Actions\RESTAction::class .':getServers');

  })->add(
    new ResourceServerMiddleware(
        $this->getContainer()->get('resource_server')
    )
  );

  // OAUTH
  $this->group('/oauth',function(){

    //client
    $this->get('/client',STUN\Actions\OAuthAction::class . ':getClient');
    $this->post('/client',STUN\Actions\OAuthAction::class . ':addClient');
    $this->delete('/client',STUN\Actions\OAuthAction::class . ':deleteClient');

    // servers
    $this->get('/servers',STUN\Actions\OAuthAction::class .':getServers');
  });

  // General
  $this->group('/general',function(){
    $this->post('/feedback',STUN\Actions\GeneralAction::class .':feedback');
  })->add(
    new ResourceServerMiddleware(
        $this->getContainer()->get('resource_server')
    )
  );
}
);
