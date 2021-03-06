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
        $this->db = $db;
    }

    /**
     * Select availvale Servers
     *
     * @return ServerEntity[]
     */
    public function getServers(){
        $this->pdo->query("use `".$this->db."`");
        $sql="SELECT * FROM `server`";
        $server_stmt=$this->pdo->query($sql);
        $server_result=$server_stmt->fetchAll();
        foreach ($server_result as $server_row) {

            $server = new ServerEntity();

            $server->fqdn = $server_row['fqdn'];
            $server->organization = $server_row['organization'];
            $server->latitude = $server_row['latitude'];
            $server->longitude = $server_row['longitude'];

            $sql="SELECT * FROM `ip` WHERE `server_id`=".$server_row['id'];
            $ip_stmt=$this->pdo->query($sql);
            $ip_result = $ip_stmt->fetchAll();
            foreach ($ip_result as $ip_row) {
                $ip = new IPEntity();

                $ip->ip = $ip_row['ip'];
                $ip->type = $ip_row['ipv6'] ? 'IPv6' : 'IPv4';
                $ip->preference = $ip_row['preference'];

                $server->ip[] = $ip;
            }
            $servers[]=$server;
        }
        return $servers;
    }
}
