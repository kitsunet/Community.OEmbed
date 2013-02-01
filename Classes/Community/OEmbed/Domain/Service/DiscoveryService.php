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
class DiscoveryService {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Http\Client\Browser
	 */
	protected $browser;

	/**
	 * @Flow\Inject
	 * @var \Community\OEmbed\Domain\Service\MappingService
	 */
	protected $mappingService;

	const SERVICE_LINK_TAG_PATTERN = '#<link([^>]*)type="(application/json|text/xml)\+oembed"([^>]*)>#i';
	const SERVICE_URI_PATTERN = '/href="([^"]+)"/i';

	/**
	 *
	 */
	public function __construct() {

	}

	/**
	* @param string|\TYPO3\Flow\Http\Uri $uri
	* @return \Community\OEmbed\Domain\Model\ResourceInterface
	* @throws \InvalidArgumentException
	*/
	public function getResource($uri) {
		$engine = new \TYPO3\Flow\Http\Client\CurlEngine();
		$this->browser->setRequestEngine($engine);
		if (is_string($uri)) {
			$uri = new \TYPO3\Flow\Http\Uri($uri);
		}
		if (!$uri instanceof \TYPO3\Flow\Http\Uri) {
			throw new \InvalidArgumentException('$uri must be a URI object or a valid string representation of a URI.', 1333443624);
		}

		$serviceDesignator = $this->discoverOEmbedServiceDesignator($uri);
		$oEmbedData = $this->browser->request($serviceDesignator);

		return $this->mappingService->mapJsonDataToObject($oEmbedData->getContent());
	}

	/**
	 * @param \TYPO3\Flow\Http\Uri $uri
	 * @return string
	 * @throws \Community\OEmbed\Exception
	 */
	protected function discoverOEmbedServiceDesignator(\TYPO3\Flow\Http\Uri $uri) {
		//TODO: Cache OEmbedDesignators, if possible even only the base service uri
		$possibleOEmbedDesignators = array();

		$rawResourceResponse = $this->browser->request($uri);
		$matchedServiceTags = array();
		preg_match_all(self::SERVICE_LINK_TAG_PATTERN, $rawResourceResponse->getContent(), $matchedServiceTags);

		if (isset($matchedServiceTags[0])) {
			foreach ($matchedServiceTags[0] as $i => $link) {
				$uri = array();
				if (preg_match(self::SERVICE_URI_PATTERN, $link, $uri)) {
					$possibleOEmbedDesignators[$matchedServiceTags[2][$i]] = $uri[1];
				}
			}
		} else {
			throw new \Community\OEmbed\Exception('There was no OEmbed service URI discovered for the given given Resource URI: ' . htmlspecialchars($uri), 1359714226);
		}


			// TODO: support also XML
		if (!isset($possibleOEmbedDesignators['application/json'])) {
			throw new \Community\OEmbed\Exception('Currently only application/json OEmbed is supported, your resource URI seems to only allow: ' . htmlspecialchars(implode(', ', array_keys($possibleOEmbedDesignators))), 1359714227);
		}

		return $possibleOEmbedDesignators['application/json'];
	}
}
?>