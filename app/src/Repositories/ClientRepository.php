<?php

namespace STUN\Repositories;

use Psr\Log\LoggerInterface;
use \PDO;

class ClientRepository
{
    private $logger;

    private $pdo;

    public function __construct(PDO $pdo, LoggerInterface $logger)
    {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    /**
     * Get Client
     *
     * @param mixed  $service
     *
     * @return ServerEntity[]
     */

     /**
      * Add New Client
      *
      * @param mixed  $eppn
      *
      * @return ClientEntity
      */


      /**
       * Delete Client
       *
       * @param mixed  $Identifier
       */

       /**
        * Update
        * @param mixed  $Identifier
        *
        * @return ServerEntity[]
        */


}
