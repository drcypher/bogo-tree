<?php
namespace BogoTree;

/**
 * Description of Node
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
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
	 *
	 * @var Node
	 */
	protected $parent;

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
	 * Is this a leaf node?
	 *
	 * @return boolean
	 */
	public function isLeaf()
	{
		return !empty($this->children);
	}

	/**
	 * Is this a root node?
	 *
	 * @return boolean
	 */
	public function isRoot()
	{
		return ($this->parentNode === null);
	}

	/**
	 * Child nodes.
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
