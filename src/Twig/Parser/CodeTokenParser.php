<?php
declare(strict_types=1);

namespace Xgc\CodePrettifyBundle\Twig\Parser;

use Twig_Error_Syntax;
use Twig_Node;
use Twig_Token;
use Twig_TokenParser;
use Xgc\CodePrettifyBundle\Twig\Node\CodeNode;

/**
 * Class CodeTokenParser
 *
 * @package Xgc\CodePrettifyBundle\Twig\Parser
 */
class CodeTokenParser extends Twig_TokenParser
{

    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token
     *
     * @return Twig_Node A Twig_Node instance
     */
    public function parse(Twig_Token $token): Twig_Node
    {
        $parser = $this->parser;
        $stream = $parser->getStream();

        $name = $stream->expect(Twig_Token::NAME_TYPE)->getValue();
        $stream->expect(Twig_Token::NAME_TYPE, '');
        $value = $parser->getExpressionParser()->parseExpression();
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new CodeNode($name, $value, $token->getLine(), $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag(): string
    {
        return 'code';
    }
}
