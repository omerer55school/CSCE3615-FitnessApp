<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col h-screen bg-gray-100 dark:bg-gray-800">
            <div class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-900">
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Welcome, <span class="username">{{ Auth::user()->name }}</span>!</h1>
            </div>
    
            <div class="flex-1 overflow-auto">

                <!-- Activity Log Section -->
                <div class="section p-4 flex justify-center bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <div class="text-lg font-semibold">Tacking Progress</div>
                </div>



                <!-- Activity Log Section -->
                <div class="section px-4 pb-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <div class="py-4 font-[500] flex cursor-pointer" onclick="toggleSection('activitySubSection')">
                        <p>Activity Log</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="8" class="mx-5">
                            <path d="M182.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L128 109.3V402.7L86.6 361.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 402.7V109.3l41.4 41.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-96-96z"/>
                        </svg>
                    </div>
                    <div class="sub-section p-2 bg-gray-100" id="activitySubSection">
                        <!-- Activity log table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Details
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Data rows will be dynamically inserted here -->
                            </tbody>
                        </table>
                        <!-- Pagination controls -->
                        <div class="flex justify-between padding-4">
                            <button onclick="previousPage('activity', event)" class="mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Previous</button>
                            <button onclick="nextPage('activity', event)" class="mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Next</button>
                        </div>
                    </div>
                </div>
                <!-- Weight Log Section -->
                <div class="section px-4 pb-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <div class="py-4 font-[500] flex cursor-pointer" onclick="toggleSection('weightSubSection')">
                        <p>Weight Log</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="8" class="mx-5">
                            <path d="M182.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L128 109.3V402.7L86.6 361.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 402.7V109.3l41.4 41.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-96-96z"/>
                        </svg>
                    </div>
                    <div class="sub-section p-2 bg-gray-100" id="weightSubSection">
                        <!-- Weight log table -->
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Weight (lbs)
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Data rows will be dynamically inserted here -->
                            </tbody>
                        </table>
                        <!-- Pagination controls -->
                        <div class="flex justify-between padding-4">
                            <button onclick="previousPage('weight', event)" class="mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Previous</button>
                            <button onclick="nextPage('weight', event)" class="mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function toggleSection(subSectionId) {
            const subSection = document.getElementById(subSectionId);
            if (subSection) {
                subSection.classList.toggle('hidden');
            }
        }

        // Pagination functionality remains the same, with updated event handling
        function previousPage(entity, event) {
            event.stopPropagation(); // Ensure the click doesn't toggle the sub-section
            console.log(`Loading previous page of ${entity}`);
        }

        function nextPage(entity, event) {
            event.stopPropagation(); // Ensure the click doesn't toggle the sub-section
            console.log(`Loading next page of ${entity}`);
        }

        // Example initialization call
        loadData('activity');
        loadData('weight');
    </script>

</x-app-layout>
