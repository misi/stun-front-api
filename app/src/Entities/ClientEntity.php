<?php

/**
 * @SWG\Definition(required={"token","service_url"}, type="object", @SWG\Xml(name="Client"))
 */
Class Client
{
    /**
     * @SWG\Property(format="int64")
     * @var int
     */
    public $id;
    /**
     * @SWG\Property(example="3a72cac5-e101-40c3-b407-3c82a34ea97d")
     * @var string
     */
    public $client_id;
    /**
     * @SWG\Property(example="prGktQHLELaZDRWLYdSfJmAJ9PsQu2CUprGktQHLELaZDRWLYdSfJmAJ9PsQu2CU")
     * @var string
     */
    public $client_secret_clear;
}
