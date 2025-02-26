@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">{{ $post->name }}</h1>
    
    <p class="text-lg text-gray-700">Département: {{ $post->department->name }}</p>

    <div class="mt-6">
        <a href="{{ route('posts.index') }}" class="text-indigo-600 hover:text-indigo-900">Retour à la liste des Posts</a>
    </div>
</div>
@endsection
