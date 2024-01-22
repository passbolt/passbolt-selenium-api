<?php
return [
    'passbolt' => [
        'plugins' => [
            'selenium_api' => [
                'version' => '2.2.0',
                'security' => [
                    'csrfProtection' => [
                        'unlockedActions' => [
                            'Config' => ['setExtraConfig']
                        ]
                    ],
                    'endpoints' => [
                        'reset' => filter_var(env('PASSBOLT_PLUGIN_SELENIUM_API_SECURITY_ENDPOINTS_RESET', false), FILTER_VALIDATE_BOOLEAN),
                        'error' => filter_var(env('PASSBOLT_PLUGIN_SELENIUM_API_SECURITY_ENDPOINTS_ERROR', true), FILTER_VALIDATE_BOOLEAN),
                        'email' => filter_var(env('PASSBOLT_PLUGIN_SELENIUM_API_SECURITY_ENDPOINTS_EMAIL', true), FILTER_VALIDATE_BOOLEAN),
                    ]
                ],
            ]
        ]
    ]
];