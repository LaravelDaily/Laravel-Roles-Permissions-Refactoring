<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <a
                            class="inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                            href="{{ route('roles.create') }}">
                        Create role
                    </a>

                    <x-validation-errors class="mb-4"></x-validation-errors>

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Permissions</span>
                                </th>
                                <th class="px-6 py-3 w-1 bg-gray-50">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"></span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($roles as $role)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        {{ $role->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        @foreach($role->permissions as $permission)
                                            <span class="px-2 py-1 text-xs text-green-600 bg-green-100 rounded-3xl">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="flex px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a
                                                class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                                                href="{{ route('roles.edit', $role) }}">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('roles.destroy', $role) }}"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-button class="flex-inline">
                                                Delete
                                            </x-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
