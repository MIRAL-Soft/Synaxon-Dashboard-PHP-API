<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class BackupChecksDto extends AbstractDto
{
    /**
     * @return BackupCheckTypeDto
     */
    public function getWorkstation(): BackupCheckTypeDto
    {
        $v = $this->data['workstation'] ?? null;
        if (is_array($v)) {
            return BackupCheckTypeDto::fromArray($v);
        }
        if ($v instanceof BackupCheckTypeDto) {
            return $v;
        }
        return BackupCheckTypeDto::fromArray([]);
    }

    /**
     * @return BackupCheckTypeDto
     */
    public function getServer(): BackupCheckTypeDto
    {
        $v = $this->data['server'] ?? null;
        if (is_array($v)) {
            return BackupCheckTypeDto::fromArray($v);
        }
        if ($v instanceof BackupCheckTypeDto) {
            return $v;
        }
        return BackupCheckTypeDto::fromArray([]);
    }
}
