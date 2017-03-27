<?php
namespace STUN\Actions;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

use Psr\Log\LoggerInterface;

use STUN\Repositories\UserRepository
use STUN\Repositories\ServerRepository




final class LTCAction
{
    private $logger;

    private $users;


    public function __construct(LoggerInterface $logger, ServerRepository $servers)
    {
        $this->logger = $logger;
        $this->authserver = $authserver;
        $this->userrepository = $userrepository;
        $this->view = $view;
        $this->session = $session;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("LTC action dispatched");

        try {

        } catch (\Exception $exception) {
            $body = new Stream('php://temp', 'r+');
            $body->write($exception->getMessage());

            return $response->withStatus(500)->withBody($body);
        }
    }

    /**
     * @SWG\Get(
     *     path="/ltc/user",
     *     summary="Get User by EPPN",
     *     tags={"ltc"},
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
     *     security={
     *         {
     *             "client_auth": {"ltc"}
     *         }
     *     },
     * )
     */
     public function getUser(ServerRequestInterface $request, ResponseInterface $response, $args){
     }

     /**
      * @SWG\Post(
      *     path="/ltc/user",
      *     tags={"ltc"},
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
      *     security={{"client_auth":{"ltc"}}}
      * )
      */
     public function addUser()
     {
     }

     /**
     * @SWG\Put(
     *     path="/ltc/user",
     *     tags={"ltc"},
     *     operationId="updateUser",
     *     summary="Update an existing User",
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
     *     security={{"client_auth":{"ltc"}}}
     * )
     */
    public function updateUser()
    {
    }

    /**
     * @SWG\Delete(
     *     path="ltc/user",
     *     summary="Deletes a user",
     *     description="",
     *     operationId="deleteUser",
     *     produces={"application/json"},
     *     tags={"ltc"},
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
     *         description="Pet not found"
     *     ),
     *     security={{"client_auth":{"ltc"}}}
     * )
     */
    public function deletePet()
    {
    }
}
