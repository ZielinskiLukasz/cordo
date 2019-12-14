<?php

use System\Module\Auth\Application\Service\AclQueryService;
use System\Module\Auth\Application\Command\Handler\CreateUserAclHandler;
use System\Module\Auth\Application\Command\Handler\DeleteUserAclHandler;
use System\Module\Auth\Application\Command\Handler\UpdateUserAclHandler;
use System\Module\Auth\Infrastructure\Persistance\Doctrine\Query\AclDoctrineQuery;
use System\Module\Auth\Infrastructure\Persistance\Doctrine\ORM\AclDoctrineRepository;
use App\Users\Infrastructure\Persistance\Doctrine\ORM\UserDoctrineRepository;

return [
    CreateUserAclHandler::class => DI\create()
        ->constructor(
            DI\get(AclDoctrineRepository::class),
            DI\get(UserDoctrineRepository::class),
            DI\get('emitter')
        ),
    UpdateUserAclHandler::class => DI\create()
        ->constructor(
            DI\get(AclDoctrineRepository::class),
            DI\get(UserDoctrineRepository::class),
            DI\get('emitter')
        ),
    DeleteUserAclHandler::class => DI\create()
        ->constructor(
            DI\get(AclDoctrineRepository::class),
            DI\get('emitter')
        ),
    'acl.query.service' => DI\create(AclQueryService::class)
        ->constructor(DI\get(AclDoctrineQuery::class)),
];