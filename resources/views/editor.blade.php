<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset

        <div
            x-cloak
            x-data="dropblockeditor()"
            class="tw-editor-dropblockeditor tw-editor-flex tw-editor-flex-col tw-editor-min-h-screen tw-editor-bg-gray-100">
            <div class="{{ config('dropblockeditor.brand.colors.topbar_bg', 'tw-editor-bg-white') }} tw-editor-px-5 tw-editor-py-5 tw-editor-border-b tw-editor-text-white tw-editor-flex tw-editor-justify-between tw-editor-flex-initial">
                <div class="tw-editor-flex tw-editor-items-center">
                    @if($logo = config('dropblockeditor.brand.logo', false))
                        <div class="tw-editor-mr-2">{!! $logo !!}</div>
                    @endif
                    <div>
                        {{ $title ?? __('No title') }}
                    </div>
                </div>
                <div class="tw-editor-flex tw-editor-items-center tw-editor-gap-2">
                    <div class="tw-editor-flex tw-editor-gap-2 tw-editor-mx-4">
                        <button wire:click="undo" @disabled(!$this->canUndo()) class="{{ $this->canUndo() ? '' : 'tw-editor-opacity-25' }}" aria-label="Undo change">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-5 tw-editor-h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                            </svg>
                        </button>
                        <button wire:click="redo" @disabled(!$this->canRedo()) class="{{ $this->canRedo() ? '' : 'tw-editor-opacity-25' }}" aria-label="Redo change">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-5 tw-editor-h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </button>
                    </div>
                    @foreach($buttons as $i => $button)
                        @livewire($button, ['properties' => $this->updateProperties()], key('button-' . $i))
                    @endforeach
                </div>
            </div>

            <div class="tw-editor-flex tw-editor-flex-initial tw-editor-h-full tw-editor-grow">

                <div class="tw-editor-relative tw-editor-flex-1 tw-editor-flex tw-editor-justify-center">
                    <iframe id="frame" srcdoc="{{ $result }}" class="tw-editor-h-full" :class="device === 'mobile' ? 'tw-editor-w-[320px]' : device === 'tablet' ? 'tw-editor-w-[768px]' : 'tw-editor-w-full'"></iframe>
                    <div class="tw-editor-absolute tw-editor-right-4 tw-editor-top-4 tw-editor-flex tw-editor-items-center tw-editor-bg-white tw-editor-rounded-md tw-editor-border tw-editor-shadow-sm">
                        <button x-on:click="device = 'mobile'" class="tw-editor-p-2 tw-editor-border-r" :class="device === 'mobile' ? 'tw-editor-text-gray-800' : 'tw-editor-text-gray-300'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-5 tw-editor-h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                        </button>

                        <button x-on:click="device = 'tablet'" class="tw-editor-p-2 tw-editor-border-r" :class="device === 'tablet' ? 'tw-editor-text-gray-800' : 'tw-editor-text-gray-300'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-5 tw-editor-h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 002.25-2.25v-15a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 4.5v15a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </button>

                        <button x-on:click="device = 'desktop'" class="tw-editor-p-2" :class="device === 'desktop' ? 'tw-editor-text-gray-800' : 'tw-editor-text-gray-300'">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-5 tw-editor-h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                            </svg>
                        </button>
                    </div>
                    <div wire:loading class="tw-editor-absolute tw-editor-right-5 tw-editor-bottom-5">
                        <svg class="tw-editor-animate-spin tw-editor-h-6 tw-editor-w-6 tw-editor-text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="tw-editor-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="tw-editor-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>

                <aside class="tw-editor-w-[400px] tw-editor-shrink-0 tw-editor-shadow-lg tw-editor-relative tw-editor-bg-white">
                    <div
                        drop-list
                        x-cloak
                        x-show="! $wire.activeBlockIndex"
                        class="tw-editor-flex tw-editor-flex-col tw-editor-pb-4">
                        @php
                            $blockGroups = collect($blocks)->map(function($block, $i) {
                                return [
                                    'original_index' => $i,
                                    'block' => $this->getBlockFromClassName($block['class']),
                                ];
                            })->groupBy(function($item) {
                                return $item['block']->getCategory();
                            })->sortBy(function($item, $key) {
                                return $key;
                            })->toArray();
                        @endphp

                        @foreach($blockGroups as $category => $categoryBlocks)
                            <div class="tw-editor-px-4 tw-editor-pt-4">
                                @if($category)
                                    <h2 class="tw-editor-mb-2 tw-editor-font-medium">{{ $category }}</h2>
                                @endif
                                <div class="tw-editor-grid tw-editor-grid-cols-3 tw-editor-gap-4">
                                    @foreach($categoryBlocks as $groupedBlock)
                                        @php
                                            $i = $groupedBlock['original_index'];
                                            $block = $groupedBlock['block'];
                                        @endphp

                                        <div drag-item draggable="true" data-block="{{ $i }}" class="tw-editor-shadow-sm tw-editor-mb-2 tw-editor-text-center tw-editor-bg-white tw-editor-border tw-editor-border-gray-100 tw-editor-rounded-lg tw-editor-px-3 tw-editor-py-2 tw-editor-flex tw-editor-flex-col tw-editor-justify-center tw-editor-items-center tw-editor-cursor-grab tw-editor-active:cursor-grabbing tw-editor-hover:border-gray-200">
                                            @if($block->getIcon())
                                                <div class="tw-editor-opacity-50 tw-editor-mb-1">{!! $block->getIcon() !!}</div>
                                            @endif

                                            <span class="tw-editor-text-sm">{{ $block->getTitle() }}</span>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-opacity-25 tw-editor-w-4 tw-editor-h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($activeBlock)
                        <div class="tw-editor-border-b tw-editor-mb-4">
                            <div class="tw-editor-border-b tw-editor-bg-white tw-editor-flex tw-editor-justify-between tw-editor-items-center">
                                <div class="tw-editor-flex tw-editor-items-center">
                                    <button wire:click="$set('activeBlockIndex', false)" class="tw-editor-p-4 tw-editor-text-gray-500 hover:tw-editor-text-gray-800 tw-editor-border-r">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-6 tw-editor-h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </button>
                                    <div class="tw-editor-p-4">
                                        <h2 class="tw-editor-font-medium tw-editor-flex tw-editor-items-center">
                                            {{ $activeBlock->title }}
                                        </h2>
                                    </div>
                                </div>
                                <div class="tw-editor-flex tw-editor-items-center">
                                    <button wire:click="cloneBlock" aria-label="Clone" class="tw-editor-p-4 tw-editor-text-gray-500 hover:tw-editor-text-gray-800 tw-editor-border-l">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-6 tw-editor-h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                        </svg>
                                    </button>
                                    <button wire:click="deleteBlock" aria-label="Delete" class="tw-editor-p-4 tw-editor-text-gray-500 hover:tw-editor-text-gray-800 tw-editor-border-l">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="tw-editor-w-6 tw-editor-h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="tw-editor-p-4">
                                @if(!empty($activeBlock->blockEditComponent))
                                    <div class="tw-editor-mb-4">
                                        @livewire($activeBlock->blockEditComponent, [
                                        'position' => $activeBlockIndex,
                                        'block' => $activeBlock->toArray(),
                                        ], key($this->prepareActiveBlockKey($activeBlockIndex)))
                                    </div>
                                @else
                                    {{ __('This block is not editable.') }}
                                @endif
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
</div>
