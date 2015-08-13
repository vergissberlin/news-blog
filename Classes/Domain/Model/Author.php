<?php
namespace NIMIUS\NewsBlog\Domain\Model;

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
 * Author model.
 *
 * Extends backend users.
 */
class Author extends \TYPO3\CMS\Extbase\Domain\Model\BackendUser {
	/**
	 * @var integer
	 */
	protected $profilePid;

	/**
	 * @var string
	 */
	protected $abstract;


	/**
	 * @return integer
	 */
	public function getProfilePid() {
		return $this->profilePid;
	}

	/**
	 * @return string
	 */
	public function getAbstract() {
		return $this->abstract;
	}
}