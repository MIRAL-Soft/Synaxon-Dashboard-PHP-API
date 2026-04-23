<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class MailstoreInstanceResponseDto extends AbstractDto
{
    /**
     * Entity unique identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Entity creation date and time
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string) $this->data['createdAt'];
    }

    /**
     * Date and time of last update
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->data['updatedAt'];
    }

    /**
     * Instance ID
     *
     * @return string
     */
    public function getInstanceId(): string
    {
        return (string) $this->data['instanceId'];
    }

    /**
     * Customer ID
     *
     * @return float|null
     */
    public function getCustomerId(): ?float
    {
        $v = $this->data['customerId'] ?? null;
        return $v === null ? null : (float) $v;
    }

    /**
     * Tenant ID
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return (string) $this->data['tenantId'];
    }

    /**
     * Instance name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Instance alias
     *
     * @return string|null
     */
    public function getAlias(): ?string
    {
        $v = $this->data['alias'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Instance host
     *
     * @return string
     */
    public function getInstanceHost(): string
    {
        return (string) $this->data['instanceHost'];
    }

    /**
     * Instance status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Number of mailboxes in the instance
     *
     * @return float
     */
    public function getArchiveCount(): float
    {
        return (float) $this->data['archiveCount'];
    }

    /**
     * Number of messages in the instance
     *
     * @return float
     */
    public function getMessageCount(): float
    {
        return (float) $this->data['messageCount'];
    }

    /**
     * Size of the instance
     *
     * @return float
     */
    public function getSizeCount(): float
    {
        return (float) $this->data['sizeCount'];
    }

    /**
     * Number of additional users in the instance
     *
     * @return float
     */
    public function getAdditionalUsers(): float
    {
        return (float) $this->data['additionalUsers'];
    }

    /**
     * Number of additional storage in the instance
     *
     * @return float
     */
    public function getAdditionalStorage(): float
    {
        return (float) $this->data['additionalStorage'];
    }

    /**
     * Archives of the instance
     *
     * @return list<MailstoreArchiveResponseDto>
     */
    public function getArchives(): array
    {
        $out = [];
        foreach ((array) ($this->data['archives'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = MailstoreArchiveResponseDto::fromArray($item);
            } elseif ($item instanceof MailstoreArchiveResponseDto) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Journaling mailbox of the instance
     *
     * @return mixed|null
     */
    public function getJournalingMailbox(): mixed
    {
        return $this->data['journalingMailbox'] ?? null;
    }
}
