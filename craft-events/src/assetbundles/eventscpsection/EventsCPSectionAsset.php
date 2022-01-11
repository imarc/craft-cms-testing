<?php
/**
 * Craft Events plugin for Craft CMS 3.x
 *
 * A plugin for managing events in Craft
 *
 * @link      https://www.imarc.com
 * @copyright Copyright (c) 2020 Imarc
 */

namespace imarc\craft\events\assetbundles\eventscpsection;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Imarc
 * @package   CraftEvents
 * @since     1.0.0
 */
class EventsCPSectionAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@imarc/craft-events/assetbundles/eventscpsection/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Events.js',
        ];

        $this->css = [
            'css/Events.css',
        ];

        parent::init();
    }
}
