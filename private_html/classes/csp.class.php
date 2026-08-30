<?php

namespace OffTheGridCG;

class CSP
{
    public static function setHeader(): void
    {
        header('Content-Security-Policy: ' . self::buildPolicy());
    }

    private static function buildPolicy(): string
    {
        $directives = self::loadDirectives(__DIR__ . '/../data/csp.json');

        $parts = [];
        foreach ($directives as $directive => $sources) {
            if (!is_array($sources) || empty($sources)) {
                continue;
            }
            $parts[] = $directive . ' ' . implode(' ', $sources);
        }

        return implode('; ', $parts);
    }

    private static function loadDirectives(string $path): array
    {
        if (!file_exists($path)) {
            error_log("CSP_CONFIG_ERR: file not found at {$path}");
            return ['default-src' => ["'self'"]];
        }

        $directives = json_decode(file_get_contents($path), true);

        if (!is_array($directives) || json_last_error() !== JSON_ERROR_NONE) {
            error_log("CSP_CONFIG_ERR: invalid JSON in {$path}: " . json_last_error_msg());
            return ['default-src' => ["'self'"]];
        }

        return $directives;
    }
}
