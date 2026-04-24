<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class ProductResponseDto extends AbstractDto
{
    /**
     * Product agreement type
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->data['id'];
    }

    /**
     * Product name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->data['name'];
    }

    /**
     * Product status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return (string) $this->data['status'];
    }

    /**
     * Product terms URL
     *
     * @return string
     */
    public function getTermsUrl(): string
    {
        return (string) $this->data['termsUrl'];
    }

    /**
     * Product confirmed by
     *
     * @return string|null
     */
    public function getConfirmedBy(): ?string
    {
        $v = $this->data['confirmedBy'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product confirmed on
     *
     * @return string|null
     */
    public function getConfirmedOn(): ?string
    {
        $v = $this->data['confirmedOn'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product config sets
     *
     * @return list<ProductConfigSetItem>
     */
    public function getConfigSet(): array
    {
        $out = [];
        foreach ((array) ($this->data['configSet'] ?? []) as $item) {
            if (is_array($item)) {
                $out[] = ProductConfigSetItem::fromArray($item);
            } elseif ($item instanceof ProductConfigSetItem) {
                $out[] = $item;
            }
        }
        return $out;
    }

    /**
     * Product order link
     *
     * @return string|null
     */
    public function getOrderLink(): ?string
    {
        $v = $this->data['orderLink'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product landing page
     *
     * @return string|null
     */
    public function getLandingPage(): ?string
    {
        $v = $this->data['landingPage'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product info URL
     *
     * @return string|null
     */
    public function getInfoUrl(): ?string
    {
        $v = $this->data['infoUrl'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product illustrated logo
     *
     * @return string|null
     */
    public function getIllustratedLogo(): ?string
    {
        $v = $this->data['illustratedLogo'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product product logo
     *
     * @return string|null
     */
    public function getProductLogo(): ?string
    {
        $v = $this->data['productLogo'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product preview images
     *
     * @return list<string>
     */
    public function getPreviewImages(): array
    {
        return (array) ($this->data['previewImages'] ?? []);
    }

    /**
     * Product short description
     *
     * @return string|null
     */
    public function getShortDescription(): ?string
    {
        $v = $this->data['shortDescription'] ?? null;
        return $v === null ? null : (string) $v;
    }

    /**
     * Product order text
     *
     * @return string|null
     */
    public function getOrderText(): ?string
    {
        $v = $this->data['orderText'] ?? null;
        return $v === null ? null : (string) $v;
    }
}
