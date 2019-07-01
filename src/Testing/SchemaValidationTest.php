<?php declare(strict_types=1);

namespace Becklyn\PhpCs\Testing;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaValidator;
use Doctrine\ORM\Tools\Setup;
use PHPUnit\Framework\TestCase;

/**
 * Validates the doctrine schema
 */
class SchemaValidationTest extends TestCase
{
    /**
     *
     */
    final public function testSchemaIsValid () : void
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            $this->getEntityDirs(),
            true,
            null,
            null,
            false
        );
        $entityManager = EntityManager::create([
            "url" => "sqlite:///:memory:",
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
    protected function getRootDir () : string
    {
        $r = new \ReflectionClass($this);

        return \dirname($r->getFileName(), 2);
    }
}
