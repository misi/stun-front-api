<?php

namespace STUN\Repositories;

use Psr\Log\LoggerInterface;
use \PDO;

class UserRepository
{
    private $logger;

    private $pdo;

    private $service;

    public function __construct(PDO $pdo, LoggerInterface $logger,$service)
    {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    /**
     * Select availvale Servers
     *
     * @param mixed  $service
     *
     * @return ServerEntity[]
     */
}
