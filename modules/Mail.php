<?php

require_once './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{
    private $to;
    private $subject;
    private $body;
    private $mail;

    function __construct($to, $subject, $body)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = getenv('SMTP_SERVER');
        $this->mail->SMTPAuth = true;
        $this->mail->Username = getenv('USERNAME');                     //SMTP username
        $this->mail->Password = getenv('PASSWORD');
        $this->mail->SMTPSecure = 'ssl';                       //Enable implicit TLS encryption
        $this->mail->Port = 465;
        $this->mail->setFrom(getenv('USERNAME'), getenv('NAME'));
        $this->mail->addAddress($this->to, $this->to);     //Add a recipient
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $this->subject; //Subject of the email
        $this->mail->Encoding = 'base64';
        $this->mail->Body = $this->body;
        $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

    function send()
    {
        try {
            $smtp_data = $this->mail->send();
            if ($smtp_data === true) {
                return "Email inviato con successo";
            } else {
                return "Email non inviato";
            }
        } catch (Exception $e) {
            return "Email non inviato - " . $e;
        }


    }
}
