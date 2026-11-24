<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class LayoutItemResponseDto extends AbstractDto
{
    /**
     * X coordinate position in the grid
     *
     * @return float
     */
    public function getX(): float
    {
        return (float) $this->required('x');
    }

    /**
     * Y coordinate position in the grid
     *
     * @return float
     */
    public function getY(): float
    {
        return (float) $this->required('y');
    }

    /**
     * Number of columns the widget spans
     *
     * @return float
     */
    public function getCols(): float
    {
        return (float) $this->required('cols');
    }

    /**
     * Number of height the widget spans
     *
     * @return float
     */
    public function getRows(): float
    {
        return (float) $this->required('rows');
    }

    /**
     * Type of widget to display
     *
     * @return string
     */
    public function getType(): string
    {
        return (string) $this->required('type');
    }
}
