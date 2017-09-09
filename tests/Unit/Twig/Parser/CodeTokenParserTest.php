<?php
declare(strict_types=1);

namespace Tests\Unit\Twig\Parser;

use Twig_Environment;
use Twig_Error_Syntax;
use Twig_Parser;
use Twig_Token;
use Twig_TokenStream;
use Xgc\CodePrettifyBundle\Test\TestCase;
use Xgc\CodePrettifyBundle\Twig\Parser\CodeTokenParser;

/**
 * Class CodeTokenParserTest
 *
 * @package Tests\Unit\Twig\Parser
 */
class CodeTokenParserTest extends TestCase
{

    public function testWithLanguage()
    {
        $twig = new Twig_Environment($this->getMockBuilder('Twig_LoaderInterface')->getMock(), [
            'autoescape'    => false,
            'optimizations' => 0,
        ]);
        $twig->addTokenParser(new CodeTokenParser());
        $parser = new Twig_Parser($twig);

        $node = $parser->parse(new Twig_TokenStream([
            new Twig_Token(Twig_Token::BLOCK_START_TYPE, '', 1),
            new Twig_Token(Twig_Token::NAME_TYPE, 'code', 2),
            new Twig_Token(Twig_Token::BLOCK_END_TYPE, '', 4),

            new Twig_Token(Twig_Token::BLOCK_START_TYPE, '', 5),
            new Twig_Token(Twig_Token::NAME_TYPE, 'endcode', 6),
            new Twig_Token(Twig_Token::BLOCK_END_TYPE, '', 8),

            new Twig_Token(Twig_Token::EOF_TYPE, 'endcode', 9)
        ]));

        $twig->compile($node);

        self::pass();
    }

    public function testWithoutLanguage()
    {
        $twig = new Twig_Environment($this->getMockBuilder('Twig_LoaderInterface')->getMock(), [
            'autoescape'    => false,
            'optimizations' => 0,
        ]);
        $twig->addTokenParser(new CodeTokenParser());
        $parser = new Twig_Parser($twig);

        $node = $parser->parse(new Twig_TokenStream([
            new Twig_Token(Twig_Token::BLOCK_START_TYPE, '', 1),
            new Twig_Token(Twig_Token::NAME_TYPE, 'code', 5),
            new Twig_Token(Twig_Token::BLOCK_END_TYPE, '', 3),

            new Twig_Token(Twig_Token::BLOCK_START_TYPE, '', 4),
            new Twig_Token(Twig_Token::NAME_TYPE, 'endcode', 5),
            new Twig_Token(Twig_Token::BLOCK_END_TYPE, '', 6),

            new Twig_Token(Twig_Token::EOF_TYPE, 'endcode', 8)
        ]));

        $twig->compile($node);

        self::pass();
    }
}
