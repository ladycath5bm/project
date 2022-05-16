<x-app-layout>
    <div class="mx-8"> 
        <div class="flex items-center justify-center mt-4">
            <span class="flex justify-center font-bold text-orange-600 text-3xl">Notifications</span>
        </div>
        <div class="bg-white rounded-lg dhadow-sm p-6  text-center flex flex-col gap-5 mt-4  mx-10">
            <table>
                <thead class="bg-gray-200 rounded-md">
                    <tr>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">#</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Content</th>
                        <th class="px-6 py-2 text-md text-gray-700" scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $notification)
                    <tr>
                        <td class="px-6 py-3 text-gray-600 text-sm">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-gray-600 text-md">
                            @if ($notification->type === "App\Notifications\NewOrderGenerated")
                                <a href="{{ $notification->data['route'] }}" class="text-md hover:text-orange-600">
                                    @lang('notifications.order', ['reference' => $notification->data['reference']])
                                </a>
                            @elseif ($notification->type === "App\Notifications\ExportGenerated")
                                <a href="{{ $notification->data['route'] }}" class="text-md hover:text-orange-600">
                                    @lang('notifications.export', ['export' => $notification->data['name']])
                                </a>
                            @else
                                <a href="{{ $notification->data['route'] }}" class="text-md hover:text-orange-600">
                                    @lang('notifications.import', ['import' => $notification->data['name']])
                                </a>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-gray-600 text-md">
                            @if($notification->read_at === null)
                                <a href="{{ route('notifications.read', ['notification' => $notification->id]) }}" class="text-xs text-orange-600 hover:text-blue-800">Mark as read</a>    
                            @else
                                <span class="text-xs text-gray-900">Readed</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <span>Notifications empty</span>
                    @endforelse
                   
                </tbody>
            </table>
            
        </div>
        <div class="bg-gray-50 rounded-lg dhadow-sm px-6 mt-1 mx-10 flex">
            <a href="{{ route('notifications.readall') }}" class="btn px-6 py-2 bg-orange-600 text-sm font-bold text-white hover:bg-orange-700 mt-2 mb-2 rounded-md">
                Mark all as read
            </a>
        </div>
    </div>
</x-app-layout>