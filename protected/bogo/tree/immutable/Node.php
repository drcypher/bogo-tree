<?php
/*
 */

namespace bogo\tree\immutable;

/**
 * Description of ImmutableNode
 *
 * @author drcypher
 */
class Node extends \bogo\tree\Node
{
	private $height;
	private $parent;

	public function __construct($object, $id, $generator, $height, $parent)
	{
		parent::__construct($object, $id);

		$this->height = $height;
		$this->parent = $parent;

		foreach ($generator->getChildObjectsById($id) as $childId=>$childObject) {
//			echo __LINE__.' '.$childObject."\n";
			$childNode = new Node($childObject, $childId, $generator, $height + 1, $this);

			$this->children[] = $childNode;
		}
	}
}
