<?php
/**
 * @SWG\Definition(required={"fqdn","ip","organization","geolocation"}, type="object", @SWG\Xml(name="Server"))
 */
class Server
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
    public $fqdn;
    /**
     * @SWG\Property(example="GITDA/NIIF")
     * @var string
     */
    public $organization;
    /**
     * @SWG\Property()
     * @var IP
     */
    public $ip;
    /**
     * @SWG\Property()
     * @var Geolocation
     */
    public $geolocation;
}
