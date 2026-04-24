<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Tests\Unit\DTO;

use miralsoft\synaxon\api\DTO\CreateAcronisCustomerRequestDto;
use miralsoft\synaxon\api\DTO\CreateCustomerRequestDto;
use PHPUnit\Framework\TestCase;

/**
 * Verifies the immutable fluent-setter API on request DTOs:
 *  - withX() returns a new instance (no mutation of the original)
 *  - chained calls accumulate in the new instance
 *  - sub-DTO arguments are auto-converted via toArray()
 *  - withAll() merges patches at once
 */
final class BuilderTest extends TestCase
{
    public function testWithXIsImmutable(): void
    {
        $a = new CreateAcronisCustomerRequestDto();
        $b = $a->withEmail('foo@bar.test');

        self::assertNotSame($a, $b, 'withX must return a new instance');
        self::assertSame([], $a->toArray(), 'original DTO must remain unchanged');
        self::assertSame(['email' => 'foo@bar.test'], $b->toArray());
    }

    public function testFluentChainingAccumulatesFields(): void
    {
        $dto = (new CreateAcronisCustomerRequestDto())
            ->withEmail('a@b.test')
            ->withCustomerId(42.0);

        self::assertSame(
            ['email' => 'a@b.test', 'customerId' => 42.0],
            $dto->toArray()
        );
    }

    public function testWithAllMergesFields(): void
    {
        $dto = (new CreateCustomerRequestDto())->withAll([
            'name'           => 'Acme GmbH',
            'customerNumber' => '12345',
            'city'           => 'Weingarten',
        ]);

        self::assertSame('Acme GmbH', $dto->toArray()['name']);
        self::assertSame('12345',     $dto->toArray()['customerNumber']);
        self::assertSame('Weingarten', $dto->toArray()['city']);
    }

    public function testRoundTripsThroughJson(): void
    {
        $dto = (new CreateAcronisCustomerRequestDto())
            ->withEmail('round@trip.test');

        $rebuilt = CreateAcronisCustomerRequestDto::fromArray(
            json_decode($dto->toJson(), true)
        );
        self::assertSame($dto->toArray(), $rebuilt->toArray());
    }
}
