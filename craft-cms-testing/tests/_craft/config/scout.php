<?php
/*
 * Config scout.php
 *
 * This file exists only as a template for the Scout settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'craft/config' as 'scout.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'craft/config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

set_time_limit(300);

use craft\elements\Category;
use craft\elements\Entry;
use craft\elements\db\CategoryQuery;
use craft\elements\db\EntryQuery;
use rias\scout\ScoutIndex;

use modules\anvil\helpers\Formatters;

// Use an index prefix on dev connect to the test indicies.
$indexPrefix = Craft::$app->config->general->indexPrefix; 

// Live site syncs to live index, dev syncs to test indicies
// Stage/Staging/UAT SHOULD NOT BE SYNCED!
$syncAlgolia = Craft::$app->config->general->syncAlgolia; 

return [
    /*
     * Scout listens to numerous Element events to keep them updated in
     * their respective indices. You can disable these and update
     * your indices manually using the commands.
     */
    'sync' => $syncAlgolia,

    /*
     * By default Scout handles all indexing in a queued job, you can disable
     * this so the indices are updated as soon as the elements are updated
     */
    'queue' => $syncAlgolia,

    /*
     * The connection timeout (in seconds), increase this only if necessary
     */
    'connect_timeout' => 1,

    /*
     * The batch size Scout uses when importing a large amount of elements
     */
    'batch_size' => 1000,

    /*
     * The Algolia Application ID, this id can be found in your Algolia Account
     * https://www.algolia.com/api-keys. This id is used to update records.
     */
    'application_id' => getenv('ALGOLIA_APP_ID'),

    /*
     * The Algolia Admin API key, this key can be found in your Algolia Account
     * https://www.algolia.com/api-keys. This key is used to update records.
     */
    'admin_api_key' => getenv('ALGOLIA_ADMIN_KEY'),

    /*
     * The Algolia search API key, this key can be found in your Algolia Account
     * https://www.algolia.com/api-keys. This search key is not used in Scout
     * but can be used through the Scout variable in your template files.
     */
    'search_api_key' => getenv('ALGOLIA_API_KEY'), //optional

    /*
     * A collection of indices that Scout should sync to, these can be configured
     * by using the \rias\scout\ScoutIndex::create('IndexName') command. Each
     * index should define an ElementType, criteria and a transformer.
     */
    'indices' => [
    	ScoutIndex::create($indexPrefix . 'resources')
    		->elementType(Entry::class)
    		->criteria(function(EntryQuery $query) {
    			return $query->section('resources');
    		})
    		->transformer(function(Entry $entry) {
    			return Formatters::resourceMapping($entry);
    		}),
    	ScoutIndex::create($indexPrefix . 'products')
    		->elementType(Entry::class)
    		->criteria(function(EntryQuery $query) {
    			return $query->section('products');
    		})
    		->transformer(function(Entry $entry) {
    			return Formatters::productMapping($entry);
    		}),
    	ScoutIndex::create($indexPrefix . 'pages')
    		->elementType(Entry::class)
    		->criteria(function(EntryQuery $query) {
    			return $query->section(['events', 'solutions', 'news', 'pages', 'services']);
    		})
    		->transformer(function(Entry $entry) {    			
    			return Formatters::pageMapping($entry);
    		}),
        ScoutIndex::create($indexPrefix . 'brands')
            ->elementType(Category::class)
            ->criteria(function(CategoryQuery $query) {
                return $query->group('brands');
            })
            ->transformer(function(Category $category) {              
                return Formatters::brandMapping($category);
            })
    ],
];