<?php

declare(strict_types=1);

/**
 * Build a request payload using the immutable fluent setters on a
 * generated *RequestDto class.
 *
 * Each `with*()` call returns a NEW instance — the original DTO is
 * never mutated, which makes the pattern safe to share between
 * threads/coroutines and easy to test.
 *
 * Run with:
 *   php examples/05-builder-pattern.php
 *
 * (No network call — this is a pure build-and-print example.)
 */

require_once __DIR__ . '/../vendor/autoload.php';

use miralsoft\synaxon\api\DTO\CreateCustomerRequestDto;

$payload = (new CreateCustomerRequestDto())
    ->withName('Acme GmbH')
    ->withCustomerNumber('12345')
    ->withSalutation('Firma')
    ->withStreet('Musterstraße 1')
    ->withPostalCode('88250')
    ->withCity('Weingarten')
    ->withCountry('DE')
    ->withEmail('info@acme.test')
    ->withPhone('0751 123456');

echo $payload->toJson(), "\n";

// Want to override a single field later? Use withAll:
$revised = $payload->withAll([
    'email' => 'support@acme.test',
    'phone' => '0751 999999',
]);

echo "Revised email/phone:\n";
echo '  ', $revised->getEmail(), ' / ', $revised->getPhone(), "\n";
echo "Original is unchanged:\n";
echo '  ', $payload->getEmail(), ' / ', $payload->getPhone(), "\n";
