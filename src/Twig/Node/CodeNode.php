<?php
declare(strict_types=1);

namespace Xgc\CodePrettifyBundle\Twig\Node;

use Twig_Compiler;
use Twig_Node;

/**
 * Class CodeNode
 *
 * @package Xgc\CodePrettifyBundle\Twig\Node
 */
class CodeNode extends Twig_Node
{

    /**
     * CodeNode constructor.
     *
     * @param Twig_Node $params
     * @param int       $lineno
     * @param null      $tag
     */
    public function __construct(Twig_Node $params, $lineno = 0, $tag = null)
    {
        parent::__construct(['params' => $params], [], $lineno, $tag);
    }

    /**
     * @param Twig_Compiler $compiler
     */
    public function compile(Twig_Compiler $compiler)
    {
        $count = \count($this->getNode('params'));

        $compiler->addDebugInfo($this);

        $code = $count === 2 ? 'lang-' . $this->getNode('params')->getNode(1)->attributes['value'] : '';

        $compiler
            ->write('echo \'<pre class="prettyprint linenums ' . $code . ' ">\';')
            ->subcompile($this->getNode('params')->getNode(0))
            //->write('echo PHP_EOL . ob_get_clean();')
            ->write("echo '</pre>';")->raw(\PHP_EOL);
    }
}
