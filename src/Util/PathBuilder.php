<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Util;

use InvalidArgumentException;

/**
 * Safe URI template expansion.
 *
 * Expands placeholders of the form {name} in a path template by substituting
 * URL-encoded values from the supplied map. Values are never passed through
 * string concatenation unescaped.
 */
final class PathBuilder
{
    /**
     * @param array<string, scalar> $params
     */
    public static function expand(string $template, array $params = []): string
    {
        return (string) preg_replace_callback(
            '/\{([A-Za-z_][A-Za-z0-9_]*)\}/',
            static function (array $m) use ($params, $template): string {
                $name = $m[1];
                if (!array_key_exists($name, $params)) {
                    throw new InvalidArgumentException(sprintf(
                        'Missing path parameter "%s" for template "%s"',
                        $name,
                        $template
                    ));
                }
                $value = (string) $params[$name];
                if ($value === '') {
                    throw new InvalidArgumentException(sprintf(
                        'Path parameter "%s" must not be empty (template "%s")',
                        $name,
                        $template
                    ));
                }

                return rawurlencode($value);
            },
            $template
        );
    }
}
