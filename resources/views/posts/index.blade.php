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
                            href="{{ route('posts.create') }}">
                        Create post
                    </a>

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Title</span>
                                </th>
                                <th class="px-6 py-3 w-1 bg-gray-50">
                                    <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase"></span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($posts as $post)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a href="{{ route('posts.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
                                    </td>
                                    <td class="flex px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                        <a
                                                class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                                                href="{{ route('posts.edit', $post) }}">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
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

                    {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
