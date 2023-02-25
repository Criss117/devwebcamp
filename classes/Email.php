<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $name;
    protected $token;

    public function __construct($email,$name,$token){
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function html($txt, $txt2, $link = 'confirm'){
        $content = '<html><head><style>';
        $content .= 'html{background-color: #eeeeee;text-align: center;}';
        $content .= '.container {width: 600px;margin: 0 auto;text-align: justify;font-size: 20px;background-color: #ffff;padding: 1rem;border-radius: 20px;width: 80%;max-width: 600px;text-align: center;}';
        $content .= '.title{background: linear-gradient(to right, #007df4, #00c8c2);-webkit-text-fill-color: transparent;background-clip: text;-webkit-background-clip: text;font-size: 80px;text-align: center;}';
        $content .= '@media (min-width:480px){.title{font-size: 100px;}}';
        $content .= 'a{text-decoration: none;color: #007df4;}';
        $content .= '.btn{margin: 30px;background-color: #007df4;padding: 10px;color: #ffff;font-weight: 700;font-size: 25px;text-align: center;display: inline-block;width: 60%; }';
        $content .= '</style></head><body>';
        $content .= '<h1 class="title">DevWebCamp</h1>';
        $content .= '<div class="container">';
        $content .= "<h2><strong>Hola ". s($this->name) . "</strong>".$txt."</h2>";
        $content .= '<p>'.$txt2.', haz click en el siguente botón</p>';
        $content .= "<a class='btn' href='".$_ENV['HOST']. $link."?token=".s($this->token)."'>Confirmar Cuenta</a>";
        $content .= '</div>';
        $content .= '<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>';
        $content .= '</body></html>';
        return $content;
    }

    public function confirm(){
        $content = $this->html('Confirma tu cuenta de DevWebCamp','Para acceder a tu cuenta');
        return $content;
    }
    public function recover(){
        $content = $this->html('¿Olvidaste tu contraseña de DevWebCamp?','Para restablecer tu contraseña','recover');
        return $content;
    }
    public function confirm_email(){
        $content = $this->html('¿Deseas cambiar el correo electronico registrado en DevWebCamp?','Para confirmar el cambio de cooreo');
        return $content;
    }

    public function sendEmail($type){
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
     
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->name);

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        switch($type){
            case 1:
                $content = $this->confirm();
                $mail->Subject = 'Confirma tu cuenta';
                break;
            case 2;
                $content = $this->recover();
                $mail->Subject = 'Restablece tu contraseña';
                break;
            case 3;
                $content = $this->confirm_email();
                $mail->Subject = 'Confirma tu correo';
                break;   
            default:
                return;    
        }
        $mail->Body = $content;

        //enviar email
        $mail->send();
    }

   

}