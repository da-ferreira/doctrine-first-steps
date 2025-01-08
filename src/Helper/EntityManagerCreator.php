<?php

namespace Alura\Doctrine\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Dotenv\Dotenv;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/..'],
            isDevMode: true,
        );

        $consoleOutput = new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $loggerMiddleware = new Middleware($consoleLogger);

        $config->setMiddlewares([$loggerMiddleware]);

        $cacheDirectory = __DIR__ . '/../../var/cache';

        $config->setMetadataCache(new PhpFilesAdapter(namespace: 'metadata_cache', directory: $cacheDirectory));
        $config->setQueryCache(new PhpFilesAdapter(namespace: 'query_cache', directory: $cacheDirectory));
        $config->setResultCache(new PhpFilesAdapter(namespace: 'result_cache', directory: $cacheDirectory));

        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env');

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ], $config);

        return new EntityManager($connection, $config);
    }
}
