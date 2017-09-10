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
     * @throws Twig_Error_Syntax
     */
    public function parse(Twig_Token $token): Twig_Node
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $params = \array_merge([], $this->getInlineParams());

        $continue = true;
        while ($continue) {
            $body = $this->parser->subparse([$this, 'decideMyTagFork']);

            $tag = $stream->next()->getValue();

            if ($tag === 'endcode') {
                $continue = false;
            }

            \array_unshift($params, $body);
            $stream->expect(Twig_Token::BLOCK_END_TYPE);
        }

        return new CodeNode(new Twig_Node($params), $lineno, $this->getTag());
    }

    /**
     * @return array
     */
    protected function getInlineParams(): array
    {
        $stream = $this->parser->getStream();
        $params = [];
        /*while (!$stream->test(Twig_Token::BLOCK_END_TYPE)) {
            $params[] = $this->parser->getExpressionParser()->parseExpression();
        }*/
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return $params;
    }

    /**
     * @param Twig_Token $token
     *
     * @return bool
     */
    public function decideMyTagFork(Twig_Token $token): bool
    {
        return $token->test(['endcode']);
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
