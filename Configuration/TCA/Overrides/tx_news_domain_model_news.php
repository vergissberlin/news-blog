<?php
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

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$l = 'LLL:EXT:news_blog/Resources/Private/Language/locallang.xlf:model.news.';
$columns = array(
	'author_id' => array(
		'label' => $l . 'property.author_id',
		'l10n_mode' => 'mergeIfNotBlank',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'foreign_table' => 'be_users',
			'allowed' => 'be_users',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest'
				),
			),
		),	
	)
);

// Add new TCA fields to tx_news_domain_model_news.
ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $columns);
ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'author_id', '', 'before:author');
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['bodytext']['defaultExtras'] .= 'richtext:rte_transform[mode=tx_newsblog_rte-ts_css]';