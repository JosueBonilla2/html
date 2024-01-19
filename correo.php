<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once "conexion.php";

    function mandar_correo($archivo){

        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';
        require 'phpmailer/src/Exception.php';

        if(!isset($_SESSION['user'])){
            header('Location: logIn.html');
        }
        else{
            $user = $_SESSION['user'];
        }

        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = 0;                   
            $mail->isSMTP();                                          
            $mail->Host       = 'smtp.gmail.com';                   
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'josuebc2720@gmail.com';                     
            $mail->Password   = 'oame wfiw soea sxeg';                              
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


            $mail->setFrom('josuebc2720@gmail.com', 'POSTMORTEM');    
            $mail->addAddress($user);    


            $mail->isHTML(true);                                  
            $mail->Subject = 'TICKET COMPRA POSTMORTEM';
            $cuerpo = '<h4>En nombre de todo el equipo de POSTMORTEM, queremos expresar nuestro más sincero agradecimiento por elegirnos para satisfacer tus gustos exquisitos en licores. ¡Tu elección nos llena de alegría y gratitud!

            En POSTMORTEM, nos esforzamos por ofrecer no solo productos excepcionales, sino también una experiencia de compra única. Valoramos tu confianza en nosotros y nos comprometemos a seguir ofreciéndote los licores más selectos y una atención al cliente excepcional.
            
            Gracias nuevamente por elegir POSTMORTEM. Esperamos que disfrutes de tu compra y que nos brindes la oportunidad de servirte nuevamente en el futuro.
            
            Salud y buenos momentos, FELIZ NAVIDAD!!!</<h4>';
            $mail->Body    = utf8_decode($cuerpo);

            $pdfFilePath = 'Ticket.pdf'; // Ruta al archivo PDF que deseas adjuntar
            $mail->addAttachment($pdfFilePath);
            
            $mail->setLanguage('es','phpmailer.lang-es.php');

            $mail->send();

        } catch (Exception $e) {
                echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
                exit;   
            }
    }
    
?>
