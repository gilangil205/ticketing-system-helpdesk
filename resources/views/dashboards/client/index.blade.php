<x-app-layout>
    <x-slot name="header">
        @section('title', 'Dashboard')
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <h1 class="text-2xl font-bold mb-6">Welcome to IT Support Center, {{ Auth::user()->full_name }}</h1>

            <!-- Ticket Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Open Ticket Card -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Open Ticket</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold">24</span>
                        <a href="#" class="text-blue-600 hover:text-blue-800">Show more ></a>
                    </div>
                </div>

                <!-- Closed Ticket Card -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Closed Ticket</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold">56</span>
                        <a href="#" class="text-blue-600 hover:text-blue-800">Show more ></a>
                    </div>
                </div>

                <!-- Total Ticket Card -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Ticket</h3>
                    <div class="flex justify-between items-center">
                        <span class="text-3xl font-bold">80</span>
                        <a href="#" class="text-blue-600 hover:text-blue-800">Show more ></a>
                    </div>
                </div>
            </div>

            <!-- History Ticket Table -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">History Ticket</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Ticket</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topic</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#123456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">debra.holt@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bug Report</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">. . .</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#123456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">willie.jennings@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bug Report</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">. . .</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#123456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">bill.sanders@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bug Report</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">. . .</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#123456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">tim.jennings@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bug Report</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">. . .</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#123456</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">deanna.curtis@example.com</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bug Report</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">. . .</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>