<?php

namespace OffTheGridCG;

class CONFIG
{
    private static $instance = null;
    private $config = [];

    private function __construct()
    {
        $this->config = [
            'APP_ENV' => ENV::get('APP_ENV', 'production'),
            'APP_URL' => ENV::get('APP_URL'),
            'APP_TIMEZONE' => ENV::get('APP_TIMEZONE', 'UTC'),
            'MYSQL_HOST' => ENV::get('MYSQL_HOST', 'localhost'),
            'MYSQL_PORT' => ENV::get('MYSQL_PORT', '3306'),
            'MYSQL_DATABASE' => ENV::get('MYSQL_DATABASE'),
            'MYSQL_USER' => ENV::get('MYSQL_USER'),
            'MYSQL_PASSWORD' => ENV::get('MYSQL_PASSWORD', ''),
            'GTM_TAG' => ENV::get('GTM_TAG', ''),
            'GOOGLE_VERIFICATION' => ENV::get('GOOGLE_VERIFICATION', ''),

            'JS_PATH' => 'static/js/',
            'CSS_PATH' => 'static/css/',
            'VIDEO_PATH' => 'static/videos/',
            'PICTURE_PATH' => 'static/pictures/',
            'ICONS_PATH' => __DIR__ . '/../../public_html/static/pictures/icons/',

            'CLASSES_PATH' => '../private_html/classes/',
            'MODULES_PATH' => '../private_html/modules/',
            'PAGES_PATH' => '../private_html/pages/',
            'EPAGES_PATH' => '../private_html/pages/errors/',
            'VENDOR_PATH' => '../private_html/vendor/',

            'ASSET_VERSION' => self::loadAssetVersion(),
        ];
    }

    private static function loadAssetVersion(): string
    {
        $path = __DIR__ . '/../data/version.ini';

        if (!file_exists($path)) {
            return 'dev';
        }

        $ini = parse_ini_file($path);

        return $ini['version'] ?? 'dev';
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($key)
    {
        return $this->config[$key] ?? null;
    }
}