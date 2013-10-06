<?php
/*
 */

namespace bogo\tree;

/**
 * Description of Node
 *
 * @author drcypher
 */
class Node implements INodeset
{
	/**
	 * Id of node.
	 *
	 * @var mixed
	 */
	protected $id;

	/**
	 * Object wrapped in node.
	 *
	 * @var mixed
	 */
	protected $object;

	/**
	 * Child nodes.
	 *
	 * @var NodeArray
	 */
	protected $children = null;

	public function __construct($object, $id)
	{
		$this->i = 0;
		$this->id = $id;
		$this->object = $object;
		$this->children = new NodeArray();
	}

	private $i;

	public function getId()
	{
		return $this->id;
	}

	public function getObject()
	{
		return $this->object;
	}

	/**
	 *
	 * @return NodeArray
	 */
	public function getChildren()
	{
		return $this->children;
	}

	public function current()
	{
		return $this;
	}

	public function hasChildren()
	{
		return !empty($this->children);
	}

	public function key()
	{
		return $this->i;
	}

	public function next()
	{
		$this->i++;
	}

	public function rewind()
	{
		$this->i = 0;
	}

	public function valid()
	{
		return ($this->i <= 1);
	}
}
