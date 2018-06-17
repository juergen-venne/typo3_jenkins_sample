<?php

(function() {
    $configPathToEnvironmentVariable = [
        'DB/Connections/Default/dbname' => 'TYPO3_DB_DBNAME',
        'DB/Connections/Default/user' => 'TYPO3_DB_USER',
        'DB/Connections/Default/password' => 'TYPO3_DB_PASSWORD',
        'DB/Connections/Default/host' => 'TYPO3_DB_HOST',

        'GFX/processor' => 'TYPO3_GFX_PROCESSOR',
        'GFX/processor_effects' => 'TYPO3_GFX_PROCESSOR_EFFECTS',
        'GFX/processor_colorspace' => 'TYPO3_GFX_PROCESSOR_COLORSPACE',
    ];

    foreach($configPathToEnvironmentVariable as $configPath => $environmentVariable) {
        $environmentValue = getenv($environmentVariable);
        if($environmentValue !== false) {
            // set configuration at configPath to environment value
            $path = explode('/', $configPath);
            $pointer = &$GLOBALS['TYPO3_CONF_VARS'];
            foreach ($path as $segment) {
                if (!isset($pointer[$segment])) {
                    $pointer[$segment] = [];
                }
                $pointer = &$pointer[$segment];
            }
            $pointer = $environmentValue;
        }
    }

    $smtpHost = getenv('TYPO3_SMTP_HOST');
    $smtpPort = getenv('TYPO3_SMTP_PORT');
    if (is_string($smtpHost) && is_string($smtpPort)) {
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_smtp_server'] = sprintf('%s:%s', $smtpHost, $smtpPort);
    }

    // Read install tool password from environment
    if(getenv('TYPO3_INSTALL_TOOL_PASSWORD')) {
        $GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] =
            \TYPO3\CMS\Saltedpasswords\Salt\SaltFactory::getSaltingInstance('')
                ->getHashedPassword(getenv('TYPO3_INSTALL_TOOL_PASSWORD'));
    }
})();
