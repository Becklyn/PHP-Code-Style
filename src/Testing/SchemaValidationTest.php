<?php declare(strict_types=1);

namespace Becklyn\PhpCs\Testing;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaValidator;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

abstract class SchemaValidationTest extends TestCase
{
    private const DB_PATH = __DIR__ . "/test_db.sqlite";

    /**
     * @inheritDoc
     */
    protected function tearDown ()
    {
        if (\is_file(self::DB_PATH))
        {
            @\unlink(self::DB_PATH);
        }
    }

    /**
     *
     */
    public function testSchemaIsValid () : void
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            $this->getEntityDirs(),
            true,
            null,
            null,
            false
        );
        $entityManager = EntityManager::create([
            "driver" => "pdo_sqlite",
            "path" => __DIR__ . "/db.sqlite",
        ], $config);
        $validator = new SchemaValidator($entityManager);
        self::assertCount(0, $validator->validateMapping());
    }


    /**
     * @return string
     */
    protected function getEntityDirs () : array
    {
        $root = \rtrim($this->getRootDir(), "/");

        return  [
            "{$root}/src/Entity",
        ];
    }


    /**
     * Returns the path to the root dir
     *
     * @return string
     */
    abstract protected function getRootDir () : string;
}
