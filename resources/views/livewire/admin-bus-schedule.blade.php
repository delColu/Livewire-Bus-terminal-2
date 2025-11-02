<div class="p-6 bg-gray-900 min-h-screen text-white">
    <!-- Page Header -->
    <h1 class="text-3xl font-bold mb-8 text-yellow-500">Admin: Schedule Management</h1>

    <!-- Session Message -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="p-4 mb-6 text-sm text-green-200 bg-green-800 rounded-lg shadow-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form Card for Add/Edit Schedule -->
    <div id="schedule-form"
         class="bg-gray-800 p-6 md:p-8 rounded-xl shadow-2xl border border-gray-700 mb-10"
         wire:ignore.self
         x-init="$wire.on('scrollToForm', () => { window.scrollTo({ top: 0, behavior: 'smooth' }) })">
        
        <h2 class="text-xl font-semibold mb-6 text-gray-200">
            {{ $isEditMode ? 'Edit Existing Schedule' : 'Add New Schedule' }}
        </h2>

        <form wire:submit.prevent="saveSchedule" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Bus Dropdown --}}
            <div>
                <label for="bus_id" class="block mb-2 text-sm font-medium text-gray-400">Bus</label>
                <select wire:model.blur="bus_id" id="bus_id" class="w-full p-3 rounded-lg border-2 border-gray-600 bg-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500 transition duration-150">
                    <option value="">Select Bus (Number)</option>
                    @foreach($buses as $bus)
                        <option value="{{ $bus->bus_id }}">{{ $bus->bus_number }}</option> 
                    @endforeach
                </select>
                @error('bus_id') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Driver Dropdown --}}
            <div>
                <label for="driver_id" class="block mb-2 text-sm font-medium text-gray-400">Driver</label>
                <select wire:model.blur="driver_id" id="driver_id" class="w-full p-3 rounded-lg border-2 border-gray-600 bg-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500 transition duration-150">
                    <option value="">Select Driver</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->driver_id }}">{{ $driver->driver_name }}</option>
                    @endforeach
                </select>
                @error('driver_id') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Fare Dropdown (Linked to the route/fare structure) --}}
            <div>
                <label for="fare_id" class="block mb-2 text-sm font-medium text-gray-400">Fare / Route</label>
                <select wire:model.blur="fare_id" id="fare_id" class="w-full p-3 rounded-lg border-2 border-gray-600 bg-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500 transition duration-150">
                    <option value="">Select Fare / Route</option>
                    @foreach($fares as $fare)
                        {{-- NOTE: This assumes Fare model has a 'route' relationship for descriptive name --}}
                        <option value="{{ $fare->fare_id }}">
                           Fare ID {{ $fare->fare_id }} (Base: ₱{{ number_format($fare->base_fare, 2) }})
                        </option>
                    @endforeach
                </select>
                @error('fare_id') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Departure Time Input --}}
            <div>
                <label for="departure_time" class="block mb-2 text-sm font-medium text-gray-400">Departure Time (HH:MM)</label>
                <input type="time" wire:model.blur="departure_time" id="departure_time"
                       class="w-full p-3 rounded-lg border-2 border-gray-600 bg-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500 transition duration-150" required>
                @error('departure_time') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            
            {{-- Bus Type Dropdown (Normal/Air-conditioned) --}}
            <div class="col-span-1 md:col-span-2">
                <label for="bus_type" class="block mb-2 text-sm font-medium text-gray-400">Bus Type</label>
                <select wire:model.blur="bus_type" id="bus_type" class="w-full p-3 rounded-lg border-2 border-gray-600 bg-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500 transition duration-150" required>
                    <option value="">Select Type</option>
                    @foreach($busTypeOptions as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('bus_type') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="md:col-span-2 flex justify-between gap-4 pt-4">
                <button type="submit"
                        class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 rounded-lg text-white font-semibold transition duration-150 shadow-md">
                    {{ $isEditMode ? 'Save Changes' : '➕ Add Schedule' }}
                </button>
                @if ($isEditMode)
                    <button type="button" wire:click="resetForm"
                            class="px-6 py-3 bg-gray-600 hover:bg-gray-700 rounded-lg text-white font-semibold transition duration-150 shadow-md">
                        Cancel Edit
                    </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Existing Schedules Table -->
    <h2 class="text-2xl font-bold mb-6 text-gray-200">Existing Schedules</h2>

    <div class="overflow-x-auto rounded-lg shadow-2xl border border-gray-700">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Bus No.</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Driver</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Departure Time</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Bus Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Fare/Route ID</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @forelse ($schedules as $schedule)
                    <tr class="hover:bg-gray-750 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $schedule->bus->bus_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $schedule->driver->driver_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('h:i A') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $schedule->bus_type == 'Air-conditioned' ? 'bg-blue-600 text-blue-100' : 'bg-green-600 text-green-100' }}">
                                {{ $schedule->bus_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                             {{ $schedule->fare_id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="editSchedule({{ $schedule->schedule_id }})" class="text-yellow-500 hover:text-yellow-400 transition duration-150 mr-3">
                                Edit
                            </button>
                            <button wire:click="removeSchedule({{ $schedule->schedule_id }})" class="text-red-500 hover:text-red-400 transition duration-150">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-400">
                            No schedules found. Start by adding one above.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $schedules->links() }}
    </div>
</div>
