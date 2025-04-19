<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/private/google.php";

define("WEDDING_DAY", 23);
define("IMAGE_PATH", "/local/template/images/");

function vdump($v, $die = false)
{
?>
    <pre style="display: block; text-align: left; border: 1px solid #ccc; padding: 20px; margin: 15px 0; background: #152735; color: #ccc; border-radius: 10px; box-shadow: 1px 1px 8px rgba(0,0,0,0.6);">
            <?= htmlspecialchars(print_r($v, 1)); ?>
        </pre>
<?
    if ($die) {
        die;
    }
}
