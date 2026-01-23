<?php

namespace Wotz\FilamentCustomTiptapExtensions\Plugins;

use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Support\Facades\FilamentAsset;
use Tiptap\Core\Extension;
use Wotz\FilamentCustomTiptapExtensions\Extensions\CheckedList;

class CheckedListPlugin implements RichContentPlugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    /**
     * @return array<Extension>
     */
    public function getTipTapPhpExtensions(): array
    {
        return [
            app(CheckedList::class),
        ];
    }

    /**
     * @return array<string>
     */
    public function getTipTapJsExtensions(): array
    {
        return [
            FilamentAsset::getScriptSrc('rich-content-plugins/checked-list'),
        ];
    }

    /**
     * @return array<RichEditorTool>
     */
    public function getEditorTools(): array
    {
        return [
            RichEditorTool::make('checkedList')
                ->label('Checked List')
                ->jsHandler('$getEditor()?.chain().focus().toggleCheckedList().run()')
                ->icon('carbon-list-checked'),
        ];
    }

    /**
     * @return array<\Filament\Actions\Action>
     */
    public function getEditorActions(): array
    {
        return [];
    }
}
