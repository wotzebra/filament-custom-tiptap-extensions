# Some custom extensions for Filament Tiptap

## Introduction

This package provides extensions for the `awcodes/filament-tiptap-editor` package to integrate it with our own packages.

## Installation

First, install this package via the Composer package manager:

```bash
composer require wotz/filament-custom-tiptap-extensions
```

## LinkPicker Plugin

This provides a custom Tiptap plugin that allows you to pick links via our [link picker](https://github.com/wotzebra/filament-link-picker) package.

If you want to enable this plugin for each RichEditor, you can do this by adding the following code to your Filament service provider:

```php
use Wotz\FilamentCustomTiptapExtensions\Plugins\LinkPickerRichContentPlugin;
use Filament\Forms\Components\RichEditor;

RichEditor::configureUsing(function (RichEditor $editor) {
    $editor
        ->toolbarButtons([
            [
                'h2', 'h3', 'bulletList', 'orderedList', 'blockquote',
            ],
            [
                'bold', 'italic', 'strike', 'underline', 'superscript', 'subscript', 'lead', 'small', 'alignStart', 'alignCenter', 'alignEnd',
            ],
            [
                'linkPicker',
            ],
            ['undo', 'redo'],
        ])
        ->plugins([
            LinkPickerRichContentPlugin::make(),
        ]);
});
```

That's all you need to do to enable the LinkPicker plugin for all RichEditor components in your Filament application.
