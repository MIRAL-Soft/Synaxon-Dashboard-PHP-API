<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ProductConfigSetItem extends AbstractDto
{
    /**
     * Config set name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->required('name');
    }

    /**
     * Config set label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return (string) $this->required('label');
    }

    /**
     * Config set type
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }

    /**
     * Config set required
     *
     * @return bool
     */
    public function getRequired(): bool
    {
        return (bool) $this->required('required');
    }
}
