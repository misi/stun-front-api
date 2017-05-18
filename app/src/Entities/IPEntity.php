<?php
namespace STUN\Entities;
/**
 * @SWG\Definition(required={"address"}, type="object", @SWG\Xml(name="IP"))
 */
class IPEntity
{
    /**
     * @SWG\Property(example="192.0.2.10")
     * @var string
     */
    public $ip;
    /**
     * @var string
     * @SWG\Property(enum={"IPv4", "IPv6"})
     */
    public $type;
    /**
     * @var integer
     * @SWG\Property(example=1)
     */
    public $preference;

}
