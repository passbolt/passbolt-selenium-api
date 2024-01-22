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
use Cake\Core\Configure;

if (Configure::read('debug') && Configure::read('passbolt.selenium.active')) {
    $overrideOptions = Configure::read('passbolt.plugins.selenium_api.security.endpoints');

    Configure::load('PassboltSeleniumApi.config', 'default', true);

    if (!empty($overrideOptions) && is_array($overrideOptions)) {
        $default = Configure::read('passbolt.plugins.selenium_api.security.endpoints');
        $finalEndpointsConfig = array_merge($default, $overrideOptions);

        Configure::write('passbolt.plugins.selenium_api.security.endpoints', $finalEndpointsConfig);
    }
}
