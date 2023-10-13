<?php

declare(strict_types=1);

namespace JeckelLab\Etl\Tests;

use JeckelLab\Etl\ETL;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \JeckelLab\Etl\Etl
 */
final class ETLTest extends TestCase
{
    public function testItEchoesSomething(): void
    {
        $extract = static fn(array $payload): string => $payload['username'] ?? '';
        $transform = 'strtoupper';
        $load = static fn(string $value, array $contact): array => array_merge($contact, ['username' => $value]);

        $payload = ['username' => 'john'];
        $contact = ['familyname' => 'doe'];
        $etl = new ETL($extract, $transform, $load);
        self::assertEquals(['username' => 'JOHN', 'familyname' => 'doe'], $etl->apply($payload, $contact));
    }
}
