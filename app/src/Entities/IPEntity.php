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
     * @SWG\Property(enum={"IPv4", "IPv6"}")
     * @SWG\Property(example="IPv4")
     * @var string
     */
    public $type;
}
