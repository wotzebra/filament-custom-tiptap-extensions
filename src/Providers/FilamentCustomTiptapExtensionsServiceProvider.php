<?php

namespace Wotz\FilamentCustomTiptapExtensions\Providers;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentCustomTiptapExtensionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-custom-tiptap-extensions')
            ->setBasePath(__DIR__ . '/../');
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Js::make(
                id: 'rich-content-plugins/checked-list',
                path: __DIR__ . '/../../resources/dist/filament/rich-content-plugins/checked-list.js'
            )->loadedOnRequest(),
        ]);
    }
}
