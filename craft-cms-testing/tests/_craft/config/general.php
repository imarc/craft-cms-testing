<?php

return [
    // Default Week Start Day (0 = Sunday, 1 = Monday...)
    'defaultWeekStartDay' => 1,

    // Whether generated URLs should omit "index.php"
    'omitScriptNameInUrls' => true,

    // Control Panel trigger word
    'cpTrigger' => 'admin',

    // The secure key Craft will use for hashing and encrypting data
    'securityKey' => getenv('SECURITY_KEY'),

    // Whether to save the project config out to config/project.yaml
    // (see https://docs.craftcms.com/v3/project-config.html)
    'useProjectConfigFile' => true,

    // copied from Craft 2 site

    'omitScriptNameInUrls' => true,
    'maxUploadFileSize' => 2097152000, // 2Gb
    'allowUpdates' => false,
    'devMode' => filter_var(getenv('CRAFT_DEVMODE'), FILTER_VALIDATE_BOOLEAN),
    'useCompressedJs' => false,
    'siteDomain' => getenv('CRAFT_SITEURL'),
    'siteTitle' => getenv('CRAFT_SITENAME'),
    'useEmailAsUsername' => true,
    'setPasswordPath' => 'account/set-password',
    'setPasswordSuccessPath' => 'account?passwordSet=1',
    'loginPath' => 'account/login',
    'postLoginRedirect' => 'account',
    'logoutPath' => 'account/logout',
    'activateAccountSuccessPath' => 'account?activated=1',
    'autoLoginAfterAccountActivation' => true,
    'extraAllowedFileExtensions' => 'dwg,eps,rfa,igs,dxf,step,easm,stp',
    'defaultSearchTermOptions' => [
        'subLeft' => true,
        'subRight' => true,
    ],
    'defaultTokenDuration' => 864000,
    'generateTransformsBeforePageLoad' => true,
    'userSessionDuration' => 'P3D',
    'phpMaxMemoryLimit' => '2.1G',
    'ALGOLIA_APP_ID' => getenv('ALGOLIA_APP_ID'),
    'ALGOLIA_API_KEY' => getenv('ALGOLIA_API_KEY'),
    'S3_BASE_URL' => getenv('S3_BASE_URL'),
    'S3_ACCESS_ID' => getenv('S3_ACCESS_ID'),
    'S3_SECRET_KEY' => getenv('S3_SECRET_KEY'),
    'RECAPTCHA_SITE_KEY' => getenv('RECAPTCHA_SITE_KEY'),
    'RECAPTCHA_SECRET_KEY' => getenv('RECAPTCHA_SECRET_KEY'),

    // environment specific in site general.php
    'cache' => false,
    'syncAlgolia' => false,
    'indexPrefix' => 'stage-',
    'testToEmailAddress' => 'test@imarc.com',
];