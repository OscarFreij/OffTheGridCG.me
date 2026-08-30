<?php

namespace OffTheGridCG;

class ENV
{
    private static function fetchEnvData()
    {
        // Load environment variables from .env file if it exists
        if (file_exists(__DIR__ . '/../.env')) {
            $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue; // Skip comments
                }
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
                if (strlen($value) >= 2 && $value[0] === $value[-1] && ($value[0] === '"' || $value[0] === "'")) {
                    $value = substr($value, 1, -1);
                }
                putenv(sprintf('%s=%s', $name, $value));
            }
        } else {
            error_log("WRN: NO ENV FILE AT: ".(__DIR__ . '/../.env'));
        }
    }

    public static function get($key, $default = null)
    {
        self::fetchEnvData();
        $value = getenv($key);
        return $value !== false ? $value : $default;
    }
}