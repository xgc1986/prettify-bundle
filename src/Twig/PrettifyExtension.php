<?php
declare(strict_types=1);

namespace Xgc\CodePrettifyBundle\Twig;

use Twig_Extension;
use Xgc\CodePrettifyBundle\Twig\Parser\CodeTokenParser;

/**
 * Class PrettifyExtension
 *
 * @package Xgc\CodePrettifyBundle\Twig
 */
class PrettifyExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getTokenParsers(): array
    {
        return [
            new CodeTokenParser()
        ];
    }
}
