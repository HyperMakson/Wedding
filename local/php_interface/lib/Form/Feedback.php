<?php

namespace lib\Form;

use lib\Logging\Log;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Feedback
{
    protected array $mailData = [];
    protected string $mailSubject = "";
    protected string $mailBody = "";

    public function __construct($mailData = [])
    {
        $this->mailData = $mailData;
    }

    public static function checkBoolean($boolean = ""): bool
    {
        if (!filter_var($boolean, FILTER_VALIDATE_BOOLEAN)) {
            return false;
        }

        return true;
    }

    public static function checkPhone($phone = ""): bool
    {
        if (empty($phone)) {
            return false;
        }

        if (!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $phone)) {
            return false;
        }

        return true;
    }

    public static function checkEmail($email = ""): bool
    {
        if (empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    protected function setMailData($sendSelf = true): bool
    {
        if (empty($this->mailData)) {
            return false;
        }

        $this->mailSubject = "Приглашение на свадьбу Максима и Вики";
        $templateFile = $sendSelf ? "invitation_result.php" : "invitation_guest.php";

        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/local/template/include/email/{$templateFile}";
        $this->mailBody = ob_get_clean();

        return true;
    }

    public function sendMail($sendSelf = true): bool
    {
        if (empty($this->mailData)) {
            return false;
        }

        $mail = new PHPMailer(true);
        $recipientMail = SMTP_LOGIN;

        if (!$sendSelf) {
            if (empty($this->mailData["email"])) {
                return false;
            }
            $recipientMail = $this->mailData["email"];
        }

        if (!$this->setMailData($sendSelf)) {
            return false;
        }

        try {
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_LOGIN;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = SMTP::DEFAULT_SECURE_PORT;

            $mail->setFrom(SMTP_LOGIN, MAIL_NAME);
            $mail->addAddress($recipientMail);

            $mail->isHTML(true);
            $mail->Subject = $this->mailSubject;
            $mail->msgHTML($this->mailBody);

            $mail->send();
        } catch (Exception $e) {
            Log::makeLog($mail->ErrorInfo, "mail_error.txt");

            return false;
        }

        return true;
    }
}
