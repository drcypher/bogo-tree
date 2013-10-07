<?php
namespace BogoTree\Mutable;

/**
 * CBTree.
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
 */
class Tree extends \BogoTree\Tree
{
	/**
	 * Map of all nodes.
	 *
	 * @var CBTreeNode[]
	 */
	private $nodes = array();

	/**
	 * Create a new node.
	 *
	 * @param mixed $data
	 * @param mixed $nodeId
	 * @param mixed $parentNodeId
	 * @return CBTreeNode
	 */
	public function makeNode($data, $nodeId, $parentNodeId = null)
	{
		if ($parentNodeId === null) {
			$node = new \BogoTree\Mutable\Node($data);

			$this->rootNodes[] = $node;
		} else {
			$parentNode = $this->nodes[$parentNodeId];

			$node = new \BogoTree\Mutable\Node($data, $parentNode);

			$parentNode->addChild($node);
		}

		$this->nodes[$nodeId] = $node;

		return $node;
	}

	/**
	 * Get a node by its id.
	 *
	 * @param mixed $nodeId
	 * @return CBTreeNode
	 */
	public function getNodeById($nodeId)
	{
		if (isset($this->nodes[$nodeId])) {
			return $this->nodes[$nodeId];
		} else {
			return null;
		}
	}

	public function getNodesetByIds($nodeIds)
	{
		if (!is_array($nodeIds)) {
			$nodeIds = array($nodeIds);
		}

		$nodeset = array();
		foreach ($nodeIds as $nodeId) {
			if (isset($this->nodes[$nodeId])) {
				$nodeset[] = $this->nodes[$nodeId];
			}
		}

		return $nodeset;
	}
}
