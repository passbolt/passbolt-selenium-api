<?php
declare(strict_types=1);

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
 * @since         5.0.0
 */
namespace PassboltSeleniumApi\Test\TestCase\Controller;

use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use PassboltSeleniumApi\Test\Utility\JsonRequestTrait;

/**
 * @covers \PassboltSeleniumApi\Controller\EmailController
 */
class EmailControllerTest extends TestCase
{
    use IntegrationTestTrait;
    use JsonRequestTrait;

    private const CONFIG_KEY = 'passbolt.plugins.selenium_api.security.endpoints.email';

    /**
     * @var mixed
     */
    private $default = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->default = Configure::read(self::CONFIG_KEY);
        Configure::write(self::CONFIG_KEY, true);
    }

    /**
     * Clears the state used for tests.
     *
     * @return void
     */
    public function tearDown(): void
    {
        Configure::write(self::CONFIG_KEY, $this->default);
        unset($this->default);
        parent::tearDown();
    }

    public function testEmailController_Error_ConfigKeyIsSetToFalse()
    {
        Configure::write(self::CONFIG_KEY, false);
        $this->get('/seleniumtests/showlastemail/ada@passbolt.com.json');
        $this->assertResponseCode(404);
    }

    public function testEmailController_Error_InvalidUsername()
    {
        $this->get('/seleniumtests/showlastemail/imrobot.json');
        $this->assertResponseCode(500);
    }

    public function testEmailController_Error_UsernameNotFound()
    {
        $this->markTestSkipped('TODO: Set fixture factory');

        $this->get('/seleniumtests/showlastemail/ada@passbolt.com.json');
        $this->assertResponseCode(500);
    }

    public function testEmailController_Success()
    {
        $this->markTestSkipped('TODO: Set fixture factory');

        $this->get('/seleniumtests/showlastemail/ada@passbolt.com.json');
        $this->assertResponseCode(200);
    }
}
