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

        // recovers all inline parameters close to your tag name
        $params = \array_merge([], $this->getInlineParams());

        $continue = true;
        while ($continue) {
            // create subtree until the decideMyTagFork() callback returns true
            $body = $this->parser->subparse([$this, 'decideMyTagFork']);

            // I like to put a switch here, in case you need to add middle tags, such
            // as: {% mytag %}, {% nextmytag %}, {% endmytag %}.
            $tag = $stream->next()->getValue();

            if ($tag === 'endcode') {
                $continue = false;
            }

            // you want $body at the beginning of your arguments
            \array_unshift($params, $body);

            // if your endmytag can also contains params, you can uncomment this line:
            // $params = array_merge($params, $this->getInlineParams($token));
            // and comment this one:
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
