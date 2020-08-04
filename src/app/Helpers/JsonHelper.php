<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Class Json
 *
 * @description Обработчик json данных.
 */
final class JsonHelper
{
    const JSON_DEFAULT_UNESCAPED = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    const PRETTY_PRINT = self::JSON_DEFAULT_UNESCAPED | JSON_PRETTY_PRINT;

    /**
     * Json encode.
     *
     * @param array $array
     * @param int $options
     *
     * @return string
     */
    public static function encode(array $array, int $options = self::JSON_DEFAULT_UNESCAPED): string
    {
        $result = json_encode($array, $options);

        return $result;
    }

    /**
     * Print JSON data.
     *
     * @param $data
     *
     * @return string
     */
    public static function prettyPrint($data): string
    {
        $result = json_encode($data, self::PRETTY_PRINT);

        return $result;
    }

    /**
     * Json decode.
     *
     * @param string $json
     * @param bool $assoc
     *
     * @return mixed
     */
    public static function decode(string $json, bool $assoc = true)
    {
        $result = json_decode($json, $assoc);

        return $result;
    }
}
