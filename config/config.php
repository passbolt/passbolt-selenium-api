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
                    ]
                ],
            ]
        ]
    ]
];