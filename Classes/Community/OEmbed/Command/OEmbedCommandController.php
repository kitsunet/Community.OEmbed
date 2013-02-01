<?php
namespace Community\OEmbed\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Community.OEmbed".      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Command controller to test OEmbed
 *
 * @Flow\Scope("singleton")
 */
class OEmbedCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \Community\OEmbed\Domain\Service\DiscoveryService
	 */
	protected $discoveryService;

	/**
	 * Test
	 *
	 * @param string $uri
	 * @return void
	 */
	public function testCommand($uri = 'http://www.youtube.com/watch?v=YfFKT-VtK4s') {
		$oEmbedResource = $this->discoveryService->getResource($uri);
		var_dump($oEmbedResource);
	}
}

?>