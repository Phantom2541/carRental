<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rental Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Rental Create Form Card -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h3 class="text-center text-xl mb-4">Add New Rental</h3>

                    <!-- Form to create a new rental -->
                    <form method="POST" action="{{ route('rentals.store') }}">
    @csrf

    <!-- User Selection -->
    <div class="mb-4">
        <label for="userId" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
        <select name="userId" id="userId" class="form-select mt-1 block w-full" required>
            <option value="">Select a User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->fname }}</option>
            @endforeach
        </select>
        @error('userId')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Car Selection -->
    <div class="mb-4">
        <label for="carId" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car</label>
        <select name="carId" id="carId" class="form-select mt-1 block w-full" required>
            <option value="">Select a Car</option>
            @foreach ($cars as $car)
                <option value="{{ $car->id }}">{{ $car->model }}</option>
            @endforeach
        </select>
        @error('carId')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Start Date -->
    <div class="mb-4">
        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full" required>
        @error('start_date')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- End Date -->
    <div class="mb-4">
        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full" required>
        @error('end_date')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <a href="{{ route('rentals.index') }}" class="btn btn-outline-secondary mr-4">Cancel</a>
        <button type="submit" class="btn btn-success">Create Rental</button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript can go here -->
</x-app-layout>
