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
                <!-- Sections start expanded, remove 'hidden' class from sub-sections -->
                <div class="section p-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600 cursor-pointer" onclick="toggleSection(this)">
                    Progress
                    <div class="sub-section p-2 bg-gray-100">
                        <!-- Detailed progress content goes here -->
                        Your progress details...
                    </div>
                </div>
                <div class="section p-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600 cursor-pointer" onclick="toggleSection(this)">
                    Activity
                    <div class="sub-section p-2 bg-gray-100">
                        <!-- Activity details content goes here -->
                        Your activity details...
                    </div>
                </div>
                <div class="section p-4 bg-white dark:bg-gray-700 cursor-pointer" onclick="toggleSection(this)">
                    Weight
                    <div class="sub-section p-2 bg-gray-100">
                        <!-- Weight details content goes here -->
                        Your weight details...
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    

    <script>
        function toggleSection(element) {
            const subSection = element.querySelector('.sub-section');
            // Toggle 'hidden' class to show/hide the sub-section
            subSection.classList.toggle('hidden');
        }
    </script>

</x-app-layout>
