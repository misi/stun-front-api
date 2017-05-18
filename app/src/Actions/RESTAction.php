<?php
namespace STUN\Actions;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

use Psr\Log\LoggerInterface;

use STUN\Repositories\TokenRepository;
use STUN\Repositories\ServerRepository;




final class RESTAction
{
    private $logger;

    private $servers;


    public function __construct(LoggerInterface $logger, ServerRepository $servers)
    {
        $this->logger = $logger;
        $this->servers = $servers;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("REST action dispatched");

        try {

        } catch (\Exception $exception) {
            $body = new Stream('php://temp', 'r+');
            $body->write($exception->getMessage());

            return $response->withStatus(500)->withBody($body);
        }
    }
    /**
     * @SWG\Get(
     *     path="/rest/servers",
     *     summary="Get all REST servers",
     *     tags={"REST","Servers"},
     *     description="Get all servers",
     *     operationId="findServers",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/ServerEntity")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={
     *         {
     *             "client_auth": {"rest"}
     *         }
     *     },
     * )
     */
     public function getServers(ServerRequestInterface $request, ResponseInterface $response, $args){
     }


    /**
     * @SWG\Get(
     *     path="/rest/token",
     *     summary="Get Token (by EPPN)",
     *     tags={"REST"},
     *     description="Get a token by SAML EPPN attribute",
     *     operationId="findTokenByEPPN",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="eppn",
     *         in="query",
     *         description="EduPresonPrincialName",
     *         required=true,
     *         type="array",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/TokenEntity")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid eppn value",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={
     *         {
     *             "client_auth": {"rest"}
     *         }
     *     },
     * )
     */
     public function getToken(ServerRequestInterface $request, ResponseInterface $response, $args){
     }

     /**
      * @SWG\Post(
      *     path="/rest/token",
      *     tags={"REST"},
      *     operationId="addToken",
      *     summary="Add a new token",
      *     description="",
      *     consumes={"application/json"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         description="Token object that needs to be added to the Service",
      *         required=true,
      *         @SWG\Schema(ref="#/definitions/Token"),
      *     ),
      *     @SWG\Response(
      *         response=200,
      *         description="successful operation",
      *         @SWG\Schema(
      *             type="array",
      *             @SWG\Items(ref="#/definitions/TokenEntity")
      *         ),
      *     ),
      *     @SWG\Response(
      *         response=405,
      *         description="Invalid input",
      *     ),
      *     @SWG\Response(
      *         response="500",
      *         description="Internal Server Error",
      *     ),
      *     security={{"client_auth":{"rest"}}}
      * )
      */
     public function addToken()
     {
     }

     /**
     * @SWG\Put(
     *     path="/rest/token",
     *     tags={"REST"},
     *     operationId="updateToken",
     *     summary="Update Token",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Token object that needs to be updated",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Token"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/TokenEntity")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Token not found",
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Validation exception",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={{"client_auth":{"rest"}}}
     * )
     */
    public function updateToken()
    {
    }

    /**
     * @SWG\Delete(
     *     path="/rest/token",
     *     summary="Delete Token",
     *     description="",
     *     operationId="deleteToken",
     *     produces={"application/json"},
     *     tags={"REST"},
     *     @SWG\Parameter(
     *         description="Token id to delete",
     *         in="query",
     *         name="TokenId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Token not found"
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={{"client_auth":{"rest"}}}
     * )
     */
    public function deleteToken()
    {
    }
}
