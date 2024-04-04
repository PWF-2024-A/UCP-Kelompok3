<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('task.store') }}">
                        @csrf
                        @method('post')

                        <div class="mb-6">
                            <x-input-label for="name" value="{{ 'Name' }}" />
                            <x-input id="name" name="name" type="text" class="block w-full mt-1 required"
                                     autofocus autocomplete="name"/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            <a href="{{ route('task.index') }}"
                               class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest
                                      text-gray-700 uppercase transition duration-150 ease-in-out
                                      bg-white border border-gray rounded-md shadow-sm dark:bg-gray800
                                      dark:border-gray500 dark:text-gray300 hover:bggray50
                                      dark:hover:bggray700 focus:outline-none focus:ring2
                                      focus:ring-indigo500 focus:ring-offset2
                                      dark:focus:ring-offsetgray800 disabled:opacity25">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
