<?php
namespace Community\OEmbed\ViewHelpers;

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
 * Renders a representation of a oEmbed resource.
 *
 * = Examples =
 *
 * <code title="rendering oEmbed resource with best representation">
 * {o:embed(uri: 'https://www.youtube.com/watch?v=x36gsF-2Tgc')}
 * </code>
 * <output>
 * (depending on the uri, in case of youtube video it will be youtube embed code html)
 * </output>
 *
 *
 * <code title="Rendering oEmbed resource with child rendering">
 * <o:embed uri="https://www.youtube.com/watch?v=x36gsF-2Tgc" objectName="oEmbedResource">
 * {oEmbedResource.title} - {oEmbedResource.authorName}
 * </o:embed>
 * </code>
 * <output>
 * (depending on the uri)
 * Developing a TYPO3 Phoenix Website (T3CON12DE) - typo3
 * </output>
 *
 */
class EmbedViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @var \Community\OEmbed\Domain\Service\DiscoveryService
	 * @Flow\Inject
	 */
	protected $discoveryService;

	/**
	 * Renders a representation of a oEmbed resource
	 *
	 * @param string $uri
	 * @param string $objectName
	 * @return string
	 * @throws \TYPO3\Fluid\Core\ViewHelper\Exception
	 */
	public function render($uri, $objectName = NULL) {
		$html = '';
		$resourceObject = NULL;
		try {
			$resourceObject = $this->discoveryService->getResource($uri);
		} catch (\Exception $exception) {
			$html = '<p>An exception occured trying to discover oEmbed resource at: "' . htmlentities($uri) . '"</p>';
			$html .= '<dl><dt>' . $exception->getCode() . '</dt><dd>' . htmlentities($exception->getMessage()) . '</dd></dl>';
		}

		if ($resourceObject !== NULL) {
			if ($objectName !== NULL) {
				if ($this->templateVariableContainer->exists($objectName)) {
					throw new \TYPO3\Fluid\Core\ViewHelper\Exception('Object name for EmbedViewHelper given as: ' . htmlentities($objectName) . '. This variable name is already in use, choose another.', 1359969229);
				}
				$this->templateVariableContainer->add($objectName, $resourceObject);
				$html = $this->renderChildren();
				$this->templateVariableContainer->remove($objectName);
			} else {
				$html = $resourceObject->__toString();
			}
		}

		return $html;
	}
}
?>