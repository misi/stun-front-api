<?php
namespace STUN\Actions;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

use Psr\Log\LoggerInterface;

use STUN\Repositories\UserRepository;
use STUN\Repositories\ServerRepository;




final class LTCAction
{
    private $logger;

    private $users;

    private $servers;

    public function __construct(LoggerInterface $logger, UserRepository $users, ServerRepository $serverRepository)
    {
        $this->logger = $logger;
        $this->users = $users;
        $this->serverRepository = $serverRepository;
    }

    /**
     * @SWG\Get(
     *     path="/ltc/servers",
     *     summary="Get all LTC servers",
     *     tags={"LTC","Servers"},
     *     description="Get all servers by SAML EPPN attribute",
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
     *             "client_auth": {"ltc"},
     *             "implicit_auth": {"ltc"},
     *             "api_key": {},
     *         }
     *     },
     * )
     */
     public function getServers(ServerRequestInterface $request, ResponseInterface $response, $args){
       //log
       $this->logger->debug("LTC getServers dispatched");

       try {
          $servers=$this->serverRepository->getServers();
          return $response->withJson($servers,200);
       } catch (\Exception $exception) {
           $body = new Stream('php://temp', 'r+');
           $body->write($exception->getMessage());

           return $response->withStatus(500)->withBody($body);
       }

     }


    /**
     * @SWG\Get(
     *     path="/ltc/user",
     *     summary="Get User (by EPPN)",
     *     tags={"LTC"},
     *     description="Get a user by SAML EPPN attribute",
     *     operationId="findUserByEPPN",
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
     *             @SWG\Items(ref="#/definitions/User")
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
     *             "client_auth": {"ltc"}
     *         }
     *     },
     * )
     */
     public function getUser(ServerRequestInterface $request, ResponseInterface $response, $args){
        $tokenClientId=$request->getAttribute('oauth_client_id');
        //log
        $this->logger->debug("LTC getUser dispatched");

        try {
          $response->getBody()->write($tokenClientId);
          return $response->withStatus(200);
        } catch (\Exception $exception) {
            $body = new Stream('php://temp', 'r+');
            $body->write($exception->getMessage());

            return $response->withStatus(500)->withBody($body);
        }

     }

     /**
      * @SWG\Post(
      *     path="/ltc/user",
      *     tags={"LTC"},
      *     operationId="addUser",
      *     summary="Add a new user",
      *     description="",
      *     consumes={"application/json"},
      *     produces={"application/json"},
      *     @SWG\Parameter(
      *         name="body",
      *         in="body",
      *         description="User object that needs to be added to the Service",
      *         required=true,
      *         @SWG\Schema(ref="#/definitions/User"),
      *     ),
      *     @SWG\Response(
      *         response=200,
      *         description="successful operation",
      *         @SWG\Schema(
      *             type="array",
      *             @SWG\Items(ref="#/definitions/User")
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
      *     security={{"client_auth":{"ltc"}}}
      * )
      */
     public function addUser()
     {
     }

     /**
     * @SWG\Put(
     *     path="/ltc/user",
     *     tags={"LTC"},
     *     operationId="updateUser",
     *     summary="Update User",
     *     description="",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="User object that needs to be updated",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/User"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/User")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="User not found",
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Validation exception",
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={{"client_auth":{"ltc"}}}
     * )
     */
    public function updateUser()
    {
    }

    /**
     * @SWG\Delete(
     *     path="/ltc/user",
     *     summary="Delete User",
     *     description="",
     *     operationId="deleteUser",
     *     produces={"application/json"},
     *     tags={"LTC"},
     *     @SWG\Parameter(
     *         description="User id to delete",
     *         in="query",
     *         name="UserId",
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
     *         description="User not found"
     *     ),
     *     @SWG\Response(
     *         response="500",
     *         description="Internal Server Error",
     *     ),
     *     security={{"client_auth":{"ltc"}}}
     * )
     */
    public function deleteUser()
    {
    }
}
