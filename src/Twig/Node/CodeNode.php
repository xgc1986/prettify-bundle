<?php
declare(strict_types=1);

namespace Xgc\CodePrettifyBundle\Twig\Node;

use Twig_Node;

/**
 * Class CodeNode
 *
 * @package Xgc\CodePrettifyBundle\Twig\Node
 */
class CodeNode extends Twig_Node
{

    /**
     * Constructor.
     *
     * The nodes are automatically made available as properties ($this->node).
     * The attributes are automatically made available as array items ($this['name']).
     *
     * @param array  $nodes      An array of named nodes
     * @param array  $attributes An array of attributes (should not be nodes)
     * @param int    $lineno     The line number
     * @param string $tag        The tag name associated with the Node
     */
    public function __construct(array $nodes = [], array $attributes = [], $lineno = 0, $tag = null)
    {
        parent::__construct($nodes, $attributes, $lineno, $tag);
    }
}
