@props([
    'options' => [],
    'multiple' => 'disable',
    'placeholder' => 'Select an option',
    'field' => '',
])
<div
    {!! $attributes->twMerge([
        'class' =>
            'w-full mt-1 text-sm rounded-md shadow-sm dark:bg-secondary-900 dark:text-secondary-300 border ' .
            ($errors->has($field)
                ? 'border-danger-400 dark:border-danger-700 focus-within:border-danger-500 dark:focus-within:border-danger-600 focus-within:ring-danger-500 dark:focus-within:ring-danger-600'
                : 'border-secondary-300 dark:border-secondary-700 focus-within:border-primary-500 dark:focus-within:border-primary-600 focus-within:ring-1 focus-within:ring-primary-500 dark:focus-within:ring-primary-600'),
    ]) !!}
>
    <div
        wire:ignore
        x-data="{
            multiple: '{{ $multiple }}' === 'enable' ? true : false,
            value: @entangle($attributes->wire('model')),
            options: {{ json_encode($options) }},
            placeholder: '{{ $placeholder }}',
            init() {
                this.$nextTick(() => {
                    let config = {
                        removeItems: true,
                        removeItemButton: true,
                        duplicateItemsAllowed: false,
                        allowHTML: false,
                        placeholder: true,
                        searchEnabled: true,
                        searchFields: ['label'],
                        searchPlaceholderValue: 'Start typing to search...',
                    };

                    let choices = new Choices(this.$refs.select, config)

                    let refreshChoices = () => {
                        let selection = this.multiple ? this.value : [this.value]

                        choices.clearStore()
                        choices.setChoices(this.options.map(({ value, label }) => ({
                            value,
                            label,
                            selected: selection.includes(value),
                        })))

                        refreshPlaceholder();
                    }

                    refreshPlaceholder = () => {
                        if (this.multiple) {
                            this.$el.querySelector(
                                '.choices__input--cloned',
                            ).placeholder = this.placeholder ?? '';

                            return;
                        }

                        choices._renderItems()

                        if (![null, undefined, ''].includes(this.value)) {
                            return
                        }

                        this.$el.querySelector(
                            '.choices__list--single',
                        ).innerHTML = `<div class='choices__placeholder choices__item'>${
                            this.placeholder ?? ''
                        }</div>`
                    },

                    this.$refs.select.addEventListener('change', () => {
                        this.value = choices.getValue(true)
                    })

                    this.$watch('value', () => refreshChoices())
                    this.$watch('options', () => refreshChoices())
                    refreshChoices()
                })
            }
        }"
    {{--    class="w-full mt-1 text-sm rounded-md shadow-sm dark:bg-secondary-900 dark:text-secondary-300 border border-secondary-300 dark:border-secondary-700 focus-within:border-primary-500 dark:focus-within:border-primary-600 focus-within:ring-1 focus-within:ring-primary-500 dark:focus-within:ring-primary-600"--}}
    >
        <select
            x-ref="select"
            {{ $multiple === 'enable' ? 'multiple' : '' }}
            {{ $attributes->whereDoesntStartWith('wire:model') }}></select>
    </div>
</div>

@error($field)
    <span class="text-xs text-danger-600">{{ $message }}</span>
@enderror
