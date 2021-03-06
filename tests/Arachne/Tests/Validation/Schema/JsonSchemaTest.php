<?php

/*
 * This file is part of the Arachne package.
 *
 * (c) Wojtek Gancarczyk <gancarczyk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arachne\Tests\Validation\Schema;

use Arachne\Validation\Schema\JsonSchema;

/**
 * Class JsonSchemaTest
 * @package Arachne\Tests\Validation\Schema
 * @author Wojtek Gancarczyk <gancarczyk@gmail.com>
 */
class JsonSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testDoesNotFailOnValidSchema()
    {
        $validator = new JsonSchema;
        $validator->validateAgainstSchema(
            file_get_contents(implode(DIRECTORY_SEPARATOR, [FIXTURES_DIR, 'responses', 'test.json'])),
            implode(DIRECTORY_SEPARATOR, [FIXTURES_DIR, 'schemas', 'test.json'])
        );
    }

    public function testFailsOnInvalidSchema()
    {
        $this->setExpectedException(\Arachne\Exception\InvalidJson::class, 'The property lastName is required');
        $validator = new JsonSchema;
        $validator->validateAgainstSchema(
            file_get_contents(implode(DIRECTORY_SEPARATOR, [FIXTURES_DIR, 'responses', 'test-invalid.json'])),
            implode(DIRECTORY_SEPARATOR, [FIXTURES_DIR, 'schemas', 'test.json'])
        );
    }
}
