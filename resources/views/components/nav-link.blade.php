@props(['active' => false])
<a {{$attributes}} class="{{$active ? ' border-b-yellow-700 border-b-2 font-bold':' hover:border-b-yellow-800 hover:border-b-2  font-bold'}}"
    aria-current="{{$active ? 'page':'false'}}">
    {{$slot}}
</a>
