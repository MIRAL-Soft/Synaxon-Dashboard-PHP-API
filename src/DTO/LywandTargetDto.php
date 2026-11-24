<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LywandTargetDto extends AbstractDto
{
    /**
     * Target name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Target type (endpoint, domain, email, ip)
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * Whether the target is in scope
     *
     * @return bool
     */
    public function getInScope(): bool
    {
        return (bool) $this->required('inScope');
    }

    /**
     * Lywand identifier
     *
     * @return string
     */
    public function getLywandIdentifier(): string
    {
        return (string) $this->required('lywandIdentifier');
    }
}
