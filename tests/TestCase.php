<?php

namespace Codedor\FilamentCustomTiptapExtensions\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codedor\FilamentCustomTiptapExtensions\Providers\FilamentCustomTiptapExtensionsServiceProvider;
use Filament\Support\SupportServiceProvider;
use FilamentTiptapEditor\FilamentTiptapEditorServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Codedor\\FilamentCustomTiptapExtensions\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            LivewireServiceProvider::class,
            SupportServiceProvider::class,
            FilamentTiptapEditorServiceProvider::class,
            FilamentCustomTiptapExtensionsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_filament-custom-tiptap-extensions_table.php.stub';
        $migration->up();
        */
    }
}
