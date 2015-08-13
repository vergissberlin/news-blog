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
);

// Add new TCA fields to be_users.
ExtensionManagementUtility::addTCAcolumns('be_users', $columns);
ExtensionManagementUtility::addToAllTCAtypes('be_users', 'profile_pid, abstract', '', '');