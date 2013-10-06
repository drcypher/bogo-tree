<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bogo\tree;

/**
 * Description of NodeArray
 *
 * @author drcypher
 */
class NodeArray extends \RecursiveArrayIterator implements INodeset
{
	public function getChildren()
	{
		return $this->current()->getChildren();
	}

	public function hasChildren()
	{
		return $this->current()->hasChildren();
	}
}
