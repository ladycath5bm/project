<div>
    <div class="min-h-screen flex flex-row bg-gray-100 py-4 mx-4">
        <div class="flex flex-col w-60 bg-white rounded-r-3xl overflow-hidden">
          <div class="flex items-center justify-center h-20 shadow-md">
            <h1 class="text-2xl text-gray-800 justify-center">Search by Category</h1>
          </div>
          <ul class="flex flex-col py-4">
              @foreach ($categories as $category)
              <li>
                <a href="#" class="flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-20 0 text-gray-500 hover:text-gray-800">
                  <span class="inline-flex items-center justify-center h-12 w-12 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                  <span class="text-sm font-medium">{{ $category->name }}</span>
                </a>
              </li>
              @endforeach
            
          </ul>
        </div>
      </div>
</div>
