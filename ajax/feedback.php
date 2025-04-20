<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/init.php";

$result = [
    'success' => false,
    'presense' => true,
    'error' => [],
    'data' => [],
];

try {
    if (isset($_POST["name"]) && isset($_POST["phone"])) {
        $obCaptcha = new lib\Form\Captcha();
        $token = $_POST["g-recaptcha-response"] ?? "";
        $checkCaptcha = $obCaptcha->checkCaptcha(SECRET_KEY, $token);

        if (!$checkCaptcha) {
            $result['error']['captcha'] = "Ошибка проверки reCAPTCHA";
        }

        if (isset($_POST["presense"])) {
            if (!lib\Form\Feedback::checkBoolean($_POST["presense"])) {
                $result['presense'] = false;
            }
        }

        $_POST["name"] = htmlspecialchars($_POST["name"]);
        if (empty($_POST["name"])) {
            $result['error']['name'] = "Не указано имя";
        }

        if (!lib\Form\Feedback::checkPhone($_POST["phone"])) {
            $result['error']['phone'] = "Неправильно указан телефон";
        }

        if (isset($_POST["email"])) {
            if (!lib\Form\Feedback::checkEmail($_POST["email"])) {
                $result['error']['email'] = "Неправильно указан email";
            }
        }

        if (isset($_POST["alcohol"])) {
            $_POST["alcohol"] = htmlspecialchars($_POST["alcohol"]);
        }

        $result['data'] = [
            'presense' => $result['presense'],
            'name' => empty($result['error']['name']),
            'phone' => empty($result['error']['phone']),
            'email' => empty($result['error']['email']),
            'alcohol' => true,
        ];

        if (empty($result['error'])) {
            $obFeedback = new lib\Form\Feedback();

            if (isset($_POST["email"]) && $result['presense']) {
                $sendMail = $obFeedback->sendMail();
            }

            $result['success'] = true;
        }
    }

    // throw new Exception("test");
} catch (Exception $e) {
    $result['error'][] = "Error " . $e->getCode() . ": " . $e->getMessage();
}

die(json_encode($result));