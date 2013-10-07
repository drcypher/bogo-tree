<?php
namespace BogoTree\Immutable;

/**
 * Description of ImmutableNode
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
 */
class Node extends \BogoTree\Node
{
	private $height;

	public function __construct($object, $id, $generator, $height, $parentNode)
	{
		parent::__construct($object, $id);

		$this->height = $height;
		$this->parentNode = $parentNode;

		foreach ($generator->getChildObjectsById($id) as $childId=>$childObject) {
//			echo __LINE__.' '.$childObject."\n";
			$childNode = new Node($childObject, $childId, $generator, $height + 1, $this);

			$this->children[] = $childNode;
		}
	}
}
