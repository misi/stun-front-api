<?php

/**
 * @SWG\Definition(required={"username", "ha1_password"}, type="object", @SWG\Xml(name="User"))
 */
class User
{
    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;
    /**
     * @SWG\Property(example="user1")
     * @var string
     */
    public $username;
    /**
     * @SWG\Property(example="secret123")
     * @var string
     */
    public $password_clear;
    /**
     * @SWG\Property(example="68b329da9893e34099c7d8ad5cb9c940")
     * @var string
     */
    public $password_ha1;
    /**
     * @SWG\Property(example="turn.geant.org")
     * @var string
     */
    public $realm;
}
