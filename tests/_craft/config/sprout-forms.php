<?php
return [
    // Individual captcha settings
    //
    // Additional Captchas can be found in the Plugin Store:
    // https://plugins.craftcms.com/sprout-forms-google-recaptcha
    //
    // Custom Captchas can be added via the Captcha API
    'captchaSettings' => [
        'barrelstrength\sproutforms\captchas\DuplicateCaptcha' => [
            'enabled' => false,
        ],
        'barrelstrength\sproutforms\captchas\JavascriptCaptcha' => [
            'enabled' => false,
        ],
        'barrelstrength\sproutforms\captchas\HoneypotCaptcha' => [
            'enabled' => true,
            'honeypotFieldName' => 'contactFormAddress2',
            'honeypotScreenReaderMessage' => 'Leave this field blank'
        ],
    ],
];