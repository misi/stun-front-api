<?php

/**
 * @SWG\Definition(required={"latitude","longitude"}, type="object", @SWG\Xml(name="Geolocation"))
 */
class Geolocation
{
    /**
     * @SWG\Property(example="47.544083")
     * @var string
     */
    public $latitude;
    /**
     * @SWG\Property(example="21.6397401")
     * @var string
     */
    public $longitude;
}
