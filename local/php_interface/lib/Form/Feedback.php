<?php
namespace lib\Form;

class Feedback
{
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

    public function sendMail(): bool
    {
        return true;
    }
}