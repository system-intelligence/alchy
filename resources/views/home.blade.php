

<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        @foreach ($alchy as $alchy)
            <div class="card bg-base-100 shadow mt-6">
                <div class="card-body">
                    <div>
                        <div class="font-semibold">{{ $alchy['author'] }}</div>
                        <div class="mt-1">{{ $alchy['message'] }}</div>
                        <div class="text-sm text-gray-500 mt-2">{{ $alchy['time'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>