<?php
/**
 * @SWG\Definition(required={"token"}, type="object", @SWG\Xml(name="Token"))
 */
 class User
{
    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;
    /**
     * @SWG\Property(example="VM89RUuymTnAArg223S4c5zqAzCjByw1")
     * @var string
     */
    public $token;
    /**
     * @SWG\Property(example="https://webrtc.example.com/myawsomeapp")
     * @var string
     */
    public $service_url;
    /**
     * @SWG\Property(example="turn.geant.org")
     * @var string
     */
    public $realm;
}
