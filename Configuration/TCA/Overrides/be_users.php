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

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['news_blog']);
$l = 'LLL:EXT:news_blog/Resources/Private/Language/locallang.xlf:model.backend_user.';
$columns = array(
	'profile_pid' => array(
		'label' => $l . 'property.profile_pid',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'foreign_table' => 'pages',
			'allowed' => 'pages',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest'
				),
			),
		),	
	),
	'abstract' => array(
		'label' => $l . 'property.abstract',
		'config' => array(
			'type' => 'text',
			'cols' => 60,
			'rows' => 5,
		),
	),
	'abstract_content' => array(
		'label' => $l . 'property.abstract',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'foreign_table' => 'tt_content',
			'allowed' => 'tt_content',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'wizards' => array(
				'suggest' => array(
					'type' => 'suggest'
				),
			),
		)
	)
);

// Add new TCA fields to be_users.
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('be_users', $columns);
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'profile_pid', '', '');
if ((bool)$config['abstractRecords']) {
	TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'abstract_content', '', '');
} else {
	TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('be_users', 'abstract', '', '');
}