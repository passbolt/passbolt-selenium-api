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
namespace PassboltSeleniumApi\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception\NotFoundException;

class SimulateErrorController extends AppController
{
    /**
     * @inheritDoc
     */
    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated([
            'error404',
            'error403',
            'error400',
            'error500',
        ]);

        return parent::beforeFilter($event);
    }

    /**
     * Simulate error 404
     *
     * @throws NotFoundException
     * @return void
     */
    public function error404()
    {
        throw new NotFoundException();
    }

    /**
     * Simulate error 403
     *
     * @throws ForbiddenException
     * @return void
     */
    public function error403()
    {
        throw new ForbiddenException();
    }

    /**
     * Simulate error 400
     *
     * @throws BadRequestException
     * @return void
     */
    public function error400()
    {
        throw new BadRequestException();
    }

    /**
     * Simulate error 500
     *
     * @throws InternalErrorException
     * @return void
     */
    public function error500()
    {
        throw new InternalErrorException();
    }
}
