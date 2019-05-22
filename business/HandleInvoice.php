<?php
spl_autoload_register(function ($class)
{include"".$class.".php";});



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

function createInvoice() {



    require('../vendor/fpdf181/fpdf.php');

    $issuer = 'RubberDucktor ApS';
    $cvv = '23313-333';

    $bFirst = $_SESSION["firstName"];
    $bLast = $_SESSION["lastName"];
    $date = date('Y-m-d H:i:s');
    $item_total = 0;



    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(55, 5, 'Issued by:', 0, 0);
    $pdf->Cell(58, 5, $issuer, 0, 0);
    $pdf->Cell(25, 5, 'CVV:', 0, 0);
    $pdf->Cell(52, 5, $cvv, 0, 1);
    $pdf->Cell(55, 5, 'Paid by:', 0, 0);
    $pdf->Cell(58, 5, $bFirst, 0, 0);
    $pdf->Cell(25, 5, $bLast, 0, 0);
    $pdf->Cell(10, 5, 'Date:', 0, 0);
    $pdf->Cell(58, 5, $date, 0, 1);
    $pdf->Line(10, 30, 200, 30);
    $pdf->Ln(10);
    foreach ($_SESSION["cartItem"] as $item) {
        if (isset($item["itemOnSalePrice"])) {
            $item["itemPrice"] = $item["itemOnSalePrice"];
        }
        $item_total += ($item["itemPrice"]*$item["itemQuantity"]); $totalPrice = 0;
        $totalPrice += ($item_total +49);

        $pdf->Cell(15, 5, 'Name:', 0, 0);
        $pdf->Cell(85, 5, $item["itemName"], 0, 0);
        $pdf->Cell(20, 5, 'Quantity:', 0, 0);
        $pdf->Cell(35, 5, $item["itemQuantity"], 0, 0);
        $pdf->Cell(15, 5, 'Price:', 0, 0);
        $pdf->Cell(50, 5, $item["itemPrice"]. ' DKK', 0, 0);
        $pdf->Ln(7, 75, 2, 2);
    }
    $pdf->Ln(10);//Line break
    $pdf->Cell(55, 5, 'Shipping:', 0, 0);
    $pdf->Cell(55, 5, '49 DKK', 0, 0);
    $pdf->Ln(7, 75, 2, 2);
    $pdf->Cell(55, 5, 'Total:', 0, 0);
    $pdf->Cell(58, 5, $totalPrice. ' DKK', 0, 1);

    $pdf->Line(155, 75, 195, 75);
    $pdf->Ln(5);//Line break

  	$length = 32;
    $createName = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    $pdfName = $createName.".pdf";
    $filename="../includes/invoices/".$pdfName;
    $pdf->Output($filename, 'F');

    $mail = new PHPMailer(true);

	$aDAO = new AboutDAO();
    $compMail = $aDAO->readCompany();
  foreach ($compMail as $sendMailFrom) { }
  
    $fromEmail = $_SESSION["email"];
    $fullName = $_SESSION["firstName"]. " " .$_SESSION["lastName"];

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
        $mail->setFrom($sendMailFrom["companyEmail"], 'Administrator');
        $mail->addAddress($fromEmail, $fullName);     // Add a recipient

        // Attachments
        $mail->addAttachment($filename);         // Add attachments
        

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Invoice for your last purchase';
        $mail->Body = 'Thank you for using RubberDucktor! You can find your invoice attached';
        $mail->AltBody = 'Thank you for using RubberDucktor! You can find your invoice attached';

        $mail->send();
      } catch (Exception $e) {

                        $redirect = new RedirectUser("../presentation/index.php?message=$mail->ErrorInfo");
                    }
}