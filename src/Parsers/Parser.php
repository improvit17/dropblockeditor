<?php

namespace Jeffreyvr\DropBlockEditor\Parsers;

use Illuminate\Support\Facades\Blade;

abstract class Parser
{
    public $output;

    public $context = 'editor';

    public $base;

    public $blockArguments = [];

    public function __construct(public $input, public $blocks = [])
    {
        //
    }

    public function parse()
    {
        return $this;
    }

    public function base($base)
    {
        $this->base = $base;

        return $this;
    }

    public function context($context)
    {
        $this->context = $context;

        return $this;
    }

    public function output()
    {
        return $this->output;
    }

    public function setBlockArguments($key, $value, $method = null)
    {
        if ($method) {
            $this->blockArguments[$key][$method] = $value;
        } else {
            $this->blockArguments[$key] = $value;
        }
    }

    public function prepareBlockForEditor(array $args)
    {
        $args = collect([
            'blockHtml' => $args['blockHtml'],
            'id' => $args['id'],
            'before' => '<div drag-item draggable="true" class="[&_*]:pointer-events-none relative hover:opacity-75 hover:cursor-pointer before:opacity-0 hover:before:opacity-100 before:absolute before:top-0 before:left-0 before:w-full before:h-full before:border-2 before:border-gray-400 after:opacity-0 after:absolute after:bg-gray-400 after:left-0 after:w-full" data-block="'.$args['id'].'">',
            'after' => '</div>',
            'wrap' => [],
        ])
            ->map(function ($value, $key) {
                if (! isset($this->blockArguments[$key])) {
                    return $value;
                }

                if (isset($this->blockArguments[$key]['prepend'])) {
                    return "{$this->blockArguments[$key]['prepend']} {$value}";
                }

                if (isset($this->blockArguments[$key]['append'])) {
                    return "{$value} {$this->blockArguments[$key]['append']}";
                }

                if (isset($this->blockArguments[$key]['wrap'])) {
                    return "{$this->blockArguments[$key]['wrap']['before']} {$value} {$this->blockArguments[$key]['wrap']['after']}";
                }

                return $this->blockArguments[$key];
            })->toArray();

        return "{$args['before']}{$args['blockHtml']}{$args['after']}";
    }

    public function dropPlaceholderHtml()
    {
        return '<div drop-placeholder class="tw-editor-h-full tw-editor-min-h-[200px] tw-editor-text-gray-600 tw-editor-text-lg tw-editor-flex tw-editor-items-center tw-editor-justify-center"><p>'.__('Drop your block here...').'</p></div>';
    }

    public function createBaseView($attributes)
    {
        if (view()->exists($this->base)) {
            return view($this->base, $attributes)->render();
        }

        return Blade::render($this->base, $attributes);
    }
}
