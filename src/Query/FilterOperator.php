<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\Query;

/**
 * Enumeration of supported filter operators for the QueryBuilder.
 */
enum FilterOperator: string
{
    case EQ = 'eq';
    case NEQ = 'neq';
    case GT = 'gt';
    case GTE = 'gte';
    case LT = 'lt';
    case LTE = 'lte';
    case ILIKE = 'ilike';
    case IN = 'in';
}
