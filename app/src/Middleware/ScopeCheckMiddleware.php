<?php
namespace STUN\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;




class ScopeCheckMiddleware
{
    // Required Scope
    private $scope;

    /**
     * Scope Check middleware class constructor
     *
     * @param  String   $scope  Required Scope
     *
     */

    public function __construct(String $scope)
    {
        $this->scope = $scope;
    }

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
            $response->getBody()->write('Please check Access Token Sopes!');
            $response->getBody()->write('Problem has occured during Scope Validation!!');
            $response->getBody()->write('Access Token scope(s): '.print_r($tokenScopes,true));
            $response->getBody()->write('Required scope: '.$this->scope);
            return $response->withStatus(500);
        }
    }
}
