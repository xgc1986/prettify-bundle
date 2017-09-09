<?php
declare(strict_types=1);

namespace Tests\Unit;

use Xgc\CodePrettifyBundle\CodePrettifyBundle;
use Xgc\CodePrettifyBundle\Test\TestCase;

/**
 * Class CodePrettifyBundleTest
 * @package Tests\Unit
 */
class CodePrettifyBundleTest extends TestCase
{
    public function testGetExtension()
    {
        new CodePrettifyBundle();
        self::pass();
    }
}
