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
}
