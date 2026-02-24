@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'bg-white border-gray-200 text-[#1A1A1A] placeholder-gray-400 focus:border-[#1A1A1A] focus:ring-1 focus:ring-[#1A1A1A] rounded-2xl shadow-sm transition-colors'
]) }}>
