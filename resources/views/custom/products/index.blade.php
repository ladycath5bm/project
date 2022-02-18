<x-app-layout>
    <div class="card">
        <div class="card-body">
            @livewire('custom-products-index', ['products' => $products])
        </div>
    </div>
</x-app-layout>