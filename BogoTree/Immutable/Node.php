<?php
namespace BogoTree\Immutable;

/**
 * Immutable Node.
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
 */
class Node extends \BogoTree\Node
{
	private $height;

	public function __construct($object, $nodeId, $nodeGenerator, $height, $parentNode)
	{
		parent::__construct($object, $nodeId);

		$this->height = $height;
		$this->parentNode = $parentNode;

		foreach ($nodeGenerator->getChildObjectsById($nodeId) as $childId=>$childObject) {
//			echo __LINE__.' '.$childObject."\n";
			$childNode = new Node($childObject, $childId, $nodeGenerator, $height + 1, $this);

			$this->children[] = $childNode;
		}
	}
}
