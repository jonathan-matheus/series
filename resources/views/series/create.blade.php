<x-layout title="Nova Série">
    <x-form action="{{ route('series.store') }}" :nome="old('nome')" :update="false" />
</x-layout>