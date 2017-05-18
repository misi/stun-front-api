<?php
namespace STUN\Entities;
/**
 * @SWG\Definition(required={"address"}, type="object", @SWG\Xml(name="Feedback"))
 */
class FeedbackEntity
{
    /**
      * @SWG\Property(example="Alice")
      * @var string
      */
    public $name;

    /**
      * @SWG\Property(example="alice@atlanta.co")
      * @var string
      */
    public $email;

    /**
     * @SWG\Property(example="+36-1-4503060")
     * @var string
     */
    public $phone;
    /**
     * @SWG\Property(example="Houston we have problem!")
     * @var string
     */
    public $message;
}
