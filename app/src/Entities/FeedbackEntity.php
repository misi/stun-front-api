<?php

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
     * @SWG\Property()
     * @var string
     */
    public $msg;
}
