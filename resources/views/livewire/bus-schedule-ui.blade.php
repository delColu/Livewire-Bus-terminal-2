<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-800/80 p-6 rounded-xl shadow-2xl mb-8">
        <h2 class="text-3xl font-extrabold text-yellow-400 mb-4">Bus Schedule Finder</h2>

        <!-- Search Input - Replaces Route, Day, and Date Filters -->
        <div class="mb-6">
            <label for="search" class="sr-only">Search Schedules</label>
            <input 
                wire:model.live="search" 
                id="search"
                type="text" 
                placeholder="Search by Bus No., Route, or Type..." 
                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-white shadow-lg focus:border-yellow-500 focus:ring-yellow-500 transition duration-150 ease-in-out p-3 placeholder-gray-400"
            >
        </div>
    </div>

    <!-- Schedule List Area -->
    <div class="mt-8">
        <div class="text-2xl font-semibold text-white mb-4">Available Schedules ({{ $schedules->count() }})</div>

        @if ($schedules->isEmpty())
            @php
                // --- STATIC SAMPLE DATA ---
                // Bus Types standardized to 'Air-conditioned' and 'Normal'.
                // 'fare_amount' added to simulate the price.
                $schedulesToDisplay = [
                    ['bus_number' => '1001', 'route_name' => 'Tagbilaran - Tubigon', 'departure_time' => '06:00', 'bus_type_name' => 'Air-conditioned', 'fare_amount' => 320.00],
                    ['bus_number' => '1002', 'route_name' => 'Tagbilaran - Carmen', 'departure_time' => '07:30', 'bus_type_name' => 'Normal', 'fare_amount' => 150.00],
                    ['bus_number' => '1003', 'route_name' => 'Tubigon - Ubay', 'departure_time' => '09:00', 'bus_type_name' => 'Air-conditioned', 'fare_amount' => 450.00],
                    ['bus_number' => '1004', 'route_name' => 'Tagbilaran - Tubigon', 'departure_time' => '11:45', 'bus_type_name' => 'Normal', 'fare_amount' => 190.00],
                ];
            @endphp

            <!-- Desktop/Tablet View (sm:block) - Static Data -->
            <div class="hidden sm:block">
                <div class="overflow-x-auto rounded-xl shadow-2xl">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Bus No.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Route</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Departure Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                {{-- Replaced 'Day' with 'Fare' --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fare (₱)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @foreach ($schedulesToDisplay as $schedule)
                                <tr class="opacity-75 hover:opacity-100 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">{{ $schedule['bus_number'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $schedule['route_name'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-white">{{ \Carbon\Carbon::parse($schedule['departure_time'])->format('h:i A') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{-- Standardized coloring for the two required types --}}
                                            @if($schedule['bus_type_name'] == 'Air-conditioned') bg-green-800 text-green-200 
                                            @else bg-blue-800 text-blue-200 @endif">
                                            {{ $schedule['bus_type_name'] }}
                                        </span>
                                    </td>
                                    {{-- Displaying the sample fare amount --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-yellow-400">₱{{ number_format($schedule['fare_amount'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile View (Default block, sm:hidden) - Static Card Layout -->
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @foreach ($schedulesToDisplay as $schedule)
                    <div class="bg-gray-800 p-4 rounded-xl shadow-lg border-l-4 border-yellow-400 opacity-75 hover:opacity-100 transition duration-150 ease-in-out">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-yellow-400">{{ $schedule['bus_number'] }}</h3>
                            <span class="text-2xl font-extrabold text-white">{{ \Carbon\Carbon::parse($schedule['departure_time'])->format('h:i A') }}</span>
                        </div>
                        <div class="text-sm text-gray-300 mb-2">{{ $schedule['route_name'] }}</div>
                        <div class="flex justify-between items-center text-xs">
                            {{-- Displaying the sample fare amount --}}
                            <span class="font-medium text-lg text-yellow-400">Fare: ₱{{ number_format($schedule['fare_amount'], 2) }}</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{-- Standardized coloring for the two required types --}}
                                @if($schedule['bus_type_name'] == 'Air-conditioned') bg-green-800 text-green-200 
                                @else bg-blue-800 text-blue-200 @endif">
                                {{ $schedule['bus_type_name'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <!-- Desktop/Tablet View (sm:block) - Dynamic Data -->
            <div class="hidden sm:block">
                <div class="overflow-x-auto rounded-xl shadow-2xl">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Bus No.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Route</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Departure Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                                {{-- Replaced 'Day' with 'Fare' --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fare (₱)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @foreach ($schedules as $schedule)
                                @php
                                    // Assuming fare data is available via the relationship
                                    $baseFare = $schedule->fare->base_fare ?? 150; 
                                    // Apply a 20% multiplier if the bus type is Air-conditioned
                                    $multiplier = ($schedule->busType->name == 'Air-conditioned') ? 1.2 : 1.0;
                                    $finalFare = $baseFare * $multiplier;
                                @endphp
                                <tr class="hover:bg-gray-700 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-400">{{ $schedule->bus_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $schedule->route->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-white">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('h:i A') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{-- Standardized coloring for the two required types --}}
                                            @if($schedule->busType->name == 'Air-conditioned') bg-green-800 text-green-200 
                                            @else bg-blue-800 text-blue-200 @endif">
                                            {{ $schedule->busType->name }}
                                        </span>
                                    </td>
                                    {{-- Displaying the calculated fare amount --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-yellow-400">₱{{ number_format($finalFare, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile View (Default block, sm:hidden) - Dynamic Card Layout -->
            <div class="grid grid-cols-1 gap-4 sm:hidden">
                @foreach ($schedules as $schedule)
                    @php
                        // Assuming fare data is available via the relationship
                        $baseFare = $schedule->fare->base_fare ?? 150; 
                        // Apply a 20% multiplier if the bus type is Air-conditioned
                        $multiplier = ($schedule->busType->name == 'Air-conditioned') ? 1.2 : 1.0;
                        $finalFare = $baseFare * $multiplier;
                    @endphp
                    <div class="bg-gray-800 p-4 rounded-xl shadow-lg border-l-4 border-yellow-400">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-yellow-400">{{ $schedule->bus_number }}</h3>
                            <span class="text-2xl font-extrabold text-white">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('h:i A') }}</span>
                        </div>
                        <div class="text-sm text-gray-300 mb-2">{{ $schedule->route->name }}</div>
                        <div class="flex justify-between items-center text-xs">
                            {{-- Displaying the calculated fare amount --}}
                            <span class="font-medium text-lg text-yellow-400">Fare: ₱{{ number_format($finalFare, 2) }}</span>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{-- Standardized coloring for the two required types --}}
                                @if($schedule->busType->name == 'Air-conditioned') bg-green-800 text-green-200 
                                @else bg-blue-800 text-blue-200 @endif">
                                {{ $schedule->busType->name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
