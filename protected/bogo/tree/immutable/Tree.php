<?php
/*
 */

namespace bogo\tree\immutable;

/**
 * Description of ImmutableTree
 *
 * @author drcypher
 */
class Tree extends \bogo\tree\Tree
{

	public function __construct(\bogo\tree\Generator $generator)
	{
		parent::__construct();

		foreach ($generator->getRootObjects() as $id=>$object) {
			$rootNode = new Node($object, $id, $generator, 0, null);
			$this->rootNodes[] = $rootNode;
		}
	}

}
