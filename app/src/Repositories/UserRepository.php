<?php

namespace STUN\Repositories;

use Psr\Log\LoggerInterface;
use \PDO;

class UserRepository
{
    private $logger;

    private $pdo;

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
