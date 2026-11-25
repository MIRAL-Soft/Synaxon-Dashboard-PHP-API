<?php

declare(strict_types=1);

/**
 * PHP-CS-Fixer configuration.
 *
 * Run via:
 *   composer fmt        # apply fixes
 *   composer fmt:check  # report only
 */

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/bin',
        __DIR__ . '/examples',
    ])
    ->name('*.php')
    // Generated artefacts (C-15, C-16): never touched by the formatter. The
    // generators are the only writers, and bin/check-generated.php verifies that
    // regenerating reproduces the committed files byte for byte. Paths are
    // relative to each directory passed to in().
    ->notPath('#^DTO/(?!AbstractDto\.php$)#')
    ->notPath('#^Resource/(?!AbstractResource)[A-Za-z0-9]+Resource\.php$#')
    ->notPath('Client/SynaxonClient.php')
    ->notPath('#^Integration/ReadOnly/.+ReadTest\.php$#')
    ->notPath('#^Unit/Resource/.+WriteTest\.php$#');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'                       => true,
        '@PHP84Migration'              => true,
        'declare_strict_types'         => true,
        'no_unused_imports'            => true,
        'ordered_imports'              => ['sort_algorithm' => 'alpha'],
        'single_quote'                 => true,
        'array_syntax'                 => ['syntax' => 'short'],
        'no_trailing_whitespace'       => true,
        'no_extra_blank_lines'         => true,
        'binary_operator_spaces'       => ['default' => 'single_space'],
        'method_argument_space'        => ['on_multiline' => 'ensure_fully_multiline'],
        'phpdoc_align'                 => ['align' => 'left'],
        'no_empty_phpdoc'              => true,
        'phpdoc_separation'            => true,
        'class_attributes_separation'  => ['elements' => ['method' => 'one']],
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
