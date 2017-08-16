<?php

require_once 'DynamicsCRM2011.php';

class DynamicsCRM2011_ArrayOfEntity extends DynamicsCRM2011_Entity {
	private $entities;
	
	public function __construct() {
		$this->entityLogicalName = 'PartyList';
		$this->entities = array();
	}

	public function __toString() {
		$description = 'ArrayOfEntity:'. PHP_EOL;
		foreach($entites as $entity) {
			$description .= $entity . PHP_EOL;
		}
		return $description;
	}

	public function addEntity($entity) {
		array_push($this->entities, $entity);
	}

	public function getEntityDOM($allFields = false) {
		$collectionDOM = new DOMDocument();
		$valueNode = $collectionDOM->appendChild($collectionDOM->createElement('c:value'));
		$valueNode->setAttribute('i:type', 'b:ArrayOfEntity');

		foreach($this->entities as $entity) {
			$entityNode = $valueNode->appendChild($collectionDOM->createElement('b:Entity'));
			$importNode = $collectionDOM->importNode($entity->getEntityDOM(), true);
			
			foreach($importNode->childNodes as $childNode) {
				$entityNode->appendChild($childNode->cloneNode(true));
			}
		}

		return $valueNode;
	}
}