<?php
namespace STUN\Actions;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

use Psr\Log\LoggerInterface;

use STUN\Repositories\ClientRepository;
use STUN\Repositories\ServerRepository;




final class OAuthAction
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
        $this->logger->debug("OAuth action dispatched");

        try {

        } catch (\Exception $exception) {
            $body = new Stream('php://temp', 'r+');
            $body->write($exception->getMessage());

            return $response->withStatus(500)->withBody($body);
        }
    }
    /**
     * @SWG\Get(
     *     path="/oauth/servers",
     *     summary="Get all OAuth servers",
     *     tags={"OAuth","Servers"},
     *     description="Get all servers",
     *     operationId="findServers",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Server")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={
     *         {
     *             "client_auth": {"oauth"}
     *         }
     *     },
     * )
     */
     public function getServers(ServerRequestInterface $request, ResponseInterface $response, $args){
     }


    /**
     * @SWG\Get(
     *     path="/oauth/client",
     *     summary="Get Client (by EPPN)",
     *     tags={"OAuth"},
     *     description="Get a client by SAML EPPN attribute",
     *     operationId="findClientByEPPN",
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
     *             @SWG\Items(ref="#/definitions/Client")
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
     *             "client_auth": {"oauth"}
     *         }
     *     },
     * )
     */
     public function getClient(ServerRequestInterface $request, ResponseInterface $response, $args){
     }

     /**
      * @SWG\Post(
      *     path="/oauth/client",
      *     tags={"OAuth"},
      *     operationId="addClient",
      *     summary="Add a new client",
      *     description="",
      *     consumes={"application/json"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         description="Client object that needs to be added to the Service",
      *         required=true,
      *         @SWG\Schema(ref="#/definitions/Client"),
      *     ),
      *     @SWG\Response(
      *         response=200,
      *         description="successful operation",
      *         @SWG\Schema(
      *             type="array",
      *             @SWG\Items(ref="#/definitions/Client")
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
      *     security={{"client_auth":{"oauth"}}}
      * )
      */
     public function addClient()
     {
     }

     /**
     * @SWG\Put(
     *     path="/oauth/client",
     *     tags={"OAuth"},
     *     operationId="updateClient",
     *     summary="Update Client",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Client object that needs to be updated",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Client"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Client")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Client not found",
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Validation exception",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={{"client_auth":{"oauth"}}}
     * )
     */
    public function updateClient()
    {
    }

    /**
     * @SWG\Delete(
     *     path="/oauth/client",
     *     summary="Delete Client",
     *     description="",
     *     operationId="deleteClient",
     *     produces={"application/json"},
     *     tags={"OAuth"},
     *     @SWG\Parameter(
     *         description="Client id to delete",
     *         in="query",
     *         name="ClientId",
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
     *         description="Client not found"
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={{"client_auth":{"oauth"}}}
     * )
     */
    public function deleteClient()
    {
    }
}
