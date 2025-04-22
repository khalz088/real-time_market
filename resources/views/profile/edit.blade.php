<x-app-layout>
    @if (session('status') === 'profile-updated')

            <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible" class="pointer-events-auto relative rounded-sm border border-green-500 bg-white text-neutral-600 dark:bg-neutral-950 dark:text-neutral-300" role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)" x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)" x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id)}, displayDuration))" x-transition:enter="transition duration-300 ease-out" x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8" x-transition:leave="transition duration-300 ease-in" x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24" x-transition:leave-start="translate-x-0 opacity-100">
                <div class="flex w-full items-center gap-2.5 bg-green-500/10 rounded-sm p-4 transition-all duration-300">

                    <!-- Icon -->
                    <div class="rounded-full bg-green-500/15 p-0.5 text-green-500" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Title & Message -->
                    <div class="flex flex-col gap-2">
                        <h3  class="text-sm font-semibold text-green-500" >Success!</h3>
                        <p   class="text-pretty text-sm" >Your changes have been saved.</p>
                    </div>

                    <!--Dismiss Button -->
                    <button type="button" class="ml-auto" aria-label="dismiss notification" x-on:click="(isVisible = false), removeNotification(notification.id)">
                        <svg xmlns="http://www.w3.org/2000/svg viewBox="0 0 24 24 stroke="currentColor" fill="none" stroke-width="2" class="size-5 shrink-0" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            @elseif(session('status') === 'password-updated')
            <div x-data="{ isVisible: false, timeout: null }" x-cloak x-show="isVisible" class="pointer-events-auto relative rounded-sm border border-green-500 bg-white text-neutral-600 dark:bg-neutral-950 dark:text-neutral-300" role="alert" x-on:pause-auto-dismiss.window="clearTimeout(timeout)" x-on:resume-auto-dismiss.window=" timeout = setTimeout(() => {(isVisible = false), removeNotification(notification.id) }, displayDuration)" x-init="$nextTick(() => { isVisible = true }), (timeout = setTimeout(() => { isVisible = false, removeNotification(notification.id)}, displayDuration))" x-transition:enter="transition duration-300 ease-out" x-transition:enter-end="translate-y-0" x-transition:enter-start="translate-y-8" x-transition:leave="transition duration-300 ease-in" x-transition:leave-end="-translate-x-24 opacity-0 md:translate-x-24" x-transition:leave-start="translate-x-0 opacity-100">
                <div class="flex w-full items-center gap-2.5 bg-green-500/10 rounded-sm p-4 transition-all duration-300">

                    <!-- Icon -->
                    <div class="rounded-full bg-green-500/15 p-0.5 text-green-500" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Title & Message -->
                    <div class="flex flex-col gap-2">
                        <h3  class="text-sm font-semibold text-green-500" >Success!</h3>
                        <p   class="text-pretty text-sm" >Your changes have been saved.</p>
                    </div>

                    <!--Dismiss Button -->
                    <button type="button" class="ml-auto" aria-label="dismiss notification" x-on:click="(isVisible = false), removeNotification(notification.id)">
                        <svg xmlns="http://www.w3.org/2000/svg viewBox="0 0 24 24 stroke="currentColor" fill="none" stroke-width="2" class="size-5 shrink-0" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-neutral-950 dark:border-white border border-neutral-950   rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form', ['status' => session('status')])

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-neutral-950 dark:border-white border border-neutral-950   rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form', ['status' => session('status')])
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-neutral-950 dark:border-white border border-neutral-950   rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
