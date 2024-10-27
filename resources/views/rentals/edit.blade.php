<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Rental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Rental Edit Form Card -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h3 class="text-center text-xl mb-4">Edit Rental</h3>

                    <!-- Form to edit the rental -->
                    <form method="POST" action="{{ route('rentals.update', $rental->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Car Selection -->
                        <div class="mb-4">
                            <label for="carId" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car</label>
                            <select name="carId" id="carId" class="form-select mt-1 block w-full" required>
                                <option value="">Select a Car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}" {{ $car->id == $rental->carId ? 'selected' : '' }}>
                                        {{ $car->model }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carId')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full" value="{{ $rental->start_date }}" required>
                            @error('start_date')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full" value="{{ $rental->end_date }}" required>
                            @error('end_date')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('rentals.index') }}" class="btn btn-outline-secondary mr-4">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Rental</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
