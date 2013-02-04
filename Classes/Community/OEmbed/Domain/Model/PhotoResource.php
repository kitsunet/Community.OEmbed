<?php
namespace Community\OEmbed\Domain\Model;

	/*                                                                        *
	 * This script belongs to the TYPO3 Flow package "Community.OEmbed".      *
	 *                                                                        *
	 * It is free software; you can redistribute it and/or modify it under    *
	 * the terms of the GNU General Public License, either version 3 of the   *
	 * License, or (at your option) any later version.                        *
	 *                                                                        *
	 * The TYPO3 project - inspiring people to share!                         *
	 *                                                                        */

/**
 * An image oEmbed resource
 */
class PhotoResource extends AbstractResource implements ResourceInterface {

	/**
	 * HTML code to embed the oEmbed resource
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * @var integer
	 */
	protected $width;

	/**
	 * @var integer
	 */
	protected $height;

	/**
	 * @param int $height
	 */
	public function setHeight($height) {
		$this->height = $height;
	}

	/**
	 * @return int
	 */
	public function getHeight() {
		return $this->height;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param int $width
	 */
	public function setWidth($width) {
		$this->width = $width;
	}

	/**
	 * @return int
	 */
	public function getWidth() {
		return $this->width;
	}

	/**
	 * Return best available string representation of the oEmbed resource
	 *
	 * @return string
	 */
	public function __toString() {
		return '<img href="' . $this->url . '" alt="' . $this->title . '" />';
	}
}

?>