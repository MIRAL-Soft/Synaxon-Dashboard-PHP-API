<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ApiTaskResponse extends AbstractDto
{
    /**
     * The ID of the task
     *
     * @return string
     */
    public function getTaskId(): string
    {
        return (string) $this->data['taskId'];
    }
}
