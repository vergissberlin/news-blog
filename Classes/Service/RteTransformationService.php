<?php
namespace NIMIUS\NewsBlog\Service;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * RTE transformation service class.
 */
class RteTransformationService {
	/**
	 * @var \TYPO3\CMS\Core\Html\RteHtmlParser
	 */
	public $pObj;

	/**
	 * @var string
	 */
	public $transformationKey = 'tx_newsblog_rte';


	/**
	 * Transforms RTE content prior to database storage.
	 *
	 * @param string $value RTE HTML to clean for database storage
	 * @return string
	 */
	public function transform_db($value) {
		// Convert consecutive space chars in <pre>-tags to non-breaking space entities (' ' to '&nbsp;')
		// to keep them in the visible output, as the RTE drops them otherwise.
		// This also has to keep in mind that spaces after already converted &nbsp;'s have to be converted,
		// as transform_rte does not convert &nbsp; to spaces because the RTE drops them.
		$value = preg_replace('/((?:^|\G)(?<=\s|&nbsp;)\h|&nbsp;)(?=(?:(?!<pre.*?>).)*<\/pre>)/ims', '&nbsp;', $value);
		
		// Replace newlines with <br>-tags in content between <pre>-tags to keep pre/code
		// formatting to actually keep newlines in the visible output.
		$value = preg_replace('/\n(?=(?:(?!<pre.*?>).)*<\/pre>)/ims', '<br />', $value);
		
		return $value;
	}

	/**
     * Transforms database content for RTE display.
     *
     * @param string $value Database content to transform into RTE-ready HTML
     * @return string
     */
	public function transform_rte($value) {
		// Replace <br>-tags with newlines in content between <pre>-tags.
		$value = preg_replace('/<br.*?>(?=(?:(?!<pre.*?>).)*<\/pre>)/ims', "\n", $value);
		return $value;
	}
}