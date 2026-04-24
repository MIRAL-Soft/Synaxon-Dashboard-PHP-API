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
    // Generated artefacts: skip to avoid fighting the generator's style.
    ->exclude(['DTO'])
    ->notPath('Resource/AcronisResource.php')
    ->notPath('Resource/AuditResource.php')
    ->notPath('Resource/AuthResource.php')
    ->notPath('Resource/CustomersResource.php')
    ->notPath('Resource/DownloadsResource.php')
    ->notPath('Resource/EsetResource.php')
    ->notPath('Resource/LayoutResource.php')
    ->notPath('Resource/LywandResource.php')
    ->notPath('Resource/MailstoreResource.php')
    ->notPath('Resource/NSightResource.php')
    ->notPath('Resource/NotificationsResource.php')
    ->notPath('Resource/PatchesResource.php')
    ->notPath('Resource/ProductsResource.php')
    ->notPath('Resource/PusherResource.php')
    ->notPath('Resource/ReportsResource.php')
    ->notPath('Resource/SalesOpportunitiesResource.php')
    ->notPath('Resource/SecAuditorResource.php')
    ->notPath('Resource/SupportResource.php')
    ->notPath('Resource/SystemTasksResource.php')
    ->notPath('Resource/TenantsResource.php')
    ->notPath('Resource/UsersResource.php')
    ->notPath('Client/SynaxonClient.php')
    ->notPath('Tests/Integration/ReadOnly')
    ->notPath('Tests/Unit/Resource');

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12'                       => true,
        '@PHP83Migration'              => true,
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
