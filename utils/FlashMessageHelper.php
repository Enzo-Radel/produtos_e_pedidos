<?php
namespace Utils;

class FlashMessageHelper
{
    public static function setFlashMessage(string $type, string $message)
    {
        $_SESSION["alert"] = [
            "type"      => $type,
            "message"   => $message
        ];
    }

    public static function getFlashMessage()
    {
        if (isset($_SESSION["alert"])) {
            $_REQUEST["alert"] = $_SESSION["alert"];
            unset($_SESSION["alert"]);
        }
    }
}