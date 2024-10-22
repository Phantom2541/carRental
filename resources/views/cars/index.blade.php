<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Car Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Cars Table Card -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h3 class="text-center text-xl mb-4">Car List</h3>
                    <a href="{{ route('cars.create') }}" class="btn btn-outline-success mb-4">
                        <span class="fa fa-plus"></span> New Car
                    </a>
                  
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Model</th>
                                <th>Brand</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->yearModel }}</td>
                                <td>
                                    @if ($car->isActive)
                                        <span class="text-green-600">Available</span>
                                    @else
                                        <span class="text-red-600">Unavailable</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- @section('javascript')
        <script type="text/javascript">
            // Add your JavaScript here (optional, if needed for car actions)
        </script>
    @endsection -->
</x-app-layout>
