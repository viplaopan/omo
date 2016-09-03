<?php
namespace OT;
class Mail {
//邮件发送
    function sendMail($to,$subject,$body)
    {
        Vendor('PHPMailer.PHPMailerAutoload');
        $mail = new \PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '1105234332';                 // SMTP username
        $mail->Password = 'mlgb3838';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->SMTPDebug = true;
        $mail->setFrom('1105234332@qq.com', 'ppp');
        $mail->addAddress($to, 'ohmyoffice');     // Add a recipient
        $mail->addReplyTo('18762259872@163.com', 'ppp');


        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if (!$mail->send()) {
            echo '发送失败!';
            dump($mail->ErrorInfo);
        } else {
            return true;
        }
    }
}
