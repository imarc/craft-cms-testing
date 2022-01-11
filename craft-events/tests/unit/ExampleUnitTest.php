<?php
/**
 * Craft Events plugin for Craft CMS 3.x
 *
 * A plugin for managing events in Craft
 *
 * @link      https://www.imarc.com
 * @copyright Copyright (c) 2020 Imarc
 */

namespace imarc\craft\events\tests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use imarc\craft\events\CraftEvents;

/**
 * ExampleUnitTest
 *
 *
 * @author    Imarc
 * @package   CraftEvents
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            CraftEvents::class,
            CraftEvents::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
