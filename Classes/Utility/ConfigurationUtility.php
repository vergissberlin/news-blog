<?php
namespace NIMIUS\NewsBlog\Utility;

/*
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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Utility class to get configurations.
 */
class ConfigurationUtility
{
    /**
     * @var string
     */
    public static $extKey = 'newsblog';

    /**
     * Get configuration from TYPO3 configuration variables.
     *
     * @return array
     */
    public static function getExtensionConfiguration()
    {
        $config = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::$extKey]);
        if (!is_array($config)) {
            $config = [];
        }
        return $config;
    }

    /**
     * Get framework typoscript configuration.
     *
     * @return array
     */
    public static function getFrameworkTyposcriptConfiguration()
    {
        $configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        return $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
    }

    /**
     * Get typoscript settings for this plugin.
     *
     * The CONFIGURATION_TYPE_FULL_TYPOSCRIPT type is used and the returned
     * result broken down as CONFIGURATION_TYPE_SETTINGS does not work
     * correctly for command controllers.
     *
     * @return array
     */
    public static function getPluginTyposcriptConfiguration($extKey = null)
    {
        if (!$extKey) {
            $extKey = self::$extKey;
        }
        $signature = 'tx_' . $extKey . '.';
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $configurationManager = $objectManager->get(ConfigurationManager::class);
        $configuration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        if (is_array($configuration['plugin.'][$signature]['settings.'])) {
            return $configuration['plugin.'][$signature]['settings.'];
        } else {
            return [];
        }
    }
}
