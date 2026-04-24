<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class CreateLayoutItemDto extends AbstractDto
{
    /**
     * X coordinate position in the grid
     *
     * @return float
     */
    public function getX(): float
    {
        return (float) $this->data['x'];
    }

    /**
     * Y coordinate position in the grid
     *
     * @return float
     */
    public function getY(): float
    {
        return (float) $this->data['y'];
    }

    /**
     * Number of columns the widget spans
     *
     * @return float
     */
    public function getCols(): float
    {
        return (float) $this->data['cols'];
    }

    /**
     * Number of height the widget spans
     *
     * @return float
     */
    public function getRows(): float
    {
        return (float) $this->data['rows'];
    }

    /**
     * Type of widget to display
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->data['type'];
    }
}
