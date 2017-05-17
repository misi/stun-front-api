<?php

namespace STUN\Repositories;

use Psr\Log\LoggerInterface;
use \PDO;
use STUN\Entities\ServerEntity;
use STUN\Entities\IPEntity;

class ServerRepository
{
    private $logger;

    private $pdo;

    private $db;

    public function __construct(PDO $pdo, LoggerInterface $logger,$db)
    {
        $this->pdo = $pdo;
        $this->logger = $logger;
        $this->service = $db;
    }

    /**
     * Select availvale Servers
     *
     * @return ServerEntity[]
     */
    public function getServers(){
      if($this->pdo->query("use ".$this->db)){
          $sql="SELECT * FROM `server`";
          if($server_stmt=$this->pdo->query($sql)){
              $server_result=$server_stmt->fetchAll();
              foreach ($server_result as $server_row) {

                  $server = new ServerEntity();

                  $server->fqdn = $server_row['fqdn'];
                  $server->organization = $server_row['organization'];
                  $server->latitude = $server_row['latitude'];
                  $server->longitude = $server_row['longitude'];

                  $sql="SELECT * FROM `ip` WHERE `server_id`=".$server_row['id'];
                  if($ip_stmt=$this->pdo->query($sql)){
                      $ip_result = $ip_stmt->fetchAll();
                      foreach ($ip_result as $ip_row) {
                          $ip = new IPEntity();

                          $ip->address = $ip_row['address'];
                          $ip->type = $ip_row['ipv6'] ? 'IPv6' : 'IPv4';
                          $ip->preference = $ip_row['preference'];

                          $server->ip[] = $ip;
                      }
                  }else{
                      $this->logger->error('Error occurred during select from IP table!');
                  }
                  $servers[]=$server;
              }
              return $servers;
          } else {
              $this->logger->error('Error occurred during select from SERVER table!');
          }
      } else {
        $this->logger->error('DB selection error occurred!');
      }
    }
}
