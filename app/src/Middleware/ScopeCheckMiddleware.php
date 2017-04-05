<?php
namespace STUN\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

private $scope;

public function __construct(String $scope)
{
    $this->scope = $scope;
}

class ScopeCheckMiddleware
{
    /**
     * Scope Check middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request,ResponseInterface $response, $next)
    {
        $tokenScopes=$request->getAttribute('oauth_scopes');
        if (in_array($this->scope,$tokenScopes)) {
            $response = $next($request, $response);
            return $response;
        } else {
            $response->getBody()->write('Issue During Token Scope Validation!!');
            $response->getBody()->write('Access Token scope(s): '.print_r($tokenScopes,true));
            $response->getBody()->write('Required scope: '.$this->scope);
            return $response->withStatus(500);
        }
    }
}
