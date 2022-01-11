<?php
/**
 * Craft Events plugin for Craft CMS 3.x
 *
 * A plugin for managing events in Craft
 *
 * @link      https://www.imarc.com
 * @copyright Copyright (c) 2020 Imarc
 */

namespace imarc\craft\events;

use imarc\craft\events\services\Events as EventsService;
use imarc\craft\events\elements\Event as EventElement;
use imarc\craft\events\elements\Track as TrackElement;
use imarc\craft\events\elements\Session as SessionElement;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Elements;
use craft\events\RegisterComponentTypesEvent;

use yii\base\Event;

/**
 * Class CraftEvents
 *
 * @author    Imarc
 * @package   CraftEvents
 * @since     1.0.0
 *
 * @property  EventsService $events
 */
class CraftEvents extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var CraftEvents
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = true;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Elements::class,
            Elements::EVENT_REGISTER_ELEMENT_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = EventElement::class;
                $event->types[] = TrackElement::class;
                $event->types[] = SessionElement::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'craft-events',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
