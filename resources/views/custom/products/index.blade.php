<x-app-layout>
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 py-8 mx-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-2 mx-4">
            @foreach ($products as $product)
                <article class="w-full h-80 bg-cover rounded bg-center 
                    @if($loop->first) 
                        md: col-span-2 
                    @endif" 
                    style="background-image: url({{ Storage::url($product->imageable()->url) }})">

                    <div class="w-full h-full px-6 flex flex-col justify-center mt-10">

                        <h1 class="text-3xl text-white leading-8 font-bold">
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </h1>
                    </div>
                    
                    <span></span>
                </article>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>