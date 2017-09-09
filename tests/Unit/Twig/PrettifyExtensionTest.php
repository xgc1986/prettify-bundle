<?php
declare(strict_types=1);

/**
 * @codingStandardsIgnoreFile
 */

namespace Tests\Unit\Twig;

use Doctrine\Common\Annotations\TokenParser;
use Xgc\CodePrettifyBundle\Test\TestCase;
use Xgc\CodePrettifyBundle\Twig\Parser\CodeTokenParser;
use Xgc\CodePrettifyBundle\Twig\PrettifyExtension;

/**
 * Class PrettifyExtensionTest
 *
 * @package Tests\Unit\Twig
 */
final class PrettifyExtensionTest extends TestCase
{

    public function testGetFunction()
    {
        $extension = new PrettifyExtension();
        self::assertCount(1, $extension->getTokenParsers());
        self::assertInstanceOf(CodeTokenParser::class, $extension->getTokenParsers()[0]);
    }
}
