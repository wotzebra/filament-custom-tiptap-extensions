@props([
    'statePath' => null,
    'icon' => 'link',
    'label' => __('filament-tiptap-editor::editor.link.insert_edit'),
    'active' => true,
])

@php
    $useActive = $active ? 'link' : false;
@endphp

{{--
    While the link modal is open, two things fight over the focus: the Alpine
    focus trap of the Filament modal pulls focus back inside the modal, and
    ProseMirror pulls it back into the editor because the text selection is
    still there. That loop runs hundreds of times per second and closes native
    select dropdowns the instant they open, so the route can never be picked.

    Making the editor inert for the duration of the modal keeps it out of the
    fight. It is released again as soon as the whole form component action
    stack has closed, which is dispatched before the editor receives the
    inserted link.
--}}
<x-filament-tiptap-editor::button
    action="openModal()"
    :active="$useActive"
    :label="$label"
    :icon="$icon"
    x-data="{
        inertEditor: null,

        lockEditor() {
            this.inertEditor = $el.closest('.tiptap-wrapper');

            if (this.inertEditor) {
                this.inertEditor.inert = true;
            }
        },

        releaseEditor() {
            if (! this.inertEditor) {
                return;
            }

            this.inertEditor.inert = false;
            this.inertEditor = null;
        },

        openModal() {
            let link = this.editor().getAttributes('link');

            let arguments = {
                href: link.href || '',
                coordinates: this.editor().view.state.selection.ranges,
            };

            this.lockEditor();

            $wire.dispatchFormEvent('tiptap::setLinkContent', '{{ $statePath }}', arguments);
        }
    }"
    x-on:closed-form-component-action-modal.window="releaseEditor()"
/>
