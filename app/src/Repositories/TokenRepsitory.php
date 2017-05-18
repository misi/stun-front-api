<?php

namespace STUN\Repositories;

use Psr\Log\LoggerInterface;
use \PDO;

class TokenRepository
{
    private $logger;

    private $pdo;

    private $service;

    public function __construct(PDO $pdo, LoggerInterface $logger)
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
