<?php
namespace NIMIUS\NewsBlog\Test\Unit\Service;

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
 * Test class for RteTransformationService
 */
class RteTransformationServiceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var NIMIUS\NewsBlog\Service\RteTransformationService
     */
    protected $subject;

    /**
     * @var TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Test that transformation to the database only affects content between <pre>-tags.
     *
     * @test
     */
    public function transformDbOnlyAffectsContentWrappedInPreTags()
    {
        $input = 'line 1 {
  line 2 {
    line 3
  }
}';
        $output = $this->subject->transform_db($input);
        $this->assertEquals($input, $output);
    }

    /**
     * Test that transformation to the database properly converts spaces to non-breaking spaces.
     *
     * @test
     */
    public function transformDbConvertsSpacesToNonBreakingSpaces()
    {
        $input = $this->wrapInPre('line 1 {
  line 2 {
    line 3
  }
}');
        $expectedOutput = $this->wrapInPre('line 1 {<br />&nbsp;&nbsp;line 2 {<br />&nbsp;&nbsp;&nbsp;&nbsp;line 3<br />&nbsp;&nbsp;}<br />}');
        $output = $this->subject->transform_db($input);
        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * Test that transformation to the database also properly converts spaces after already converted
     * non-breaking spaces.
     *
     * @test
     */
    public function transformDbConvertsSpacesAfterNonBreakingSpaces()
    {
        $input = $this->wrapInPre('line 1 {
&nbsp;&nbsp;line 2 {
&nbsp;&nbsp;  line 3
&nbsp;&nbsp;}
}');
        $expectedOutput = $this->wrapInPre('line 1 {<br />&nbsp;&nbsp;line 2 {<br />&nbsp;&nbsp;&nbsp;&nbsp;line 3<br />&nbsp;&nbsp;}<br />}');
        $output = $this->subject->transform_db($input);
        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * Test that transformation to the database keeps empty lines.
     *
     * @test
     */
    public function transformDbKeepsEmptyLines()
    {
        $input = $this->wrapInPre('line 1 {
  line 2

  line 3
}');
        $expectedOutput = $this->wrapInPre('line 1 {<br />&nbsp;&nbsp;line 2<br /><br />&nbsp;&nbsp;line 3<br />}');
        $output = $this->subject->transform_db($input);
        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * Test that transformation to the database keeps lines with only white spaces.
     *
     * @test
     */
    public function transformDbKeepsWhiteSpaceOnlyLines()
    {
        $input = $this->wrapInPre('line 1 {
  line 2
  
  line 3
}');
        $expectedOutput = $this->wrapInPre('line 1 {<br />&nbsp;&nbsp;line 2<br />&nbsp;&nbsp;<br />&nbsp;&nbsp;line 3<br />}');
        $output = $this->subject->transform_db($input);
        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * Test that transformation to the RTE only affects content between <pre>-tags.
     *
     * @test
     */
    public function transformRteOnlyAffectsContentWrappedInPreTags()
    {
        $input = 'line 1 {<br />line 2 {<br />line 3}<br />}';
        $output = $this->subject->transform_rte($input);
        $this->assertEquals($input, $output);
    }

    /**
     * Test that transformation to the RTE properly converts br-tags to newlines.
     *
     * @test
     */
    public function transformRteConvertsBrToNewlines()
    {
        $input = $this->wrapInPre('line 1 {<br />&nbsp;&nbsp;line 2 {<br />&nbsp;&nbsp;&nbsp;&nbsp;line 3<br />&nbsp;&nbsp;}<br />}');
        $expectedOutput = $this->wrapInPre('line 1 {
&nbsp;&nbsp;line 2 {
&nbsp;&nbsp;&nbsp;&nbsp;line 3
&nbsp;&nbsp;}
}');
        $output = $this->subject->transform_rte($input);
        $this->assertEquals($output, $expectedOutput);
    }

    /**
     * Initializer for each test case.
     */
    protected function setUp()
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
        $this->subject = new \NIMIUS\NewsBlog\Service\RteTransformationService;
    }

    /**
     * Helper to wrap test values.
     *
     * @return string
     */
    protected function wrapInPre($value)
    {
        return '<pre>' . $value . '</pre>';
    }
}
