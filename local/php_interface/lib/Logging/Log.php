<?php

namespace lib\Logging;

class Log
{
    public const DEFAULT_PATH = "/log/";

    public static function makeLog($data = [], $fileName = "log.txt"): bool
    {
        $log = "------------------------\n";
        $log .= date('d-m-Y H:i:s') . "\n";
        ob_start();
        var_export($data);
        $log .= ob_get_clean();
        $log .= "\n------------------------\n\n";
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . self::DEFAULT_PATH . $fileName, $log, FILE_APPEND | LOCK_EX);

        return true;
    }
}
