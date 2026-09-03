<?php

use Illuminate\Support\Facades\Blade;

function renderLinkpicker(): string
{
    return Blade::render(
        '<x-filament-custom-tiptap-extensions::linkpicker state-path="data.body" />'
    );
}

it('dispatches the tiptap link event for its state path', function () {
    expect(renderLinkpicker())
        ->toContain('tiptap::setLinkContent')
        ->toContain('data.body');
});

it('makes the editor inert while the link modal is open', function () {
    // Regression: the Alpine focus trap of the Filament modal and ProseMirror
    // both claim the focus, which loops endlessly and closes native select
    // dropdowns - the route can then never be picked. Marking the editor inert
    // for the duration of the modal keeps it out of that fight.
    expect(renderLinkpicker())
        ->toContain("closest('.tiptap-wrapper')")
        ->toContain('inert = true');
});

it('releases the editor again once the action stack has closed', function () {
    expect(renderLinkpicker())
        ->toContain('closed-form-component-action-modal.window')
        ->toContain('inert = false');
});
