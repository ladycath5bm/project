<nav class="bg-white shadow-lg" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button x-on:click="open = true" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false">
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg> 
          <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
        <!--logotipo-->
        <a href="{{ route('products.index') }}" class="flex-shrink-0 flex items-center">    
          <!--<img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">-->
        
          <img class="hidden lg:block h-10 w-auto" src="{{ Storage::url('logo_home.jpg') }}" alt="">
        </a>
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-gray-900", Default: "text-orange-500     hover:scale-110" -->
            <!--<a href="#" class="bg-gray-900 text-gray-900 px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Dashboard</a>-->
            
            
            <a href="{{ route('welcome') }}" class="lg:text-md text-gray-400 hover:text-orange-500 hover:scale-110 px-3 py-2 rounded-md font-medium text-md">Home</a>
            <a href="{{ route('products.index') }}" class="lg:text-md text-gray-400 hover:text-orange-500 hover:scale-110 px-3 py-2 rounded-md font-medium text-md">Products</a>
            <a href="#" class="lg:text-md text-gray-400 hover:text-orange-500  hover:scale-110 px-3 py-2 rounded-md font-medium text-md">About Us</a>
            <a href="#" class="lg:text-md text-gray-400 hover:text-orange-500   hover:scale-110 px-3 py-2 rounded-md font-medium text-md">Contact Us</a>
            
            
          </div>
        </div>
      </div>
      @auth
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            <!--<button type="button" class="bg-gray-900 p-1 rounded-full text-gray-400 hover:text-orange-500   hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-white">
            <span class="sr-only"></span>-->
            <!-- Heroicon name: outline/bell -->
            <!--<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            </button>-->

            <div id="app"> 
                <div>
                    <div class="flex bg-white justify-items-center">
                        <a class="bg-white flex text:sm rounded-md px-2" href="{{ route('cart.index') }}">
                            <span class="bg-white border border-orange-500 rounded-full flex items-center px-1 text-sm text-orange-700 font-bold">
                                <Cart msg={{ Cart::count() }} />
                            </span> 
                            <span class="material-icons-sharp text-gray-400 hover:text-orange-500 text:sm">add_shopping_cart</span> 
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile dropdown -->
            <div class="ml-3 relative" x-data="{ open: false }">
            <div>
                <button x-on:click="open = true" type="button" class="flex text-sm rounded-full bg-orange-200 text-white focus:outline-none ring-1 ring-orange-400 ring-offset-2 ring-offset-orange-300 focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-orange-300" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only"></span>
                  <img class="h-8 w-8 rounded-full bg-orange-200" src="{{ auth()->user()->profile_photo_url }}" alt="">
                </button>
            </div>

            <div x-show="open" x-on:click.away=" open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-400" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-400" role="menuitem" tabindex="-1" id="user-menu-item-0">Your purchases</a>
                @can('admin.home')
                  <a href="{{ url('admin') }}" class="block px-4 py-2 text-sm text-gray-400" role="menuitem" tabindex="-1" id="user-menu-item-0">Dashboard</a>          
                @endcan
        
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-400" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault(); 
                        this.closest('form').submit();">
                    Sign out
                </a>
                
                </form>
                    
            </div>
            </div>
        </div>  
      @else
        <div>
            <a href="{{ route('login') }}" class="text-gray-900 lg:text-md     hover:scale-110 px-3 py-2 rounded-md text-sm font-medium">Login</a>
            <a href="{{ route('register') }}" class="text-gray-900 lg:text-md     hover:scale-110 px-3 py-2 rounded-md text-sm font-medium">Register</a>
        </div>
      @endauth
        
    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  
  <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away="open = false">
    
    <div class="px-2 pt-2 pb-2 text-orange-600 space-y-1 flex">
      <a href="{{ route('products.index') }}" class="flex-shrink-0 flex items-center">    
        <!--<img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">-->
      
        <img class="lg:block h-10 w-auto" src="{{ Storage::url('logo_home.jpg') }}" alt="">
      </a>
      <!-- Current: "bg-gray-900 text-gray-900", Default: "text-orange-500     hover:scale-110" -->
      <!--<a href="#" class="bg-gray-900 text-gray-900 block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Dashboard</a>-->
      <a href="{{ route('welcome') }}" class="lg:text-md text-gray-400 hover:text-orange-500     hover:scale-110 px-3 py-2 rounded-md text-md font-medium">Home</a>
      <a href="{{ route('products.index') }}" class="lg:text-md text-gray-400 hover:text-orange-500 hover:scale-110 px-3 py-2 rounded-md text-md font-medium">Products</a>
      <a href="#" class="lg:text-md text-gray-400 hover:text-orange-500  hover:scale-110 px-3 py-2 rounded-md text-md font-medium">About Us</a>
      <a href="#" class="lg:text-md text-gray-400 hover:text-orange-500     hover:scale-110 px-3 py-2 rounded-md text-md font-medium">Contact Us</a>
      
    </div>

  </div>
</nav>