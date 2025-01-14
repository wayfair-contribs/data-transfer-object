<?php

namespace Spatie\DataTransferObject\Tests;

use Spatie\DataTransferObject\DataTransferObjectError;
use Spatie\DataTransferObject\Tests\TestClasses\TestDataTransferObject;
use Spatie\DataTransferObject\Tests\TestClasses\NullableTestDataTransferObject;

class ImmutableTest extends TestCase
{
    /** @test */
    public function immutable_values_cannot_be_overwritten()
    {
        $dto = TestDataTransferObject::immutable([
            'testProperty' => 1,
        ]);

        $this->assertEquals(1, $dto->testProperty);

        $this->expectException(DataTransferObjectError::class);

        $dto->testProperty = 2;
    }

    /** @test */
    public function method_calls_are_proxied()
    {
        $dto = TestDataTransferObject::immutable([
            'testProperty' => 1,
        ]);

        $this->assertEquals(['testProperty' => 1], $dto->toArray());
    }

    /** @test */
    public function passing_parameters_is_not_required()
    {
        $dto = NullableTestDataTransferObject::immutable();

        $this->assertEquals(['foo' => 'abc', 'bar' => null], $dto->toArray());
    }
}
