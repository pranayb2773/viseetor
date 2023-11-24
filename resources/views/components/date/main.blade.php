@props([
    'align' => 'right',
])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'top-0 left-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'top-0 right-0';
            break;
    }
@endphp

<div wire:ignore x-data="{
      datePickerOpen: false,
      datePickerValue: @entangle($attributes->wire('model')),
      datePickerFormat: 'MMMM D, YYYY',
      datePickerMonth: '',
      datePickerYear: '',
      datePickerDay: '',
      datePickerDaysInMonth: [],
      datePickerBlankDaysInMonth: [],
      datePickerMonthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datePickerDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      datePickerDayClicked(day) {
        let selectedDate = new Date(this.datePickerYear, this.datePickerMonth, day);
        this.datePickerDay = day;
        this.datePickerValue = dayjs(selectedDate).format(this.datePickerFormat);
        this.datePickerIsSelectedDate(day);
        this.datePickerOpen = false;
        this.$watch('datePickerValue', () => this.datePickerValue)
      },
      datePickerMonthClicked() {
        this.datePickerCalculateDays();
      },
      datePickerYearClicked() {
        this.datePickerCalculateDays();
      },
      datePickerPreviousMonth(){
        if (this.datePickerMonth == 0) {
            this.datePickerYear--;
            this.datePickerMonth = 12;
        }
        this.datePickerMonth--;
        this.datePickerCalculateDays();
      },
      datePickerNextMonth(){
        if (this.datePickerMonth == 11) {
            this.datePickerMonth = 0;
            this.datePickerYear++;
        } else {
            this.datePickerMonth++;
        }
        this.datePickerCalculateDays();
      },
      datePickerIsSelectedDate(day) {
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return this.datePickerValue === dayjs(d).format(this.datePickerFormat) ? true : false;
      },
      datePickerIsToday(day) {
        const today = new Date();
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return today.toDateString() === d.toDateString() ? true : false;
      },
      datePickerCalculateDays() {
        let daysInMonth = new Date(this.datePickerYear, this.datePickerMonth + 1, 0).getDate();
        // find where to start calendar day of week
        let dayOfWeek = new Date(this.datePickerYear, this.datePickerMonth).getDay();
        let blankdaysArray = [];
        for (var i = 1; i <= dayOfWeek; i++) {
            blankdaysArray.push(i);
        }
        let daysArray = [];
        for (var i = 1; i <= daysInMonth; i++) {
            daysArray.push(i);
        }
        this.datePickerBlankDaysInMonth = blankdaysArray;
        this.datePickerDaysInMonth = daysArray;
      },
      datePickerTodayClicked() {
        currentDate = dayjs();

        this.datePickerMonth = currentDate.month();
        this.datePickerYear = currentDate.year();
        this.datePickerDay = currentDate.date();

        this.datePickerValue = dayjs().format(this.datePickerFormat);
        this.datePickerCalculateDays();

        this.datePickerOpen = false;
        this.$watch('datePickerValue', () => this.datePickerValue)
      },
      datePickerClearClicked() {
        currentDate = dayjs();
        this.datePickerValue = '';
        this.datePickerMonth = currentDate.month();
        this.datePickerYear = currentDate.year();
        this.datePickerDay = currentDate.date();

        this.datePickerCalculateDays();

        this.datePickerOpen = false;
        this.$watch('datePickerValue', () => this.datePickerValue)
      },
    }" x-init="
        currentDate = dayjs();
        if (datePickerValue) {
            currentDate = dayjs(datePickerValue, datePickerFormat);
        }
        datePickerMonth = currentDate.month();
        datePickerYear = currentDate.year();
        datePickerDay = currentDate.date();

        datePickerCalculateDays();
    " x-cloak>
    <div class="relative group">
        <x-input.text
            x-ref="datePickerInput"
            x-model="datePickerValue"
            type="text" @click="datePickerOpen=!datePickerOpen"
            x-on:keydown.escape="datePickerOpen=false"
            class="flex w-full mt-1 text-sm group"
            placeholder="Select date" readonly
        />
        <div @click="datePickerOpen=!datePickerOpen; if(datePickerOpen){ $refs.datePickerInput.focus() }"
             class="absolute top-0 right-0 px-3 py-2 cursor-pointer">
            <svg class="w-6 h-6 text-gray-400 group-focus-within:text-primary-500" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <div
            x-show="datePickerOpen"
            x-transition
            @click.away="datePickerOpen = false"
            class="absolute {{ $alignmentClasses }} z-50 max-w-lg p-4 mt-12 antialiased bg-white border rounded-lg shadow w-[17rem] border-gray-300 dark:bg-gray-700 dark:border-gray-600"
        >
            <div class="flex items-center justify-between mb-3">
                <select
                    x-model="datePickerMonth" @change="datePickerMonthClicked"
                    class="text-lg font-bold text-gray-800 dark:text-gray-200 dark:bg-gray-700 border-0 cursor-pointer grow outline-none px-1 py-0 focus:ring-0"
                    aria-label="month" tabindex="-1"
                >
                    <template x-for="(month, monthIndex) in datePickerMonthNames" :key="monthIndex">
                        <option
                            x-text="month"
                            x-bind:value="monthIndex"
                        ></option>
                    </template>
                </select>
                <input
                    type="number" inputmode="numeric"
                    x-model="datePickerYear" @change="datePickerYearClicked"
                    min="1000" max="100000"
                    class="w-20 p-0 text-lg font-bold text-gray-800 dark:text-gray-200 dark:bg-gray-700 text-end border-0 outline-none focus:ring-0"
                    aria-label="year" tabindex="-1"
                >
            </div>
            <div class="grid grid-cols-7 mb-3">
                <template x-for="(day, index) in datePickerDays" :key="index">
                    <div class="px-0.5">
                        <div x-text="day"
                             class="text-xs font-medium text-center text-gray-800 dark:text-gray-300"></div>
                    </div>
                </template>
            </div>
            <div class="grid grid-cols-7 mb-3">
                <template x-for="blankDay in datePickerBlankDaysInMonth">
                    <div class="p-1 text-sm text-center border border-transparent"></div>
                </template>
                <template x-for="(day, dayIndex) in datePickerDaysInMonth" :key="dayIndex">
                    <div class="px-0.5 mb-1 aspect-square">
                        <div
                            x-text="day"
                            @click="datePickerDayClicked(day)"
                            :class="{
                                        'bg-primary-100 dark:text-gray-700': datePickerIsToday(day) == true,
                                        'text-gray-600 hover:bg-primary-300 dark:hover:text-gray-700': datePickerIsToday(day) == false && datePickerIsSelectedDate(day) == false,
                                        'bg-primary-600 text-white hover:bg-opacity-75': datePickerIsSelectedDate(day) == true
                                    }"
                            class="flex items-center justify-center text-sm leading-none text-center rounded-full cursor-pointer h-7 w-7 dark:text-gray-300"></div>
                    </div>
                </template>
            </div>
            <div class="flex items-center justify-between px-1">
                <div>
                    <button
                        type="button"
                        @click="datePickerClearClicked()"
                        class="inline-flex items-center justify-center gap-0.5 font-medium outline-none hover:underline focus:underline text-sm text-danger-600 hover:text-danger-500 dark:text-danger-500 dark:hover:text-danger-400"
                        aria-label="clear date" tabindex="-1"
                    >Clear
                    </button>
                </div>
                <div>
                    <button
                        type="button"
                        @click="datePickerTodayClicked()"
                        class="inline-flex items-center justify-center gap-0.5 font-medium outline-none hover:underline focus:underline text-sm text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400"
                        aria-label="today" tabindex="-1"
                    >Today
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
