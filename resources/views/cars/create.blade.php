<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Car Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Car Create Form Card -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h3 class="text-center text-xl mb-4">Add New Car</h3>

                    <!-- Form to create a new car -->
                    <form method="POST" action="{{ route('cars.store') }}">
                        @csrf

                        <!-- Car Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car Name</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Car Brand -->
                        <div class="mb-4">
                            <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car Brand</label>
                            <input type="text" name="brand" id="brand" class="form-input mt-1 block w-full" value="{{ old('brand') }}" required>
                            @error('brand')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Car Model -->
                        <div class="mb-4">
                            <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car Model</label>
                            <input type="text" name="model" id="model" class="form-input mt-1 block w-full" value="{{ old('model') }}" required>
                            @error('model')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Plate Number -->
                        <div class="mb-4">
                            <label for="plateNum" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plate Number</label>
                            <input type="text" name="plateNum" id="plateNum" class="form-input mt-1 block w-full" value="{{ old('plateNum') }}" required>
                            @error('plateNum')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Gas Type -->
                        <div class="mb-4">
                            <label for="gas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gas Type</label>
                            <input type="text" name="gas" id="gas" class="form-input mt-1 block w-full" value="{{ old('gas') }}" required>
                            @error('gas')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Car Year Model -->
                        <div class="mb-4">
                            <label for="yearModel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year Model</label>
                            <input type="number" name="yearModel" id="yearModel" class="form-input mt-1 block w-full" value="{{ old('yearModel') }}" required>
                            @error('yearModel')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" name="price" id="price" class="form-input mt-1 block w-full" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Car Status (Active/Inactive) -->
                        <div class="mb-4">
                            <label for="isActive" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="isActive" id="isActive" class="form-select mt-1 block w-full" required>
                                <option value="1" {{ old('isActive') == 1 ? 'selected' : '' }}>Available</option>
                                <option value="0" {{ old('isActive') == 0 ? 'selected' : '' }}>Unavailable</option>
                            </select>
                            @error('isActive')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary mr-4">Cancel</a>
                            <button type="submit" class="btn btn-success">Save Car</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript can go here -->
</x-app-layout>
