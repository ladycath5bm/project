<x-app-layout>
    <h1>prueba index categorias de productos</h1>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
    @endforeach
</x-app-layout>