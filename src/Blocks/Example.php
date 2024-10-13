<?php

namespace Jeffreyvr\DropBlockEditor\Blocks;

class Example extends Block
{
    public string $title = 'Example';

    public string $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-6 tw-editor-h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" /> </svg>';

    public string $blockEditComponent = 'dropblockeditor-example';

    public array $data = [
        'title' => 'Drop it like it\'s hot! 🔥',
        'content' => 'This block example block gives you a glimpse of what you could do with this editor. I hope you enjoy using it!',
    ];

    public function render(): string
    {
        return <<<'blade'
        <div class=tw-editor-"mx-auto tw-editor-my-4 tw-editor-max-w-screen-md tw-editor-p-8 tw-editor-bg-white tw-editor-rounded-xl">
            <div class="tw-editor-text-3xl tw-editor-font-extrabold tw-editor-mb-2 tw-editor-text-orange-600">{{ $title }}</div>
            <div class="tw-editor-text-lg tw-editor-text-gray-700">{{ $content }}</div>
        </div>
        blade;
    }
}
