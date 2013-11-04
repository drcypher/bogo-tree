<?php
namespace BogoTree\Mutable;

/**
 * Mutable tree.
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
 */
class Tree extends \BogoTree\Tree
{
	/**
	 * Map of all nodes.
	 *
	 * @var \BogoTree\Mutable\Node[]
	 */
	private $nodes = array();

	/**
	 * Map of orphan nodes.
	 *
	 * @var integer[][]
	 */
	private $orphanNodeIds = array();

	/**
	 * Create a new node.
	 *
	 * @param mixed $data
	 * @param mixed $nodeId
	 * @param mixed $parentNodeId
	 * @return \BogoTree\Mutable\Node
	 */
	public function makeNode($data, $nodeId, $parentNodeId = null)
	{
		if ($parentNodeId === null) {
			// Root node
			$node = new \BogoTree\Mutable\Node($data);

			$this->rootNodes[$nodeId] = $node;
		} else {
			// Non-root node
			if (isset($this->nodes[$parentNodeId])) {
				// Normal non-root node
				$parentNode = $this->nodes[$parentNodeId];

				$node = new \BogoTree\Mutable\Node($data, $parentNode);

				$parentNode->addChild($node);
			} else {
				// Orphan non-root node
				$this->rootNodes[$nodeId] = $node;

				$this->orphanNodeIds[$parentNodeId][] = $nodeId;
			}

			// Is this the parent of nodes previously declared as orphan?
			if (isset($this->orphanNodeIds[$nodeId])) {
				// Claim our orphans!
				foreach ($this->orphanNodeIds[$nodeId] as $childNodeId) {
					$orphanChild = $this->nodes[$childNodeId];

					// Link parent to orphan
					$orphanChild->setParentNode($node);

					// Link orphan to parent
					$node->addChild($orphanChild);

					// Orphan node is not considered root any more
					unset($this->rootNodes[$childNodeId]);
				}

				// No orphans exist for this parent any more
				unset($this->orphanNodeIds[$nodeId]);
			}
		}

		// Save new node in full node array
		$this->nodes[$nodeId] = $node;

		return $node;
	}

	/**
	 * Get a node by its id.
	 *
	 * @param mixed $nodeId
	 * @return \BogoTree\Mutable\Node
	 */
	public function getNodeById($nodeId)
	{
		if (isset($this->nodes[$nodeId])) {
			return $this->nodes[$nodeId];
		} else {
			return null;
		}
	}

	/**
	 * Return a node array of nodes matching passed ids.
	 *
	 * @param integer[]|integer $nodeIds
	 * @return \BogoTree\NodeArray
	 */
	public function getNodesetByIds($nodeIds)
	{
		if (!is_array($nodeIds)) {
			$nodeIds = array($nodeIds);
		}

		$nodeset = new \BogoTree\NodeArray();
		foreach ($nodeIds as $nodeId) {
			if (isset($this->nodes[$nodeId])) {
				$nodeset[] = $this->nodes[$nodeId];
			}
		}

		return $nodeset;
	}
}
