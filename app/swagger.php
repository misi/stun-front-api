<?php
/**
  * @SWG\Swagger(
  *     schemes={"https"},
  *     basePath="/v1",
  *     @SWG\Info(
  *         version="1.0",
  *         title="TURN FRONTEND API",
  *         description="TURN FrontEnd REST INTERFACE",
  *         @SWG\Contact(name="STUN Ops Team", email="stun-devops@listserv.niif.hu")
  *     ),
  * )
  */

/**
  * @SWG|SecurityScheme(
  *     securityDefinition="clientauth",
  *     description="OAuth Client Credenrials Grant Flow",
  *     type="oauth2",
  *     flow="application",
  *     tokenUrl="https://vackor.lab.vvc.niif.hu/as/access_token",
  *     scopes={
  *         "ltc": "access to ltc service"
  *         "rest": "access to rest"
  *         "oauth": "access to oauth service"
  *     }
  * )
  */
