<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-validation-errors class="mb-4" :errors="$errors"/>

                    <x-alert.success></x-alert.success>

                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf

                        <div>
                            <x-label for="title" :value="__('Title')"/>

                            <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                     :value="old('title')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="post_text" :value="__('Post text')"/>

                            <textarea
                                    rows="10"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    id="post_text"
                                    name="post_text">{{ old('post_text') }}</textarea>
                        </div>

                        @can('publish')
                            <div class="flex mt-4">
                                <x-label for="is_published" :value="__('Is published')"/>

                                <x-checkbox id="is_published" value="1" class="block ml-2" name="is_published" :checked="old('is_published')" />
                            </div>
                        @endcan

                        <x-button class="mt-4">
                            {{ __('Submit') }}
                        </x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
