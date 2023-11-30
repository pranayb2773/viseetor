<div>
    <div class="relative bg-white rounded-lg shadow dark:bg-secondary-800">
        <!-- Modal header -->
        <div>
            <div class="flex justify-between items-center py-4 px-6 dark:border-secondary-600">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">User Information</h3>
                    <p class="mt-1 max-w-2xl text-sm text-secondary-500 dark:text-secondary-300">Details about the ({{ $user->first_name . ' ' . $user->last_name }}) lender.</p>
                </div>
                <button type="button" wire:click="$dispatch('closeModal')" tabindex="-1"
                        class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-secondary-600 transition duration-150 ease-in-out hover:bg-secondary-50 hover:text-secondary-800 focus:outline-none focus:ring-2 focus:ring-secondary-500 focus:ring-offset-2 dark:focus:ring-offset-secondary-800">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Modal body -->
        <div class="max-h-[65vh] overflow-y-auto">
            <div class="border-t border-secondary-200 dark:border-secondary-700">
                <dl>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">First Name</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2">{{ $user->first_name }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">Last Name</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2 prose">{{ $user->last_name }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">Email</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2 prose">{{ $user->email }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">Roles</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2">
                            @forelse($user->roles as $role)
                                <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-md bg-secondary-50 dark:bg-secondary-600/40">
                                    {{ $role->name }}
                                </span>
                            @empty
                                None
                            @endforelse
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">Status</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2">{{ $user->status->label() }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">Created At</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2">{{ $user->created_at?->diffForHumans() }}</dd>
                    </div>
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-secondary-900 dark:text-secondary-200">Updated At</dt>
                        <dd class="mt-1 text-sm text-secondary-700 dark:text-white sm:mt-0 sm:col-span-2">{{ $user->updated_at?->diffForHumans() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        <!-- Modal Footer -->
        <div
            class="bg-secondary-50 dark:bg-secondary-800 px-4 py-3 sm:px-6 flex flex-col sm:flex-row items-center justify-between border-t dark:border-secondary-700 space-y-2">
            <x-button.danger type="button" wire:click="$dispatch('closeModal')" type="button" class="w-full sm:w-auto">Close</x-button.danger>
        </div>
    </div>
</div>
