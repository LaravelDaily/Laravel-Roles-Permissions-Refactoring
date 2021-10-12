@props(['checked' => false])

<input
        type="checkbox"
        {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}
        {{ $checked ? 'checked' : '' }}
        {{ $attributes }}
/>
