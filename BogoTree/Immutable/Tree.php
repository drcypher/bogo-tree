<?php
namespace BogoTree\Immutable;

/**
 * Immutable Tree
 *
 * @author Konstantinos Filios <konfilios@gmail.com>
 */
class Tree extends \BogoTree\Tree
{

	public function __construct(\BogoTree\Generator $generator)
	{
		parent::__construct();

		foreach ($generator->getRootObjects() as $id=>$object) {
			$rootNode = new Node($object, $id, $generator, 0, null);
			$this->rootNodes[] = $rootNode;
		}
	}

}
