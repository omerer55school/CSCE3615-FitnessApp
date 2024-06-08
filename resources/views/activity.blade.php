<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Activity') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                    <form id="activity_form" class="space-y-8 divide-y divide-gray-200">
                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                    Log Activity
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-300">
                                    Enter details about the activity you've done.
                                </p>
                            </div>

                            <!-- Date Picker -->
                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-4">
                                    <label for="activity_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mt-3">
                                        Date of Activity
                                    </label>
                                    <div class="mt-1 sm:col-span-2">
                                        <input type="date" id="activity_date" name="activity_date" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                            </div>

                            <!-- Cardio Activity Section -->
                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mt-1">Cardio Activity</h4>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                    <label for="cardio_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Cardio Type
                                    </label>
                                
                                    <div class="mt-1 sm:col-span-2">
                                        <input type="text" name="cadio_type" id="cardio_type" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                 
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                    <label for="distance" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Distance (mi)
                                    </label>
                                    <div class="mt-1 sm:col-span-2">
                                        <input type="number" name="distance" id="distance" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                    <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                        Time (minutes)
                                    </label>
                                    <div class="mt-1 sm:col-span-2">
                                        <input type="number" name="time" id="time" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                            </div>

                            <!-- Workout Section -->
                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mt-1">Workout</h4>
                                <div id="workouts_container">
                                    <!-- Initial workout entry will be added here by JavaScript -->
                                </div>
                                <button type="button" onclick="addWorkoutEntry()" class="mt-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">Add Workout Entry</button>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-5">
                                <div class="flex justify-end">
                                    <button type="button" onclick="submitForm()" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save Activity
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            addWorkoutEntry(); // Add initial workout entry
        });

        function addWorkoutEntry() {
            const container = document.getElementById('workouts_container');
            const entry = document.createElement('div');
            entry.className = 'workout-entry mt-5';
            entry.innerHTML = `
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Workout Type
                    </label>
                    <input type="text" name="workout_type[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Sets
                    </label>
                    <input type="number" name="sets[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Reps
                    </label>
                    <input type="number" name="reps[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            `;
            container.appendChild(entry);
        }

        function submitForm() {
            const form = document.getElementById('activity_form');
            const formData = new FormData(form);
            console.log('Form Data:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
            event.preventDefault();
        }
    </script>
</x-app-layout>
