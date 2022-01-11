<?php
/**
 * Craft Events plugin for Craft CMS 3.x
 *
 * A plugin for managing events in Craft
 *
 * @link      https://www.imarc.com
 * @copyright Copyright (c) 2020 Imarc
 */

namespace imarc\craft\events\records;

use imarc\craft\events\CraftEvents;

use Craft;
use craft\db\ActiveRecord;

/**
 * @author    Imarc
 * @package   CraftEvents
 * @since     1.0.0
 */
class Event extends ActiveRecord
{
    // Public Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%craftevents_event}}';
    }
}
