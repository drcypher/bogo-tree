<?php
namespace BogoTree\Mutable;

/**
 * Node.
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
 */
class Node extends \BogoTree\Node
{
	/**
	 * Distance from the root.
	 *
	 * @var integer
	 */
	private $height;

	/**
	 * Wraps a piece of data in a tree node.
	 *
	 * @param mixed $data
	 * @param Node $parentNode
	 */
	public function __construct($data = null, $parentNode = null)
	{
		$this->object = $data;

		if ($parentNode === null) {
			$this->height = 0;
		} else {
			$this->parentNode = $parentNode;
			$this->height = $parentNode->getHeight() + 1;
		}
	}

	/**
	 * Add a child node.
	 *
	 * @param Node $child
	 */
	public function addChild($child)
	{
		$this->children[] = $child;
	}

	/**
	 * 
	 * @return Nodeset
	 */
	public function asNodeset()
	{
		return new Nodeset(array($this));
	}

	/**
	 * Distance from the root.
	 *
	 * @return integer
	 */
	public function getHeight()
	{
		return $this->height;
	}
}
