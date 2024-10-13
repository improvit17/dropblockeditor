<?php

namespace Jeffreyvr\DropBlockEditor\Components;

use Livewire\Component;

class ExampleButton extends Component
{
    public $properties;

    protected $listeners = [
        'editorIsUpdated' => 'editorIsUpdated',
    ];

    public function editorIsUpdated($properties)
    {
        $this->properties = $properties;
    }

    public function save()
    {
        // Example of getting a json string of the active blocks.
        // $activeBlocks = collect($this->properties['activeBlocks'])
        //     ->toJson();

        // If you want to generate the output, you can do:
        // $output = Parse::execute([
        //     'activeBlocks' => $this->properties['activeBlocks'],
        //     'base' => $this->properties['base'],
        //     'context' => 'rendered',
        //     'parsers' => $this->properties['parsers'],
        // ]);
    }

    public function render()
    {
        return <<<'blade'
            <div>
                <button wire:click="save" class="tw-editor-bg-blue-200 tw-editor-text-blue-900 tw-editor-rounded tw-editor-px-3 tw-editor-py-1 tw-editor-text-sm">Save</button>
            </div>
        blade;
    }
}
