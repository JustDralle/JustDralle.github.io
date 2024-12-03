<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inclure le fichier autoload de PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

              if (strpos($message, 'SEO') !== false) {
                echo '<script>window.location.href = "confirm.html";</script>';
            } else if (strpos($message, "Entrepreneur") !== false)
                echo '<script>window.location.href = "confirm.html";</script>';
            else if (strpos($message, "https") !== false)
            	echo '<script>window.location.href = "confirm.html";</script>';

    else{
        // Configuration de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Paramètres SMTP
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Activez le débogage si nécessaire
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com'; // Serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'messages@dralle.fr'; // Votre adresse e-mail SMTP
            $mail->Password = 'Thisisapassword.03'; // Votre mot de passe SMTP
            $mail->SMTPSecure = "ssl"; // Utiliser SSL pour la connexion SMTP
            $mail->Port = 465; // Port SMTP pour SSL              

            // Destinataire
            $mail->setFrom('messages@dralle.fr', 'Tristan Milleville');
            $mail->addAddress('tristan.milleville@dralle.fr', 'Tristan Milleville');        

            // Contenu du message
            $mail->isHTML(true);
            $mail->Subject = "Nouveau message de $name venant du site Portfolio CDabernat" ;
            $mail->Body = "Nom: $name<br>E-mail: $email<br>Message: $message";

            // Vérifier si le mot "SEO" est présent dans le message
            if (strpos($message, 'SEO') !== false) {
                // Ne rien faire
            } else if (strpos($message, "Entrepreneur") !== false)
                echo "still no.";
            else if (strpos($message, "https://") !== false)
                echo "ewww links";
            else {
                $mail->send();
            }

            echo '<script>window.location.href = "confirm.html";</script>';

        } catch (Exception $e) {
            echo "Une erreur s'est produite lors de l'envoi du message : {$mail->ErrorInfo}";
        }
    }
}
