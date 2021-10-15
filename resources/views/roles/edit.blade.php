<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-validation-errors class="mb-4" :errors="$errors"/>

                    <x-alert.success></x-alert.success>

                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="name" :value="__('Name')"/>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                     :value="old('name', $role->name)" />
                        </div>

                        <div class="block font-medium text-sm text-gray-700 mt-4">Permissions</div>

                        <div class="flex items-center mt-2">
                            @foreach($permissions as $id => $permission)
                                <x-checkbox id="permissions[]" value="{{ $id }}" class="block ml-2" name="permissions[]" :checked="in_array($id, old('permissions', [])) || $role->permissions->contains($id)" />

                                <x-label for="permissions" class="mr-4 ml-1" :value="$permission"/>
                            @endforeach
                        </div>

                        <x-button class="mt-4">
                            {{ __('Submit') }}
                        </x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
