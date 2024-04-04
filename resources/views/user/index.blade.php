<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
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

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="hidden px-6 py-3 md:block">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Todo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($todos as $todo )

                            <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <p>{{ $user->id }}</p>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    <p>{{ $user->name }}</p>
                                </td>
                                <td class="hidden px-6 py-4 md:block">
                                    <p>{{ $user->email }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p>
                                        {{ $user->todos->count() }}
                                        <span>
                                            <span class="text-green-600 dark:text-green-400">
                                               ({{ $user->todos->where('is_complete', true)->count() }}
                                            </span>/
                                            <span class="text-blue-600 dark:text-blue-400">
                                                {{ $user->todos->where('is_complete', false)->count() }})
                                            </span>
                                        </span>
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        {{-- action --}}
                                    </div>
                                </td>
                            </tr>
                            @empty

                            <tr class="bg-white dark:bg-gray-800">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    Empty
                                </td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($users->hasPages())
                <div class="p-6">
                    {{ $users->Links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
