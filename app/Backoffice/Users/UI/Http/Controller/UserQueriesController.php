<?php

declare(strict_types=1);

namespace App\Backoffice\Users\UI\Http\Controller;

use Psr\Http\Message\ResponseInterface;
use App\Backoffice\Users\Application\Query\UserFilter;
use Psr\Http\Message\ServerRequestInterface;
use App\Backoffice\Users\UI\Transformer\UserTransformer;
use System\UI\Http\Controller\BaseController;

class UserQueriesController extends BaseController
{
    public function indexAction(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        $offset = (int) ($queryParams['offset'] ?? 0);
        $limit  = (int) ($queryParams['limit'] ?? $this->container->get('config')->get('users.limit'));

        $userFilter = new UserFilter();
        $userFilter
            ->setActive(true)
            ->setOffset($offset)
            ->setLimit($limit);

        $service = $this->container->get('users.query.service');

        $data = $this->transformerManager->transform($service->getCollection($userFilter), 'user');
        $data['total'] = $service->getCount($userFilter);

        return $this->respondWithData($data);
    }

    public function getAction(ServerRequestInterface $request, $params): ResponseInterface
    {
        $service = $this->container->get('users.query.service');

        $userFilter = new UserFilter();
        $userFilter->setActive(true);

        $result = $service->getOneById($params['id'], $userFilter);

        return $this->respondWithData($this->transformerManager->transform($result, 'user'));
    }

    protected function registerTransformers(): void
    {
        $this->transformerManager->add(new UserTransformer(), 'user');
    }
}
