<?php

namespace Jeffreyvr\DropBlockEditor\Components;

class Example extends BlockEditComponent
{
    public function render()
    {
        return <<<'blade'
            <div class="tw-editor-space-y-4">
                <div>
                    <label for="title" class="tw-editor-mb-1">Title</label>
                    <input type="text" id="title" wire:model.live.debounce.500ms="data.title" class="tw-editor-w-full tw-editor-border tw-editor-border-gray-200 tw-editor-px-3 tw-editor-py-1 tw-editor-rounded-md">
                </div>
                <div>
                    <label for="content" class="tw-editor-mb-1">Content</label>
                    <textarea id="content" wire:model.live.debounce.500ms="data.content" class="tw-editor-w-full tw-editor-border tw-editor-border-gray-200 tw-editor-px-3 tw-editor-py-1 tw-editor-rounded-md"></textarea>
                </div>
            </div>
        blade;
    }
}
