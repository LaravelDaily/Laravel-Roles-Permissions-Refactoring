<?php

namespace Tests;

use Closure;
use \Illuminate\Support\Fluent;
use Illuminate\Database\Connection;
use \Illuminate\Database\SQLiteConnection;
use \Illuminate\Database\Schema\{SQLiteBuilder, Blueprint};
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        $this->hotfixSqlite();
        parent::__construct($name, $data, $dataName);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function hotfixSqlite()
    {
        Connection::resolverFor('sqlite',
            function ($connection, $database, $prefix, $config) {
            return new class($connection, $database, $prefix, $config)
                extends SQLiteConnection {
                public function getSchemaBuilder()
                {
                    if ($this->schemaGrammar === null) {
                        $this->useDefaultSchemaGrammar();
                    }

                    return new class($this) extends SQLiteBuilder {
                        protected function createBlueprint($table, Closure $callback = null)
                        {
                            return new class($table, $callback) extends Blueprint {
                                public function dropForeign($index)
                                {
                                    return new Fluent();
                                }
                            };
                        }
                    };
                }
            };
        });
    }
}
