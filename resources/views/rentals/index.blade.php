<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rental Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Rentals Table Card -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    <h3 class="text-center text-xl mb-4">Rental List</h3>
                    <a href="{{ route('rentals.create') }}" class="btn btn-outline-success mb-4">
                        <span class="fa fa-plus"></span> Add New Rental
                    </a>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Car Model</th>
                                <th>User Name</th>
                                <th>Rental Start Date</th>
                                <th>Rental End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rental)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rental->car->model }}</td>
                                <td>{{ $rental->user->fname }}</td>
                                <td>{{ $rental->start_date }}</td>
                                <td>{{ $rental->end_date }}</td>
                                <td>
                                    @if ($rental->approve == 'approved')
                                        <span class="text-green-600">Approved</span>
                                    @else
                                        <span class="text-red-600">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                    @if ($rental->approve !== 'approved')
                                        <form action="{{ route('rentals.approve', $rental->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this rental?')">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
