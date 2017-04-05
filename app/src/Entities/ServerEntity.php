<?php
namespace STUN\Entities;
/**
 * @SWG\Definition(required={"fqdn","ip","organization","geolocation"}, type="object", @SWG\Xml(name="Server"))
 */
class Server
{
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
     * @var IP[]
     */
    public $ip;
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
