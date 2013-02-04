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
 * Abstract oEmbed resource
 */
abstract class AbstractResource {

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var string
	 */
	protected $version;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $authorName;

	/**
	 * @var string
	 */
	protected $authorUrl;

	/**
	 * @var integer
	 */
	protected $cacheAge;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $thumbnailUrl;

	/**
	 * @var integer
	 */
	protected $thumbnailWidth;

	/**
	 * @var integer
	 */
	protected $thumbnailHeight;

	/**
	 * @var string
	 */
	protected $providerName;

	/**
	 * @var string
	 */
	protected $providerUrl;

	/**
	 * @var array
	 */
	protected $additionalProperties = array();

	/**
	 * @param array $additionalProperties
	 */
	public function setAdditionalProperties($additionalProperties) {
		$this->additionalProperties = $additionalProperties;
	}

	/**
	 * @return array
	 */
	public function getAdditionalProperties() {
		return $this->additionalProperties;
	}

	/**
	 * @param string $authorName
	 */
	public function setAuthorName($authorName) {
		$this->authorName = $authorName;
	}

	/**
	 * @return string
	 */
	public function getAuthorName() {
		return $this->authorName;
	}

	/**
	 * @param string $authorUrl
	 */
	public function setAuthorUrl($authorUrl) {
		$this->authorUrl = $authorUrl;
	}

	/**
	 * @return string
	 */
	public function getAuthorUrl() {
		return $this->authorUrl;
	}

	/**
	 * @param int $cacheAge
	 */
	public function setCacheAge($cacheAge) {
		$this->cacheAge = $cacheAge;
	}

	/**
	 * @return int
	 */
	public function getCacheAge() {
		return $this->cacheAge;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $providerName
	 */
	public function setProviderName($providerName) {
		$this->providerName = $providerName;
	}

	/**
	 * @return string
	 */
	public function getProviderName() {
		return $this->providerName;
	}

	/**
	 * @param string $providerUrl
	 */
	public function setProviderUrl($providerUrl) {
		$this->providerUrl = $providerUrl;
	}

	/**
	 * @return string
	 */
	public function getProviderUrl() {
		return $this->providerUrl;
	}

	/**
	 * @param int $thumbnailHeight
	 */
	public function setThumbnailHeight($thumbnailHeight) {
		$this->thumbnailHeight = $thumbnailHeight;
	}

	/**
	 * @return int
	 */
	public function getThumbnailHeight() {
		return $this->thumbnailHeight;
	}

	/**
	 * @param string $thumbnailUrl
	 */
	public function setThumbnailUrl($thumbnailUrl) {
		$this->thumbnailUrl = $thumbnailUrl;
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrl() {
		return $this->thumbnailUrl;
	}

	/**
	 * @param int $thumbnailWidth
	 */
	public function setThumbnailWidth($thumbnailWidth) {
		$this->thumbnailWidth = $thumbnailWidth;
	}

	/**
	 * @return int
	 */
	public function getThumbnailWidth() {
		return $this->thumbnailWidth;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $version
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}
}

?>