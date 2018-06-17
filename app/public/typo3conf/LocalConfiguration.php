<?php
return [
    'BE' => [
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$pbkdf2-sha256$25000$1BaAybRoWsIML637sp8PPw$6rMivbfPDC318SGv7K6gRv5c53VEcL6dcP9K.Ft8Ezs',
        'loginSecurityLevel' => 'normal',
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8',
                'driver' => 'mysqli',
            ],
        ],
    ],
    'EXT' => [
        'extConf' => [
            'backend' => 'a:6:{s:9:"loginLogo";s:0:"";s:19:"loginHighlightColor";s:0:"";s:20:"loginBackgroundImage";s:0:"";s:13:"loginFootnote";s:0:"";s:11:"backendLogo";s:0:"";s:14:"backendFavicon";s:0:"";}',
            'extensionmanager' => 'a:2:{s:21:"automaticInstallation";s:1:"1";s:11:"offlineMode";s:1:"0";}',
            'saltedpasswords' => 'a:6:{s:20:"checkConfigurationFE";s:1:"0";s:20:"checkConfigurationBE";s:1:"0";s:3:"FE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt";s:11:"forceSalted";s:1:"0";s:15:"onlyAuthService";s:1:"0";s:12:"updatePasswd";s:1:"1";}s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt";s:11:"forceSalted";s:1:"0";s:15:"onlyAuthService";s:1:"0";s:12:"updatePasswd";s:1:"1";}s:21:"checkConfigurationFE2";s:1:"0";s:21:"checkConfigurationBE2";s:1:"0";}',
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => '',
            'loginBackgroundImage' => '',
            'loginFootnote' => '',
            'loginHighlightColor' => '',
            'loginLogo' => '',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'saltedpasswords' => [
            'BE' => [
                'forceSalted' => '0',
                'onlyAuthService' => '0',
                'saltedPWHashingMethod' => 'TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt',
                'updatePasswd' => '1',
            ],
            'FE' => [
                'forceSalted' => '0',
                'onlyAuthService' => '0',
                'saltedPWHashingMethod' => 'TYPO3\\CMS\\Saltedpasswords\\Salt\\Pbkdf2Salt',
                'updatePasswd' => '1',
            ],
            'checkConfigurationBE' => '0',
            'checkConfigurationBE2' => '0',
            'checkConfigurationFE' => '0',
            'checkConfigurationFE2' => '0',
        ],
    ],
    'FE' => [
        'loginSecurityLevel' => 'normal',
    ],
    'SYS' => [
        'encryptionKey' => '433d6216a232c3f2c4218c1f035e02a565f381a5cdc4f00bfdeb558e7285d64b903ce72e9af00f255e522fe66adb95d3',
        'features' => [
            'unifiedPageTranslationHandling' => true,
        ],
        'sitename' => 'New TYPO3 site',
        'systemMaintainers' => [
            1,
        ],
    ],
];
