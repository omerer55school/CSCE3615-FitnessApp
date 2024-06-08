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
                    <form class="space-y-8 divide-y divide-gray-200" action="#" id="activity_form">
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
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-5">
                                    <label for="activity_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                                        Date of Activity
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="date" id="activity_date" name="activity_date" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                            </div>



                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-5">
                                    <label for="activity_type" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                                        Activity Type
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <select id="activity_type" name="activity_type" autocomplete="activity-type" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                            <option value="">Select</option>
                                            <option value="running">Running</option>
                                            <option value="walking">Walking</option>
                                            <option value="cycling">Cycling</option>
                                            <option value="workout">Workout</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Dynamic Section Based on Activity Type -->
                                <div id="activity_details" class="space-y-6 sm:space-y-5">
                                    <!-- Details will be injected here based on selected activity type -->
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </button>
                                <button type="button" onclick="submitForm()" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save Activity
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('activity_type').addEventListener('change', function() {
            const type = this.value;
            const detailsContainer = document.getElementById('activity_details');
            detailsContainer.innerHTML = ''; // Clear previous inputs

            if (type === 'running' || type === 'walking' || type === 'cycling') {
                detailsContainer.innerHTML = `
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                        <label for="distance" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                            Distance (km)
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="number" name="distance" id="distance" autocomplete="off" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                        <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                            Time (minutes)
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="number" name="time" id="time" autocomplete="off" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    `
            } else if (type === 'workout') {
                const workoutForm = `
                    <div id="workouts_container">
                        <div class="workout-entry mt-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                                    Workout Type
                                </label>
                                <input type="text" name="workout_type[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                                    Sets
                                </label>
                                <input type="number" name="sets[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                                    Reps
                                </label>
                                <input type="number" name="reps[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="addWorkoutEntry()" class="mt-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">Add Another Workout</button>
                `;
                detailsContainer.innerHTML = workoutForm;
            }
        });

        function addWorkoutEntry() {
            const container = document.getElementById('workouts_container');
            const entry = document.createElement('div');
            entry.className = 'workout-entry mt-5';
            entry.innerHTML = `
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                        Workout Type
                    </label>
                    <input type="text" name="workout_type[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                        Sets
                    </label>
                    <input type="number" name="sets[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                        Reps
                    </label>
                    <input type="number" name="reps[]" class="block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            `;
            container.appendChild(entry);
        }

        function submitForm() {
            const form = document.getElementById('activity_form');  // Make sure this is your form's ID
            const formData = new FormData(form);

            console.log('Form Data:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            // This line is crucial to prevent any default form submission behavior
            event.preventDefault();
        }

        function resetForm() {
            document.getElementById('activity_form').reset();
            console.log('Form reset!');
        }

        document.getElementById('activity_type').addEventListener('change', handleActivityChange);
        
        function handleActivityChange() {
            const type = this.value;
            const detailsContainer = document.getElementById('activity_details');
            detailsContainer.innerHTML = ''; // Clear previous inputs

            // Add inputs for running, walking, cycling
            if (type === 'running' || type === 'walking' || type === 'cycling') {
                addCardioInputs(detailsContainer, type);
            } else if (type === 'workout') {
                addWorkoutInputs(detailsContainer);
            }
        }

        function addCardioInputs(container, type) {
            container.innerHTML = `
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                <label for="distance" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Distance (km)
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input type="number" name="distance" id="distance" autocomplete="off" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Time (minutes)
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input type="number" name="time" id="time" autocomplete="off" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            `;
        }

        function addWorkoutInputs(container) {
            const html = `
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                <label for="distance" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Distance (km)
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input type="number" name="distance" id="distance" autocomplete="off" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                <label for="time" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Time (minutes)
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input type="number" name="time" id="time" autocomplete="off" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            `;
            container.innerHTML = html;
            addWorkoutEntry(); // Add the first entry by default
        }

    </script>

</x-app-layout>
