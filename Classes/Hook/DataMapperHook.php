<?php
namespace NIMIUS\NewsBlog\Hook;

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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * DataMapper hook class.
 */
class DataMapperHook {
	/**
	 * Hook to preprocess data fields.
	 *
	 * Sets the current backend user as author if none is set on save.
	 *
	 * @param array &$fieldArray Record data
	 * @param string $table Table the fieldArray data belongs to
	 * @param integer $id Uid of the record
	 * @param object &$pObj
	 * @return void
	 */
	public function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, &$pObj) {
		if ($table !== 'tx_news_domain_model_news') {
			return;
		}

		if (empty($fieldArray['author_id'])) {
			$fieldArray['author_id'] = (int)$pObj->BE_USER->user['uid'];
		}
	}
}