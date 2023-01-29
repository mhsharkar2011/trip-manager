@props(['src'])

<x-app-layout title="API Explorer">

    <iframe class="w-full h-full" src="/{{ $src }}" frameborder="0"></iframe>

</x-app-layout>