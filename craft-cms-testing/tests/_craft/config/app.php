<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app/main.php and [web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 */
return [
    'components' => [
        'session' => [
            'class' => yii\web\DbSession::class,
            'as session' => craft\behaviors\SessionBehavior::class,
            'sessionTable' => '{{%phpsessions}}'
        ],
    ],
    'modules' => [
        'anvil-module' => [
            'class' => \modules\anvil\AnvilModule::class,
            'components' => [
                'base' => [
                    'class' => 'modules\anvil\services\Base',
                ],
                'baseModel' => [
                    'class' => 'modules\anvil\services\BaseModel',
                ],
                'export' => [
                    'class' => 'modules\anvil\services\Export',
                ],
                'import' => [
                    'class' => 'modules\anvil\services\Import',
                ],
                'users' => [
                    'class' => 'modules\anvil\services\Users',
                ],
                'project' => [
                    'class' => 'modules\anvil\services\Project',
                ],
            ],
        ],
        'category-api-module' => [
            'class' => \modules\categoryapi\CategoryApiModule::class,
        ],
        'seismic-submittal' => [
            'class' => \modules\seismicsubmittal\SeismicSubmittalModule::class,
            'components' => [
                'attachment' => [
                    'class' => 'modules\seismicsubmittal\services\Attachment',
                ],
                'base' => [
                    'class' => 'modules\seismicsubmittal\services\Base',
                ],
                'brace' => [
                    'class' => 'modules\seismicsubmittal\services\Brace',
                ],
                'branch' => [
                    'class' => 'modules\seismicsubmittal\services\Branch',
                ],
                'contact' => [
                    'class' => 'modules\seismicsubmittal\services\Contact',
                ],
                'design' => [
                    'class' => 'modules\seismicsubmittal\services\Design',
                ],
                'fileUpload' => [
                    'class' => 'modules\seismicsubmittal\services\FileUpload',
                ],
                'pipe' => [
                    'class' => 'modules\seismicsubmittal\services\Pipe',
                ],
                'report' => [
                    'class' => 'modules\seismicsubmittal\services\Report',
                ],
                'segment' => [
                    'class' => 'modules\seismicsubmittal\services\Segment',
                ],
                'standard' => [
                    'class' => 'modules\seismicsubmittal\services\Standard',
                ],
            ],
        ],
        'price-worksheets' => [
            'class' => \modules\priceworksheets\PriceWorksheets::class,
            'components' => [
                'worksheets' => [
                    'class' => 'modules\priceworksheets\services\Worksheets',
                ],
            ],
        ],
        'schedule' => [
            'class' => \modules\schedule\Schedule::class,
            'components' => [
                'cron' => [
                    'class' => 'modules\schedule\services\Cron',
                ],
                'notification' => [
                    'class' => 'modules\schedule\services\Notification',
                ],
            ],
        ],
    ],
    'bootstrap' => ['anvil-module', 'category-api-module', 'schedule', 'seismic-submittal', 'price-worksheets'],
];