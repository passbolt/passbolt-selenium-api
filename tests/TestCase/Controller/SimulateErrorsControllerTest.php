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
namespace PassboltSeleniumApi\Test\TestCase\Controller;

use App\Test\Lib\AppIntegrationTestCase;
use Cake\Core\Configure;
use PassboltSeleniumApi\Controller\ConfigController;

class SimulateErrorsControllerTest extends AppIntegrationTestCase
{
    /** @var bool error endpoint flag */
    private $default;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->default = Configure::read('passbolt.plugins.selenium_api.security.endpoints.error');
        Configure::write('passbolt.plugins.selenium_api.security.endpoints.error', true);
    }

    /**
     * Clears the state used for tests.
     *
     * @return void
     */
    public function tearDown(): void
    {
        Configure::write('passbolt.plugins.selenium_api.security.endpoints.error', $this->default);
        parent::tearDown();
    }

    public function testSimulateError404()
    {
        $this->getJson('/seleniumtests/error404.json');
        $this->assertError(404);
    }

    public function testSimulateError403()
    {
        $this->getJson('/seleniumtests/error403.json');
        $this->assertError(403);
    }

    public function testSimulateError400()
    {
        $this->getJson('/seleniumtests/error400.json');
        $this->assertError(400);
    }

    public function testSimulateError500()
    {
        $this->getJson('/seleniumtests/error500.json');
        $this->assertError(500);
    }

    public function testSimulateErrorNotFound()
    {
        // Check selenium api endpoints are marked as not found when
        // selenium is marked as inactive in the config
        Configure::write('passbolt.selenium.active', false);
        $this->getJson('/seleniumtests/error404.json');
        $this->assertError(404);
    }
}
