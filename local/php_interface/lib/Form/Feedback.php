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

        if ($sendSelf) {
            $this->mailSubject = "Приглашение на свадьбу Максима и Вики";
            ob_start();
?>
            <!DOCTYPE html>
            <html lang="ru">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Приглашение на свадьбу Максима и Вики</title>
            </head>

            <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td align="center">
                            <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="max-width: 600px; width: 100%;">
                                <thead>
                                    <tr>
                                        <td style="padding: 16px; background: #99AC79; text-align: center; border-radius: 8px;">
                                            <h1 style="margin: 0; color: #fff; font-size: 24px; font-weight: bold;">Максим и Вика</h1>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 32px 16px; font-size: 16px; line-height: 1.5; color: #333;">
                                            <p>
                                                Вы подтвердили приглашение на свадьбу <span style="font-weight: bold; color: #99AC79;">Максима и Вики</span>
                                                <br>
                                                С нетерпением ждём Вас на нашем празднике :)
                                            </p>
                                            <p style="margin-bottom: 5px;">
                                                Небольшое напоминание:
                                            </p>
                                            <ul style="margin-top: 5px;">
                                                <li>Дата: <span style="font-weight: bold; color: #99AC79;">23 августа 2025</span></li>
                                                <li>Торжественная регистрация:
                                                    <ul>
                                                        <li>Время: <span style="font-weight: bold; color: #99AC79;">11:40</span></li>
                                                        <li>Место: <span style="font-weight: bold; color: #99AC79;">ЗАГС, г. Тула, ул. Советская, 47</span></li>
                                                    </ul>
                                                </li>
                                                <li>Праздничный банкет:
                                                    <ul>
                                                        <li>Время: <span style="font-weight: bold; color: #99AC79;">15:30</span></li>
                                                        <li>Место: <span style="font-weight: bold; color: #99AC79;">Банкетный зал "VOYAGE", г. Тула, ул. Станиславского, 49</span></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <p>
                                                Возьмите с собой отличное настроение!
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="padding: 16px; background: #99AC79; text-align: center; font-size: 14px; line-height: 1.5; color: #fff; border-radius: 8px;">
                                            <p style="max-width: 330px; width: 100%; margin: 0 auto;">
                                                В случае возникновения вопросов в день свадьбы Вы всегда можете обратиться к Вике:
                                                <br>
                                                <a href="tel:+79207439680" style="color: #fff; font-weight: bold; text-decoration: none;">+7 920 743-96-80</a>
                                            </p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>

            </html>
        <?
            $this->mailBody = ob_get_clean();
        } else {
            $this->mailSubject = "Приглашение на свадьбу Максима и Вики";
            ob_start();
        ?>
            <!DOCTYPE html>
            <html lang="ru">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Приглашение на свадьбу Максима и Вики</title>
            </head>

            <body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td align="center">
                            <table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="max-width: 600px; width: 100%;">
                                <thead>
                                    <tr>
                                        <td style="padding: 16px; background: #99AC79; text-align: center; border-radius: 8px;">
                                            <h1 style="margin: 0; color: #fff; font-size: 24px; font-weight: bold;">Максим и Вика</h1>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 32px 16px; font-size: 16px; line-height: 1.5; color: #333;">
                                            <p>
                                                Вы подтвердили приглашение на свадьбу <span style="font-weight: bold; color: #99AC79;">Максима и Вики</span>
                                                <br>
                                                С нетерпением ждём Вас на нашем празднике :)
                                            </p>
                                            <p style="margin-bottom: 5px;">
                                                Небольшое напоминание:
                                            </p>
                                            <ul style="margin-top: 5px;">
                                                <li>Дата: <span style="font-weight: bold; color: #99AC79;">23 августа 2025</span></li>
                                                <li>Торжественная регистрация:
                                                    <ul>
                                                        <li>Время: <span style="font-weight: bold; color: #99AC79;">11:40</span></li>
                                                        <li>Место: <span style="font-weight: bold; color: #99AC79;">ЗАГС, г. Тула, ул. Советская, 47</span></li>
                                                    </ul>
                                                </li>
                                                <li>Праздничный банкет:
                                                    <ul>
                                                        <li>Время: <span style="font-weight: bold; color: #99AC79;">15:30</span></li>
                                                        <li>Место: <span style="font-weight: bold; color: #99AC79;">Банкетный зал "VOYAGE", г. Тула, ул. Станиславского, 49</span></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <p>
                                                Возьмите с собой отличное настроение!
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="padding: 16px; background: #99AC79; text-align: center; font-size: 14px; line-height: 1.5; color: #fff; border-radius: 8px;">
                                            <p style="max-width: 330px; width: 100%; margin: 0 auto;">
                                                В случае возникновения вопросов в день свадьбы Вы всегда можете обратиться к Вике:
                                                <br>
                                                <a href="tel:+79207439680" style="color: #fff; font-weight: bold; text-decoration: none;">+7 920 743-96-80</a>
                                            </p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>

            </html>
<?
            $this->mailBody = ob_get_clean();
        }

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
