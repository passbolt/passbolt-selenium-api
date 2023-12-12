<?php
/**
 * Passbolt ~ Open source password manager for teams
 * Copyright (c) Passbolt SA (https://www.passbolt.com)
 *
 * Licensed under GNU Affero General Public License version 3 of the or any later version.
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Passbolt SA (https://www.passbolt.com)
 * @license       https://opensource.org/licenses/AGPL-3.0 AGPL License
 * @link          https://www.passbolt.com Passbolt(tm)
 * @since         2.0.0
 */

/** @var \Cake\Routing\RouteBuilder $routes */
use Cake\Core\Configure;

/**
 * Selenium tests routes
 */
$routes->plugin('PassboltSeleniumApi', ['path' => '/seleniumtests'], function ($routes) {
    $routes->setExtensions(['json']);

    if (Configure::read('passbolt.plugins.selenium_api.security.endpoints.reset')) {
        $routes->connect('/resetInstance/{dataset}', ['controller' => 'ResetInstance', 'action' => 'resetInstance'])
            ->setPass(['dataset'])
            ->setMethods(['GET']);
    }

    if (Configure::read('passbolt.plugins.selenium_api.security.endpoints.error')) {
        $routes->connect('/error400', ['controller' => 'SimulateError', 'action' => 'error400'])
            ->setMethods(['GET']);

        $routes->connect('/error404', ['controller' => 'SimulateError', 'action' => 'error404'])
            ->setMethods(['GET']);

        $routes->connect('/error403', ['controller' => 'SimulateError', 'action' => 'error403'])
            ->setMethods(['GET']);

        $routes->connect('/error500', ['controller' => 'SimulateError', 'action' => 'error500'])
            ->setMethods(['GET']);
    }

    if (Configure::read('passbolt.plugins.selenium_api.security.endpoints.email')) {
        $routes->connect('/showlastemail/{username}', ['controller' => 'Email', 'action' => 'showLastEmail'])
            ->setPass(['username'])
            ->setMethods(['GET']);

        // Legacy v1 backward compatibility routes
        $routes->connect('/showLastEmail/{username}', ['controller' => 'Email', 'action' => 'showLastEmail'])
            ->setPass(['username'])
            ->setMethods(['GET']);
    }

});
