<x-app-layout>
    <x-slot name="header">
        @section('title', 'Project Tickets')
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Project Ticket Workflow System
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto ">
            <!-- Project Selection and Stats -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Project: 
                            <select class="ml-2 border-none text-lg font-bold focus:ring-blue-500 focus:border-blue-500">
                                <option>E-Commerce Platform</option>
                                <option>Mobile Banking App</option>
                                <option>Inventory Management</option>
                            </select>
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Last updated: 2 hours ago</p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">24</div>
                            <div class="text-xs text-gray-500">Total Tickets</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-yellow-600">8</div>
                            <div class="text-xs text-gray-500">In Development</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">5</div>
                            <div class="text-xs text-gray-500">In Testing</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">11</div>
                            <div class="text-xs text-gray-500">Completed</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Workflow Visualization -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow overflow-x-auto">
                <div class="flex justify-center min-w-max">
                    <div class="flex items-center">
                        <!-- Client -->
                        <div class="text-center mx-4">
                            <div class="h-12 w-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium">Client</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="mx-2">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </div>
                        
                        <!-- Project Manager -->
                        <div class="text-center mx-4">
                            <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-green-600 text-sm font-medium">PM</span>
                            </div>
                            <span class="text-xs font-medium">Project Manager</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="mx-2">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </div>
                        
                        <!-- Developer -->
                        <div class="text-center mx-4">
                            <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-blue-600 text-sm font-medium">DEV</span>
                            </div>
                            <span class="text-xs font-medium">Developer</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="mx-2">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </div>
                        
                        <!-- QA Tester -->
                        <div class="text-center mx-4">
                            <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <span class="text-purple-600 text-sm font-medium">QA</span>
                            </div>
                            <span class="text-xs font-medium">QA Tester</span>
                        </div>
                        
                        <!-- Arrow -->
                        <div class="mx-2">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </div>
                        
                        <!-- Client -->
                        <div class="text-center mx-4">
                            <div class="h-12 w-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium">Client Approval</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ticket</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Stage</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignee</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Ticket 1 - In Development -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Product search functionality</div>
                                            <div class="text-xs text-gray-500">#PROJ-124</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-blue-500 mr-2"></div>
                                        <span class="text-sm">Development</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                                            <span class="text-blue-600 text-xs font-medium">DEV</span>
                                        </div>
                                        <span class="text-sm">Alex R.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Due in 2 days</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">In Progress</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-green-600 hover:text-green-900">Move to QA</button>
                                </td>
                            </tr>

                            <!-- Ticket 2 - In Testing -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Checkout process</div>
                                            <div class="text-xs text-gray-500">#PROJ-123</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-purple-500 mr-2"></div>
                                        <span class="text-sm">Testing</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-2">
                                            <span class="text-purple-600 text-xs font-medium">QA</span>
                                        </div>
                                        <span class="text-sm">Sarah J.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">On time</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">In Testing</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-green-600 hover:text-green-900">Approve</button>
                                </td>
                            </tr>

                            <!-- Ticket 3 - Ready for Client Review -->
                            <tr class="hover:bg-gray-50 bg-blue-50">
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">User profile page</div>
                                            <div class="text-xs text-gray-500">#PROJ-122</div>
                                            <span class="mt-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                <svg class="mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3"></circle>
                                                </svg>
                                                Ready for client
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                        <span class="text-sm">Client Review</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center mr-2">
                                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm">Acme Corp</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Completed</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ready for Review</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                                    <button class="text-gray-600 hover:text-gray-900">Remind Client</button>
                                </td>
                            </tr>

                            <!-- Ticket 4 - Completed -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Login page redesign</div>
                                            <div class="text-xs text-gray-500">#PROJ-121</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-gray-500 mr-2"></div>
                                        <span class="text-sm">Completed</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center mr-2">
                                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm">Client Approved</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">Completed</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Closed</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">24</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Panel -->
            <div class="mt-6 bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-medium text-gray-900">Recent Notifications</h3>
                    <button class="text-sm text-blue-600 hover:text-blue-800">View All</button>
                </div>
                <div class="space-y-4">
                    <!-- Notification 1 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">Ticket #PROJ-122 approved by QA</p>
                            <p class="text-sm text-gray-500">Sarah Johnson marked the user profile page as ready for client review</p>
                            <div class="mt-1 text-xs text-gray-500">2 hours ago</div>
                        </div>
                        <button class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Notification 2 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">Ticket #PROJ-124 due soon</p>
                            <p class="text-sm text-gray-500">Product search functionality is due in 2 days</p>
                            <div class="mt-1 text-xs text-gray-500">5 hours ago</div>
                        </div>
                        <button class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Notification 3 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">New ticket assigned</p>
                            <p class="text-sm text-gray-500">You've been assigned to work on payment gateway integration</p>
                            <div class="mt-1 text-xs text-gray-500">1 day ago</div>
                        </div>
                        <button class="ml-4 flex-shrink-0 text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Project dropdown
            const projectSelect = document.querySelector('select');
            projectSelect.addEventListener('change', function() {
                // In a real app, this would load tickets for the selected project
                console.log('Project changed to:', this.value);
            });
            
            // Notification dismiss buttons
            document.querySelectorAll('[aria-label="Dismiss notification"]').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.flex').remove();
                });
            });
        });
    </script>
</x-app-layout>