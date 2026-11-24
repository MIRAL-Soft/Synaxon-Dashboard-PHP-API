<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ImportFromRefreshtokensRequestDto extends AbstractDto
{
    /**
     * JSON file containing account numbers and refresh tokens
     *
     * @return string
     */
    public function getRefreshTokensFile(): string
    {
        return (string) $this->required('refreshTokensFile');
    }

    /**
     * Set the "refreshTokensFile" field. JSON file containing account numbers and refresh tokens
     *
     * @return static
     */
    public function withRefreshTokensFile(?string $value): static
    {
        return $this->with('refreshTokensFile', $value);
    }
}
