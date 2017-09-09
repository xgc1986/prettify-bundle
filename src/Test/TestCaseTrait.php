<?php
declare(strict_types=1);

namespace Xgc\CodePrettifyBundle\Test;

/**
 * Trait TestCaseTrait
 *
 * @package Xgc\AsseticsBundle\Test
 *
 * @method static assertTrue(bool $value, ?string $message = null)
 */
trait TestCaseTrait
{
    public static function pass(): void
    {
        self::assertTrue(true);
    }
}
