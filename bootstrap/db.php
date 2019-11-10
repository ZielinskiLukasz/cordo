<?php

use App\Loader;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use System\SharedKernel\Enum\Env;

$paths = Loader::loadEntities();
$isDevMode = getenv('APP_ENV') === Env::DEV();

// the connection configuration
$dbParams = [
    'dbname'    => getenv('DB_DATABASE'),
    'user'      => getenv('DB_USERNAME'),
    'password'  => getenv('DB_PASSWORD'),
    'host'      => getenv('DB_HOST'),
    'driver'    => 'pdo_mysql',
];

Type::addType('uuid_binary_ordered_time', 'Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType');

$cacheDir = storage_path() . 'cache/doctrine';

$config = Setup::createXMLMetadataConfiguration($paths, $isDevMode, $cacheDir);
$config->setAutoGenerateProxyClasses($isDevMode);

$entityManager = EntityManager::create($dbParams, $config);
$entityManager
    ->getConnection()
    ->getDatabasePlatform()
    ->registerDoctrineTypeMapping('uuid_binary_ordered_time', 'binary');

return $entityManager;
