<?php

/**
 * @SWG\Definition(required={"address"}, type="object", @SWG\Xml(name="IP"))
 */
class IP
{
    /**
     * @SWG\Property(example="192.0.2.10")
     * @var string
     */
    public $address;
    /**
     * @SWG\Property()
     * @var IP
     */
    public $ip;
}
