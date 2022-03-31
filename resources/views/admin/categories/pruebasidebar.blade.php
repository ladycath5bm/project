<div class="px-4 py-4 rounded bg-gray-100 ">
    <div class="flex flex-wrap justify-center bg-gray-900 rounded-md shadow-md mb-4">
        <div class="w-1/2">
          <span class="font-bold text-white ">
              <button class="font-bold text-white text-2xl h-12">Ecom</button>
          </span>
          
        </div>
    </div>
    <nav class="flex flex-col bg-white w-64 h-screen px-4 tex-gray-900 rounded-md shadow-md">
    
    <div class="mt-4 mb-2">
        <ul class="ml-4">
        @foreach ($categories as $category)
            <li class="mb-2 py-4 text-black flex flex-row  border-black hover:text-black   hover:bg-gray-100  hover:font-bold rounded  ">
                <span>
                <svg class="fill-current h-5 w-5 " viewBox="0 0 24 24">
                    <path
                    d="M16 20h4v-4h-4m0-2h4v-4h-4m-6-2h4V4h-4m6
                        4h4V4h-4m-6 10h4v-4h-4m-6 4h4v-4H4m0 10h4v-4H4m6
                        4h4v-4h-4M4 8h4V4H4v4z"
                    ></path>
                </svg>
                </span>
                <a href="{{ route('products.showbycategory', $category) }}">
                <span class="ml-2">{{ $category->name }}</span>
                </a>
            </li>
        @endforeach
    
        </ul>
    </div>
    </nav>

    </div>