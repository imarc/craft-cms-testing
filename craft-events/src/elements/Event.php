<?php
/**
 * Craft Events plugin for Craft CMS 3.x
 *
 * A plugin for managing events in Craft
 *
 * @link      https://www.imarc.com
 * @copyright Copyright (c) 2020 Imarc
 */

namespace imarc\craft\events\elements;

use imarc\craft\events\CraftEvents;

use Craft;
use craft\base\Element;
use craft\elements\actions\Delete;
use craft\elements\db\ElementQuery;
use craft\elements\db\ElementQueryInterface;
use craft\helpers\ArrayHelper;
use craft\helpers\DateTimeHelper;
use craft\helpers\Json;
use craft\helpers\UrlHelper;
use craft\validators\DateTimeValidator;

/**
 * @author    Imarc
 * @package   CraftEvents
 * @since     1.0.0
 */
class Event extends Element
{
    // Public Properties
    // =========================================================================

    public $id;
    public $typeId;
    public $startDate;
    public $endDate;
    public $postDate;
    public $expiryDate;

    // Static Methods
    // =========================================================================

    public static function displayName(): string
    {
        return Craft::t('craft-events', 'Event');
    }

    public static function hasContent(): bool
    {
        return true;
    }

    public static function hasTitles(): bool
    {
        return true;
    }

    public static function isLocalized(): bool
    {
        return true;
    }

    public static function hasStatuses(): bool
    {
        return true;
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_LIVE => Craft::t('app', 'Live'),
            self::STATUS_PENDING => Craft::t('app', 'Pending'),
            self::STATUS_EXPIRED => Craft::t('app', 'Expired'),
            self::STATUS_DISABLED => Craft::t('app', 'Disabled')
        ];
    }

    public static function find(): ElementQueryInterface
    {
        return new ElementQuery(get_called_class());
    }

    protected static function defineSources(string $context = null): array
    {
        $sources = [];

        return $sources;
    }

    // Public Methods
    // =========================================================================

    public function __toString(): string
    {
        return (string)$this->title;
    }

    public function datetimeAttributes(): array
    {
        $attributes = parent::datetimeAttributes();
        $attributes[] = 'startDate';
        $attributes[] = 'endDate';
        $attributes[] = 'postDate';
        $attributes[] = 'expiryDate';

        return $attributes;
    }

    public function rules(): array
    {
        $rules = parent::rules();

        $rules[] = [['startDate', 'endDate', 'postDate', 'expiryDate'], DateTimeValidator::class];

        return $rules;
    }

    public function getIsEditable(): bool
    {
        return true;
    }

    public function getFieldLayout()
    {
        $tagGroup = $this->getGroup();

        if ($tagGroup) {
            return $tagGroup->getFieldLayout();
        }

        return null;
    }

    public function getGroup()
    {
        if ($this->groupId === null) {
            throw new InvalidConfigException('Tag is missing its group ID');
        }

        if (($group = Craft::$app->getTags()->getTagGroupById($this->groupId)) === null) {
            throw new InvalidConfigException('Invalid tag group ID: '.$this->groupId);
        }

        return $group;
    }

    // Indexes, etc.
    // -------------------------------------------------------------------------

    public function getEditorHtml(): string
    {
        $html = Craft::$app->getView()->renderTemplateMacro('_includes/forms', 'textField', [
            [
                'label' => Craft::t('app', 'Title'),
                'siteId' => $this->siteId,
                'id' => 'title',
                'name' => 'title',
                'value' => $this->title,
                'errors' => $this->getErrors('title'),
                'first' => true,
                'autofocus' => true,
                'required' => true
            ]
        ]);

        $html .= parent::getEditorHtml();

        return $html;
    }

    // Events
    // -------------------------------------------------------------------------

    public function beforeSave(bool $isNew): bool
    {
        return true;
    }

    public function afterSave(bool $isNew)
    {
    }

    public function beforeDelete(): bool
    {
        return true;
    }

    public function afterDelete()
    {
    }

    public function beforeMoveInStructure(int $structureId): bool
    {
        return true;
    }

    public function afterMoveInStructure(int $structureId)
    {
    }
}