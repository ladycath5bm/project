<div class="card min-h-screen flex bg-gray-100 py-4 px-4 shadow rounded-md mt-2">
  <div class="flex flex-col w-40 bg-white rounded-2xl overflow-hidden ">
      <div class="flex items-center justify-center h-14 shadow-md">
        <h1 class="text-xl text-gray-800 justify-center">Category</h1>
      </div>
      <ul class="flex flex-col py-2 shadow-sm">
          @foreach ($categories as $category)
          <li>
            <a href="{{ route('products.showbycategory', $category) }}" class="flex flex-row h-12 transform hover:translate-x-2 transition-transform ease-in duration-20 0 text-gray-500 hover:text-gray-800">
              <!--<span class="inline-flex h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>-->
              <span class="text-md text-gray-800 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 px-4 py-2 focus:ring-inset focus:ring-white font-medium">{{ $category->name }}</span>
            </a>
          </li>
          @endforeach
        
      </ul>
  </div>
</div>

