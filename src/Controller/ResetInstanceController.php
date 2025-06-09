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
 * @since         2.0.0
 */
namespace PassboltSeleniumApi\Controller;

use App\Command\InstallCommand;
use App\Middleware\ContainerInjectorMiddleware;
use App\Service\Subscriptions\DefaultSubscriptionCheckInCommandService;
use App\Controller\AppController;
use App\Service\Command\ProcessUserService;
use App\Service\Healthcheck\HealthcheckServiceCollector;
use Cake\Console\ConsoleIo;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\Console\TestSuite\ConsoleIntegrationTestTrait;

class ResetInstanceController extends AppController
{
    use ConsoleIntegrationTestTrait;

    /**
     * @inheritDoc
     */
    public function beforeFilter(EventInterface $event)
    {
        if (Configure::read('debug') && Configure::read('passbolt.selenium.active')) {
            $this->Authentication->allowUnauthenticated(['resetInstance']);
        } else {
            throw new NotFoundException();
        }

        return parent::beforeFilter($event);
    }

    /**
     * Reset passbolt instance data. All data will be lost
     * This is same as calling the cake shell : cake install [--data=[default|...]]
     *
     * @param string $dataset data set name
     * @return void
     */
    public function resetInstance(string $dataset = 'default')
    {
        $container = $this->getRequest()->getAttribute(ContainerInjectorMiddleware::CONTAINER_ATTRIBUTE);
        $registerUserCommand = new InstallCommand(
            new ProcessUserService(),
            new DefaultSubscriptionCheckInCommandService(),
            $container->get(HealthcheckServiceCollector::class)
        );

        $options = [
            '--quick',
            '--quiet',
            '--no-admin',
            '--force',
            '--data', $dataset,
        ];
        $io = new ConsoleIo();
        $result = $registerUserCommand->run($options, $io);

        $this->viewBuilder()
            ->setLayout('ajax')
            ->setTemplatePath('Healthcheck')
            ->setTemplate('status');

        if ($result === 0) {
            $msg = __('Instance reset completed.');
            $this->success($msg, $msg);
        } else {
            $msg = __('Instance reset failed.');
            $this->error($msg, $msg);
        }
    }
}
