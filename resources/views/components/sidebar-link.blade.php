{{-- resources/views/components/sidebar-link.blade.php --}}
<a href="{{ $href }}" class="{{ $active ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:bg-gray-100' }} block px-4 py-2 rounded-md">
    {{ $text }}
</a>
