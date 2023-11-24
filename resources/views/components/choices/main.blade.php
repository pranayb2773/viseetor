@props([
    'options' => [],
    'multiple' => false,
    'placeholder' => 'Select an option'
])

<div
    x-data="{
        multiple: {{ $multiple }},
        value: @entangle($attributes->wire('model')),
        options: {{ json_encode($options) }},
        init() {
            this.$nextTick(() => {
                let config = this.multiple ? {
                    removeItems: true,
                    removeItemButton: true,
                    duplicateItemsAllowed: false,
                    allowHTML: false,
                    placeholderValue:  '{{ $placeholder }}',
                    searchEnabled: true,
                    classNames: {
                        containerOuter: 'choices',
                        containerInner: 'choices__inner',
                        input: 'choices__input',
                        inputCloned: 'choices__input--cloned',
                        list: 'choices__list',
                        listItems: 'choices__list--multiple',
                        listSingle: 'choices__list--single',
                        listDropdown: 'choices__list--dropdown',
                        item: 'choices__item',
                        itemSelectable: 'choices__item--selectable',
                        itemDisabled: 'choices__item--disabled',
                        itemChoice: 'choices__item--choice',
                        placeholder: 'choices__placeholder',
                        group: 'choices__group',
                        groupHeading: 'choices__heading',
                        button: 'choices__button',
                        activeState: 'is-active',
                        focusState: 'is-focused',
                        openState: 'is-open',
                        disabledState: 'is-disabled',
                        highlightedState: 'is-highlight',
                        selectedState: 'is-selected',
                        flippedState: 'is-flipped',
                        loadingState: 'is-loading',
                        noResults: 'has-no-results',
                        noChoices: 'has-no-choices'
                    }
                } : {
                    allowHTML: false,
                };

                let choices = new Choices(this.$refs.select, config)

                let refreshChoices = () => {
                    console.log('selected', this.value);
                    let selection = this.multiple ? this.value : [this.value]
                    console.log(selection);

                    choices.clearStore()
                    choices.setChoices(this.options.map(({ value, label }) => ({
                        value,
                        label,
                        selected: selection.includes(value),
                    })))
                }

                this.$refs.select.addEventListener('change', () => {
                    console.log('before', this.value);
                    this.value = choices.getValue(true)
                    console.log('after', this.value);
                })

                this.$watch('value', () => refreshChoices())
                this.$watch('options', () => refreshChoices())
                refreshChoices()
            })
        }
    }"
    class="max-w-sm w-full mt-1 text-sm rounded-md shadow-sm border dark:bg-secondary-900 dark:text-secondary-300 border-secondary-300 dark:border-secondary-700 focus-within:border-primary-500 dark:focus-within:border-primary-600 focus-within:ring-1 focus-within:ring-primary-500 dark:focus-within:ring-primary-600
    "
>
    <select
        :multiple="multiple"
        x-ref="select"
    ></select>
</div>
