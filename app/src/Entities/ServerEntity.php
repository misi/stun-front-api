<?php
/**
 * @SWG\Definition(required={"username", "ha1_password"}, type="object", @SWG\Xml(name="User"))
 */
class Server
{
    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;
    /**
     * @SWG\Property(example="turn1.lab.vvc.niif.hu")
     * @var string
     */
    public $fqdn;
    /**
     * @SWG\Property()
     * @var IP
     */
    public $ip;
    /**
     * @SWG\Property(example="68b329da9893e34099c7d8ad5cb9c940")
     * @var string
     */
    public $ha1_password;
    /**
     * @SWG\Property(example="turn.geant.org")
     * @var string
     */
    public $realm;
}
