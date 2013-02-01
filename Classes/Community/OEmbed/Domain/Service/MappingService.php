<?php
namespace Community\OEmbed\Domain\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Community.OEmbed".      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use \TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class MappingService {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * @param string $data
	 * @return \Community\OEmbed\Domain\Model\ResourceInterface
	 */
	public function mapJsonDataToObject($data) {
		$dataArray = json_decode($data, TRUE);

		return $this->mapArrayDataToObject($dataArray);
	}

	/**
	 * @param array $dataArray
	 * @return \Community\OEmbed\Domain\Model\ResourceInterface
	 * @throws \Community\OEmbed\Exception
	 */
	protected function mapArrayDataToObject(array $dataArray) {
		if (isset($dataArray['type']) && $this->objectTypeExists($dataArray['type'])) {
			$className = $this->deriveClassName($dataArray['type']);
			$oEmbedResource = new $className;
			return $this->mapDataToObject($dataArray, $oEmbedResource);
		} else {
			throw new \Community\OEmbed\Exception('Retrieved data contained no type, could not map to OEmbed object', 1359741982);
		}
	}

	/**
	 * @param string $type
	 * @return string
	 */
	protected function deriveClassName($type) {
		return 'Community\\OEmbed\\Domain\Model\\' . ucfirst($type) . 'Resource';
	}

	/**
	 * @param array $dataArray
	 * @param \Community\OEmbed\Domain\Model\ResourceInterface $oEmbedResource
	 * @return \Community\OEmbed\Domain\Model\ResourceInterface
	 */
	protected function mapDataToObject($dataArray, $oEmbedResource) {
		$additionalProperties = array();
		foreach ($dataArray as $dataKey => $propertyValue) {
			$propertyName = $this->derivePropertyNameFromDataKey($dataKey);
			$possibleSetterName = 'set' . ucfirst($propertyName);
			if (is_callable(array($oEmbedResource, $possibleSetterName))) {
				call_user_func(array($oEmbedResource, $possibleSetterName), $propertyValue);
			} else {
				$additionalProperties[$propertyName] = $propertyValue;
			}
		}
		$oEmbedResource->setAdditionalProperties($additionalProperties);

		return $oEmbedResource;
	}

	/**
	 * @param string $dataKey
	 * @return string
	 */
	protected function derivePropertyNameFromDataKey($dataKey) {
		return lcfirst(implode('', array_map('ucfirst', explode('_', $dataKey))));
	}

	/**
	 * @param string $type
	 * @return boolean
	 */
	protected function objectTypeExists($type) {
		return $this->objectManager->isRegistered($this->deriveClassName($type));
	}
}

?>