<?php

namespace App\Action\PHPmailer;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//use App\Domain\listCons\Service\ListConsDataTable;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

/**
 * Action.
 */
final class phpMailerAction
{
    /**
     * @var Twig
     */
    private $twig;

    private $mailer;

    /**
     * The constructor.
     *
     * @param Twig $twig The twig engine
     */
    public function __construct(Responder $responder, Twig $twig)
    {
        $this->twig = $twig;
        $this->responder = $responder;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'b175e5ad58f9f5';                     // SMTP username
            $mail->Password   = 'c67927cc8a3cfe';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom('poczta@adrianbienias.pl', 'Prowadzący');
            $mail->addAddress('andrzej.luszc@gmail.com', 'Joe User');     // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
        
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
             $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

            //konwersja z html na format txt
            $html = new \Html2Text\Html2Text($mail->Body);
            $mail->AltBody = $html->getText();
        
            $mail->send();
            echo 'Wiadomość wysłano2';
        } catch (Exception $e) {
            echo "Wiadomość nie mogła zostać wysłana. Błąd mailera: {$mail->ErrorInfo}";
        }            
        return $this->twig->render($response, 'phpMailer/phpMailer.twig');
    }
    //if($_SERVER['REQUEST_METHOD'] === 'POST')

    // $config = [
    //     'from_email' => $_POST['from_email'],
    //     'from_name' => $_POST['from_name'],
    //     'mail_subject'=> $_POST['mail_subject'],
    //     'mail_body'=> $_POST['mail_body'],
    // ];
    // send_Mail($config);
}


