<?php

namespace App\Configs;

/**
 * Class DateConfig.
 *
 * @description Форматы дат.
 */
final class DateConfig
{
    public const FORMAT_DEFAULT = 'd.m.Y';
    public const FORMAT_DEFAULT_FULL = 'd.m.Y H:i:s';
    public const FORMAT_SQL = 'Y-m-d';
    public const FORMAT_SQL_FULL = 'Y-m-d H:i:s';
    public const FORMAT_ISO_FULL = 'Y-m-d\TH:i:sP';
}
