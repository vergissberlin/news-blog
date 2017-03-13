<?php
namespace NIMIUS\NewsBlog\Domain\Model;

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

/**
 * Author model.
 *
 * Extends backend users.
 */
class Author extends \TYPO3\CMS\Extbase\Domain\Model\BackendUser
{
    /**
     * @var int
     */
    protected $profilePid;

    /**
     * @var string Raw abstract text
     */
    protected $abstract;

    /**
     * @var \NIMIUS\NewsBlog\Domain\Model\TtContent Relation to abstract text
     * @lazy
     */
    protected $abstractContent;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference Avatar image from core
     */
    protected $avatar;

    /**
     * @return int
     */
    public function getProfilePid()
    {
        return $this->profilePid;
    }

    /**
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @return int
     */
    public function getAbstractContent()
    {
        return $this->abstractContent;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
