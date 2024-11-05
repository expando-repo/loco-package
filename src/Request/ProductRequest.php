<?php

declare(strict_types=1);

namespace Expando\LocoPackage\Request;

use Expando\LocoPackage\IRequest;

class ProductRequest extends Base implements IRequest
{
    private int $connectionId;
    private ?int $productId = null;
    private string $status = 'active';
    private string $identifier;
    private string $code;

    private string $title;
    private ?string $description = null;
    private ?string $description2 = null;
    private ?string $description_short = null;

    private ?string $seo_title = null;
    private ?string $seo_description = null;

    private ?string $url = null;
    private array $tags = [];
    private array $categories = [];
    private array $images = [];
    private array $variants = [];
    private array $brands = [];

    public function __construct(int $connectionId, ?int $productId = null)
    {
        $this->connectionId = $connectionId;
        $this->productId = $productId;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getConnectionId(): int
    {
        return $this->connectionId;
    }

    /**
     * @param VariantRequest $variantRequest
     * @return void
     */
    public function addVariant(VariantRequest $variantRequest): void
    {
        $this->variants[] = $variantRequest->asArray();
    }

    /**
     * @param string $url
     * @param int|null $position
     * @param bool $default
     * @param string|null $alt
     * @return void
     */
    public function addImageUrl(string $url, ?int $position = null, bool $default = false, ?string $alt = null): void
    {
        $image = [
            'position' => $position,
            'src' => $url,
            'default' => (int)$default,
            'alt' => $alt,
        ];
        $this->images[] = $image;
    }

    /**
     * @param string $title
     * @param string|null $description
     * @param string|null $identifier
     * @param string|null $seo_title
     * @param string|null $seo_description
     * @param string|null $seo_keywords
     * @return void
     */
    public function addBrand(string $title, ?string $description = null, ?string $identifier = null, ?string $seo_title = null, ?string $seo_description = null, ?string $seo_keywords = null): void
    {
        $brand = [
            'identifier' => $identifier,
            'title' => $title,
            'description' => $description,
            'seo_title' => $seo_title,
            'seo_description' => $seo_description,
            'seo_keywords' => $seo_keywords,
        ];
        $this->brands[] = $brand;
    }

    /**
     * @param string $title
     * @param string|null $description
     * @param string|null $identifier
     * @param string|null $description2
     * @param string|null $seo_title
     * @param string|null $seo_description
     * @param string|null $seo_keywords
     * @param string|null $menu_title
     * @return void
     */
    public function addCategory(string $title, ?string $description = null, ?string $identifier = null, ?string $description2 = null, ?string $seo_title = null, ?string $seo_description = null, ?string $seo_keywords = null, ?string $menu_title = null): void
    {
        $category = [
            'identifier' => $identifier,
            'title' => $title,
            'description' => $description,
            'description2' => $description2,
            'seo_description' => $seo_description,
            'seo_title' => $seo_title,
            'seo_keywords' => $seo_keywords,
            'menu_title' => $menu_title,
        ];
        $this->categories[] = $category;
    }

    /**
     * @param string $title
     * @param string|null $description
     * @param string|null $identifier
     * @param string|null $seo_title
     * @param string|null $seo_description
     * @param string|null $seo_keywords
     * @return void
     */
    public function addTag(string $title, ?string $description = null, ?string $identifier = null, ?string $seo_title = null, ?string $seo_description = null, ?string $seo_keywords = null): void
    {
        $tag = [
            'identifier' => $identifier,
            'title' => $title,
            'description' => $description,
            'seo_title' => $seo_title,
            'seo_description' => $seo_description,
            'seo_keywords' => $seo_keywords,
        ];
        $this->tags[] = $tag;
    }

    /**
     * @return void
     */
    public function active(): void
    {
        $this->status = 'active';
    }

    /**
     * @return void
     */
    public function inactive(): void
    {
        $this->status = 'inactive';
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string|null $description2
     */
    public function setDescription2(?string $description2): void
    {
        $this->description2 = $description2;
    }

    /**
     * @param string|null $description_short
     */
    public function setDescriptionShort(?string $description_short): void
    {
        $this->description_short = $description_short;
    }

    /**
     * @param string|null $seo_title
     */
    public function setSeoTitle(?string $seo_title): void
    {
        $this->seo_title = $seo_title;
    }

    /**
     * @param string|null $seo_description
     */
    public function setSeoDescription(?string $seo_description): void
    {
        $this->seo_description = $seo_description;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return [
            'connection_id' => $this->connectionId,
            'product_id' => $this->productId,
            'status' => $this->status,
            'identifier' => $this->identifier,
            'code' => $this->code,
            'title' => $this->title,
            'description' => $this->description,
            'description2' => $this->description2,
            'description_short' => $this->description_short,
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'url' => $this->url,
            'brands' => $this->brands,
            'images' => $this->images,
            'tags' => $this->tags,
            'categories' => $this->categories,
            'variants' => $this->variants,
        ];
    }
}
