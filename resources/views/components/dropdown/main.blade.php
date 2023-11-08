@props([
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'px-1 py-1 bg-white dark:bg-gray-800',
    'isFilter' => false,
    'divide' => false,
])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'origin-top-left left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'origin-top-right right-0';
            break;
    }

    switch ($width) {
        case '48':
            $width = 'w-48';
            break;
    }
@endphp

<div x-data="{
    open: false,
    toggle() {
        if (this.open) {
            return this.close()
        }

        this.open = true
    },
    close(focusAfter) {
        if (!this.open) return

        this.open = false

        focusAfter && focusAfter.focus()
    }
}" x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">
    <div x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')">
        {{ $trigger }}
    </div>

    <div x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="{{ $width }} {{ $alignmentClasses }} absolute z-50 mt-2 rounded-md shadow-lg"
        style="display: none;" :id="$id('dropdown-button')" x-on:click.outside="close($refs.button)"
        @if (!$isFilter) @click="close()" @endif>
        <div
            class="{{ $contentClasses }} @if ($divide) divide-y @endif rounded-md ring-1 ring-black/5 dark:ring-gray-700">
            {{ $content }}
        </div>
    </div>
</div>
