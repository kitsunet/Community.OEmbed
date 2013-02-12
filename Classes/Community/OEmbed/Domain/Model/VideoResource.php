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
 * A video oEmbed resource
 */
class VideoResource extends AbstractResource implements ResourceInterface {

	/**
	 * HTML code to embed the oEmbed resource
	 *
	 * @var string
	 */
	protected $html;

	/**
	 * @var integer
	 */
	protected $width;

	/**
	 * @var integer
	 */
	protected $height;

	/**
	 * @var integer
	 */
	protected $duration;

	/**
	 * @var string
	 */
	protected $videoId;

	/**
	 * @param string $html
	 */
	public function setHtml($html) {
		$this->html = $html;
	}

	/**
	 * @return string
	 */
	public function getHtml() {
		return $this->html;
	}

	/**
	 * @param int $duration
	 */
	public function setDuration($duration) {
		$this->duration = $duration;
	}

	/**
	 * @return int
	 */
	public function getDuration() {
		return $this->duration;
	}

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
	 * @param string $videoId
	 */
	public function setVideoId($videoId) {
		$this->videoId = $videoId;
	}

	/**
	 * @return string
	 */
	public function getVideoId() {
		return $this->videoId;
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
		return $this->html;
	}
}

?>