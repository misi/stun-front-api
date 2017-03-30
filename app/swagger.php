<?php
/**
  * @SWG\Swagger(
  *     schemes={"https"},
  *     basePath="/front/v1",
  *     host="api.turn.geant.org",
  *     @SWG\Info(
  *         version="1.0",
  *         title="TURN FRONTEND API",
  *         description="TURN FrontEnd REST INTERFACE",
  *         @SWG\Contact(name="STUN Ops Team", email="stun-devops@listserv.niif.hu")
  *     ),
  * )
  */


/**
  * @SWG\SecurityScheme(
  *     securityDefinition="implicit",
  *     description="OAuth Client Credenrials Grant Flow",
  *     type="oauth2",
  *     flow="implicit",
  *     authorizeUrl="https://vackor.lab.vvc.niif.hu/as/authorize",
  *     scopes={
  *         "ltc": "access to ltc service",
  *         "rest": "access to rest",
  *         "oauth": "access to oauth service",
  *         "general": "access to general service",
  *     }
  * )
  */

/**
  * @SWG\SecurityScheme(
  *     securityDefinition="client",
  *     description="OAuth Client Credenrials Grant Flow",
  *     type="oauth2",
  *     flow="application",
  *     tokenUrl="https://vackor.lab.vvc.niif.hu/as/access_token",
  *     scopes={
  *         "ltc": "access to ltc service",
  *         "rest": "access to rest",
  *         "oauth": "access to oauth service",
  *         "general": "access to general service",
  *     }
  * )
  */

  /**
    * @SWG\SecurityScheme(
    *   securityDefinition="api_key",
    *   type="apiKey",
    *   in="header",
    *   name="api_key"
    * )
    */
