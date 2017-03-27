<?php

/**
 * @SWG\Definition(required={"address"}, type="object", @SWG\Xml(name="IP"))
 */
class IP
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
    public $address;
    /**
     * @SWG\Property()
     * @var IP
     */
    public $ip;
}
