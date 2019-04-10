<?php

declare(strict_types=1);

namespace App\Model\Element;

class ImageElement extends AbstractElement
{
    private const TYPE_NAME = 'image';

    /**
     * {@inheritdoc}
     */
    public static function getElementType(): string
    {
        return self::TYPE_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSupportedExtensions(): array
    {
        return [
            'jpg',
            'jpeg',
            'png',
            'gif',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function shouldLoadContent(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content): void
    {
        // Nothing to do here since shouldLoadContent returns false
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(): ?string
    {
        // Nothing to return here since shouldLoadContent returns false
        return null;
    }
}
