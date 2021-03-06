<?php

use Noodlehaus\Config;
use League\Event\Emitter;
use League\Plates\Engine;
use System\UI\Http\Router;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use League\Event\EmitterInterface;
use Psr\Container\ContainerInterface;
use System\Application\Config\Parser;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Translation\Translator;
use System\UI\Transformer\TransformerManager;
use System\Application\Error\ErrorReporterInterface;
use System\UI\Transformer\TransformerManagerInterface;
use System\Infractructure\Mailer\ZendMail\MailerInterface;

return [
    'config'    => DI\factory(static function () {
        return new Config(config_path(), new Parser());
    }),
    'lang'      => DI\factory(static function () {
        return new Config(resources_path() . 'lang', new Parser());
    }),
    'request'   => DI\get(ServerRequestInterface::class),
    'router'    => DI\get(Router::class),
    'emitter'   => DI\get(EmitterInterface::class),
    ServerRequestInterface::class => DI\factory('GuzzleHttp\Psr7\ServerRequest::fromGlobals'),
    ErrorReporterInterface::class => DI\get('error_reporter'),
    MailerInterface::class => DI\get('mailer'),
    EmitterInterface::class => DI\get(Emitter::class),
    EntityManager::class => DI\get('entity_manager'),
    TransformerManagerInterface::class => DI\get(TransformerManager::class),
    Connection::class => DI\factory(static function (ContainerInterface $container) {
        return $container->get('entity_manager')->getConnection();
    }),
    Engine::class => DI\get('templates'),
    Translator::class => DI\get('translator'),
];
