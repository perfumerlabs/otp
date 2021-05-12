<?php

namespace Otp\Command;

use Perfumer\Framework\Controller\PlainController;
use Perfumer\Framework\Router\ConsoleRouterControllerHelpers;

class StartupCommand extends PlainController
{
    use ConsoleRouterControllerHelpers;

    public function action()
    {
        $real_host = $this->getContainer()->getParam('pg/real_host');
        $host = $this->getContainer()->getParam('pg/host');
        $port = $this->getContainer()->getParam('pg/port');
        $user = $this->getContainer()->getParam('pg/user');
        $password = $this->getContainer()->getParam('pg/password');
        $database = $this->getContainer()->getParam('pg/database');
        $schema = $this->getContainer()->getParam('pg/schema');

        if (!$real_host) {
            echo 'Environment variable PG_REAL_HOST is not defined, so skipping database and/or schema creation.' . PHP_EOL;
        } else {
            while (true) {
                try {
                    $dbh = new \PDO("pgsql:host=$real_host;port=$port", $user, $password);
                } catch (\PDOException $e) {
                    echo 'Could not connect to PostgreSQL server to create database. Delaying...' . PHP_EOL;
                    sleep(3);
                    continue;
                }

                $dbh->exec("CREATE DATABASE \"$database\";");

                echo 'Database created' . PHP_EOL;

                if ($schema !== 'public') {
                    try {
                        $dbh = new \PDO("pgsql:host=$real_host;port=$port;dbname=$database", $user, $password);
                    } catch (\PDOException $e) {
                        echo 'Could not connect to PostgreSQL database to create schema. Delaying...' . PHP_EOL;
                        sleep(3);
                        continue;
                    }

                    $dbh->exec("CREATE SCHEMA \"$schema\";");

                    echo 'Schema created' . PHP_EOL;
                }

                break;
            }
        }

        echo shell_exec('cd /opt/otp && /usr/bin/php cli framework propel/migrate');
    }
}
