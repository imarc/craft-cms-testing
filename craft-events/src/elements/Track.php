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
use craft\elements\db\ElementQuery;
use craft\elements\db\ElementQueryInterface;

/**
 * @author    Imarc
 * @package   CraftEvents
 * @since     1.0.0
 */
class Track extends Element
{
    // Public Properties
    // =========================================================================

    public $id;
    public $uid;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('craft-events', 'Track');
    }

    /**
     * @inheritdoc
     */
    public static function hasContent(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function hasTitles(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function isLocalized(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function find(): ElementQueryInterface
    {
        return new ElementQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    protected static function defineSources(string $context = null): array
    {
        $sources = [];

        return $sources;
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['someAttribute', 'string'],
            ['someAttribute', 'default', 'value' => 'Some Default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getIsEditable(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getFieldLayout()
    {
        $tagGroup = $this->getGroup();

        if ($tagGroup) {
            return $tagGroup->getFieldLayout();
        }

        return null;
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function beforeSave(bool $isNew): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterSave(bool $isNew)
    {
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
    }

    /**
     * @inheritdoc
     */
    public function beforeMoveInStructure(int $structureId): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterMoveInStructure(int $structureId)
    {
    }
}
