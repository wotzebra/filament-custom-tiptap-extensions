<?php

namespace Wotz\FilamentCustomTiptapExtensions\Extensions;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class CheckedList extends Node
{
    public static $name = 'checkedList';

    public function addOptions(): array
    {
        return [
            'HTMLAttributes' => [
                'class' => 'checked-list',
            ],
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'ul',
                'getAttrs' => fn ($node) => str_contains($node->getAttribute('class') ?? '', 'checked-list'),
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): array
    {
        return ['ul', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
