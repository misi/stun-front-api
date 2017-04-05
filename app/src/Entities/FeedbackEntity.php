<?php
namespace STUN\Entities;
/**
 * @SWG\Definition(required={"address"}, type="object", @SWG\Xml(name="Feedback"))
 */
class Feedback
{
    //TODO: Add all fields!
    /**
     * @SWG\Property(example="alice@atlanta.com")
     * @var string
     */
    public $Fromaddress;
    /**
     * @SWG\Property(example="Houston we have problem!")
     * @var string
     */
    public $msg;
}
