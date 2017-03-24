<?php
namespace STUN\Actions;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

use Psr\Log\LoggerInterface;

use STUN\Repositories\UserRepository
use STUN\Repositories\ServerRepository

final class GeneralAction
{
    private $logger;

    private $settings;

    public function __construct(LoggerInterface $logger, $settings)
    {
      $this->logger = $logger;
      $this->settings = $settings;
    }


    public function feedback(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $this->logger->debug("General action feedback dispatched");

        try{
          $mail = new PHPMailer;
          $mail->SMTPDebug = $this->settings['debug'];  // Enable verbose debug output
          $mail->isSMTP();        // Set mailer to use SMTP
          $mail->Host = $this->settings['host'];  // Specify main and backup SMTP servers

          $mail->CharSet = $this->settings['charset'];

          $mail->setFrom($this->settings['from']['email'], $this->settings['from']['displayname']);

          // set recipient
          $mail->addAddress($this->settings['to']['email'], $this->settings['to']['displayname']); // Add a recipient

          $mail->isHTML(true);

          $mail->Subject = $this->settings['subject'];
          $params=$request->getParsedBody();
          $mail->Body    = "Name: ".$params['Name']."<br>Email: ".$params['Email']."<br>Phone: ".$params['Phone']."<br>Message:".$params['Message'];
          $mail->AltBody = "Name: ".$params['Name']."\nEmail: ".$params['Email']."\nPhone: ".$params['Phone']."\nMessage:".$params['Message'];

          $mail->send();

          // cleanup
          $mail->ClearAddresses();

          $mail->addAddress($params['Email'], $params['Name']);     // Add a recipient
          $mail->Subject = ['acknowledgement']['subject'];
          $mail->Body = ['acknowledgement']['body'];
          $mail->AltBody = ['acknowledgement']['altbody'];

          $mail->Send();
       } catch (phpmailerException $e) {
         $this->logger->info($e->errorMessage());
         return $response->withStatus(500);
       }
       $this->withStatus(200);
};
