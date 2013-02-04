# oEmbed Package for TYPO3 Flow and Neos

makes using oEmbed resources in Flow and Neos easy.
For more information about oEmbed visit: http://oembed.com/

The package offers 
* a service to discover oEmbed data from within PHP code
* a Fluid ViewHelper to directly render oEmbed resources in templates
* a TYPO3 Neos node type to include oEmbed as content element.

**Currently everything is uncached! That means any call to the service (which means also the viewhelper and content element) will result in oEmbed discovery and data retrieval (so requests to the resources service server).**
