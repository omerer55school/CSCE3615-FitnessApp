<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col h-screen">
            <div class="flex justify-between items-center p-4 bg-gray-100">
                <h1 class="text-lg font-semibold">Welcome, <span class="username">{{ Auth::user()->name }}</span>!</h1>
                <button class="text-blue-500">Today</button>
            </div>
    
            <div class="flex-1 overflow-auto">
                <div class="p-4 bg-white border-b border-gray-300" onclick="toggleSection('progress')">Progress</div>
                <div class="p-4 bg-white border-b border-gray-300" id="meals">
                    Meals
                    <div class="pl-4 pt-2 bg-gray-100">Breakfast</div>
                    <div class="pl-4 pt-2 bg-gray-100">Lunch</div>
                    <div class="pl-4 pt-2 bg-gray-100">Dinner</div>
                    <div class="pl-4 pt-2 bg-gray-100">Snack</div>
                </div>
                <div class="p-4 bg-white border-b border-gray-300" id="drinks">
                    Drinks
                    <div class="pl-4 pt-2 bg-gray-100">Water</div>
                    <div class="pl-4 pt-2 bg-gray-100">Soda/Juice</div>
                </div>
                <div class="p-4 bg-white border-b border-gray-300">Activity</div>
                <div class="p-4 bg-white">Weight</div>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.addEventListener('click', function() {
                    this.classList.toggle('expanded');
                    const subSections = this.querySelectorAll('.sub-section');
                    subSections.forEach(sub => {
                        sub.style.display = sub.style.display === 'block' ? 'none' : 'block';
                    });
                });
            });
        });
    </script>

</x-app-layout>
