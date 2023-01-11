<?php

declare(strict_types=1);

namespace danog\MadelineProto\Db\Driver;

use Amp\Mysql\MysqlConfig;
use Amp\Mysql\MysqlConnectionPool;
use Amp\Sql\ConnectionException;
use Amp\Sql\FailureException;
use danog\MadelineProto\Logger;
use danog\MadelineProto\Settings\Database\Mysql as DatabaseMysql;
use Throwable;

/**
 * MySQL driver wrapper.
 *
 * @internal
 */
class Mysql
{
    /** @var array<MysqlConnectionPool> */
    private static array $connections = [];

    /**
     * @throws ConnectionException
     * @throws Throwable
     */
    public static function getConnection(DatabaseMysql $settings): MysqlConnectionPool
    {
        $dbKey = $settings->getKey();
        if (!isset(self::$connections[$dbKey])) {
            $config = MysqlConfig::fromString('host='.\str_replace('tcp://', '', $settings->getUri()))
                ->withUser($settings->getUsername())
                ->withPassword($settings->getPassword())
                ->withDatabase($settings->getDatabase());

            self::createDb($config);
            self::$connections[$dbKey] = new MysqlConnectionPool($config, $settings->getMaxConnections(), $settings->getIdleTimeout());
        }

        return self::$connections[$dbKey];
    }

    /**
     * @throws ConnectionException
     * @throws FailureException
     * @throws Throwable
     */
    private static function createDb(MysqlConfig $config): void
    {
        try {
            $db = $config->getDatabase();
            $connection = new MysqlConnectionPool($config->withDatabase(null));
            $connection->query("
                    CREATE DATABASE IF NOT EXISTS `{$db}`
                    CHARACTER SET 'utf8mb4' 
                    COLLATE 'utf8mb4_general_ci'
                ");
            $connection->close();
        } catch (Throwable $e) {
            Logger::log($e->getMessage(), Logger::ERROR);
        }
    }
}
