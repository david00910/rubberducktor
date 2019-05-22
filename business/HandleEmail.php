<?php
spl_autoload_register(function ($class)
{include"".$class.".php";});

require_once('../persistence/AboutDAO.php');
$aDAO = new AboutDAO();
$email = $aDAO->readCompany();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

if(isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "contact") {
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

            // Build POST request:
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = '6LcIO6QUAAAAAJkuF6bJr32xLKqhBCACANqGpSir';
            $recaptcha_response = $_POST['recaptcha_response'];

            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            // Take action based on the score returned:
            if ($recaptcha->score >= 0.5) {
                // Verified - send email
                
                foreach ($email as $mailTo) {

                    $companyMail = $mailTo["companyEmail"];

                }

                $fromEmail = trim(htmlspecialchars($_POST["email"]));

                $fullName = trim(htmlspecialchars($_POST["fullname"]));
                $subject = trim(htmlspecialchars($_POST["subject"]));
                $message = trim(htmlspecialchars($_POST["message"]));


                if (isset($fromEmail)) {
                    // Validate e-mail
                    if (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
                        echo("$fromEmail is not a valid email address. Please provide a valid email address, so we can get back to you!");
                    }


                    // Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                        $mail->isSMTP();                                            // Set mailer to use SMTP
                        $mail->Host = 'smtp.unoeuro.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                        $mail->Username = 'info@angletech.dk';                     // SMTP username
                        $mail->Password = 'AN#!!211G&Le!?';                               // SMTP password
                        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                // TCP port to connect to

                        //Recipients
                        $mail->setFrom($fromEmail, $fullName);
                        $mail->addAddress($companyMail, 'Administrator');     // Add a recipient

                        // Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        $mail->AltBody = $message;

                        $mail->send();

                        $checkMessage = "We have received your message. <br> We will get back to you shortly. <br> Thank you for choosing RubberDucktor! :)";
                        $redirect = new RedirectUser("../presentation/contactUs.php?message=$checkMessage");
                    } catch (Exception $e) {

                        $redirect = new RedirectUser("../presentation/contactUs.php?message=$mail->ErrorInfo");
                    }

                }
            } else {
                echo "Anti-spam protection denied your request";
            }
        }



    }
}


?>