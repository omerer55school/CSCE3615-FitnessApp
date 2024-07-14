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
                    <div class="text-lg font-semibold">Tracking Progress</div>
                </div>






                <!-- Activity Log Section -->
                <div class="section px-4 pb-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <div class="py-4 font-[500] flex cursor-pointer" onclick="toggleSection('activitySubSection')">
                        <p>Activity Log</p>
                    </div>
                    <div class="sub-section p-2 bg-gray-100" id="activitySubSection">


                        <h3>Calories Burned Over Time</h3>
                        <div class="flex justify-between mb-4">
                            <input type="date" id="calorieStartDate" class="border px-2 py-1 rounded">
                            <input type="date" id="calorieEndDate" class="border px-2 py-1 rounded">
                            <button onclick="filterCalories()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Calories Burned Over Time</button>
                        </div>
                        <div class="mt-4 px-6 py-3 text-lg" id="calorieChangeDisplay">
                            <!-- Calorie change will be displayed here -->
                        </div>

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
                            <tbody class="bg-white divide-y divide-gray-200" id="activity-log-tbody">
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


                        <!-- Date Range Filter -->
                        <h3>Weight Change Over Time</h3>
                        <div class="flex justify-between mb-4">
                            <input type="date" id="startDate" class="border px-2 py-1 rounded">
                            <input type="date" id="endDate" class="border px-2 py-1 rounded">
                            <button onclick="filterWeights()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Calculate Weight Change Over Time</button>
                        </div>



                        <!-- Weight Change Display -->
                        <div class="mt-4 px-6 py-3 text-lg" id="weightChangeDisplay">
                            <!-- Display weight change here -->
                        </div>
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
                            <tbody class="bg-white divide-y divide-gray-200" id="weight-log-tbody">
                                <!-- Data rows will be dynamically inserted here -->
                            </tbody>
                        </table>
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
        document.addEventListener('DOMContentLoaded', function() {
            loadData('activity');
            loadData('weight');
        });









        function loadData(entity) {
            if (entity === 'activity') {
                console.log('test');
                fetch('/api/user-activities', {
                    headers: {
                        'X-CSRF-TOKEN': getCSRFToken(),  // CSRF token for Laravel
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    displayActivities(data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

            } else if (entity === 'weight') {
                // Load weight data here
                fetch('/api/user-weights', {
                    headers: {
                        'X-CSRF-TOKEN': getCSRFToken()  // CSRF token for Laravel
                    }
                })
                .then(response => response.json())
                .then(data => {
                    displayWeights(data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
        }









        function displayActivities(activities) {
            console.log(activities);
            const tbody = document.getElementById('activity-log-tbody');
            tbody.innerHTML = ''; // Clear any existing rows

            activities.forEach(activity => {
                let showRow = false;
                let cardioDetails = '';
                let workoutDetails = '';

                if (activity.cardio_activity && (activity.cardio_activity.cardio_type || activity.cardio_activity.distance || activity.cardio_activity.time)) {
                    showRow = true;
                    cardioDetails = `Cardio Type: ${activity.cardio_activity.cardio_type || 'N/A'}, Distance: ${activity.cardio_activity.distance || 'N/A'} mi, Time: ${activity.cardio_activity.time || 'N/A'} min,  Calories Burned: ${parseFloat(activity.cardio_activity.calories_burned).toFixed(2)}`;
                }

                if (activity.workout_activities.length > 0) {
                    activity.workout_activities.forEach(workout => {
                        if (workout.workout_type || workout.sets || workout.reps) {
                            showRow = true;
                            workoutDetails += `Workout Type: ${workout.workout_type || 'N/A'}, Sets: ${workout.sets || 'N/A'}, Reps: ${workout.reps || 'N/A'}, Calories Burned: ${parseFloat(workout.calories_burned).toFixed(2)}<br>`;
                        }
                    });
                }

                if (showRow) {
                    if (cardioDetails) {
                        const cardioRow = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${activity.activity_date}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cardio</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${cardioDetails}</td>
                            </tr>
                        `;
                        tbody.innerHTML += cardioRow;
                    }

                    if (workoutDetails) {
                        const workoutRow = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${activity.activity_date}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Workout</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${workoutDetails}</td>
                            </tr>
                        `;
                        tbody.innerHTML += workoutRow;
                    }
                }
            });
        }









        function filterWeights() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;


            if (!startDate || !endDate) {
                alert('Please select both start and end dates.');
                return;
            }

            fetch(`/api/user-weights?start_date=${startDate}&end_date=${endDate}`, {
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                displayWeights(data);  // Assumes data is the array of weights
                calculateWeightChange(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }









        function displayWeights(weights) {
            const tbody = document.getElementById('weight-log-tbody');
            tbody.innerHTML = ''; // Clear existing rows
            weights.forEach(weight => {
                const row = `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${weight.weight_date}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${weight.weight} lbs</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }









        function calculateWeightChange(weights) {
            if (weights.length > 1) {
                const weightChange = weights[weights.length - 1].weight - weights[0].weight;
                document.getElementById('weightChangeDisplay').textContent = `Weight Change: ${weightChange.toFixed(2)} lbs`;
            } else {
                document.getElementById('weightChangeDisplay').textContent = 'Not enough data to calculate change.';
            }
        }










        function filterCalories() {
            const startDateCalorie = document.getElementById('calorieStartDate').value;
            const endDateCalorie = document.getElementById('calorieEndDate').value;



            if (!startDateCalorie || !endDateCalorie) {
                alert('Please select both start and end dates.');
                return;
            }

            fetch(`/api/user-calories?start_date=${startDateCalorie}&end_date=${endDateCalorie}`, {
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken(),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                displayCalorieChange(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }









        function displayCalorieChange(data) {
            console.log(data);
            const calorieChangeDisplay = document.getElementById('calorieChangeDisplay');

            if (data.length > 0) {
                let totalCalories = 0;

                // Sum up all calories burned from each activity
                data.forEach(activity => {
                    totalCalories += (activity.cardio_activity_sum_calories_burned || 0) + (activity.workout_activities_sum_calories_burned || 0);
                });

                // Update display with the total calories burned
                calorieChangeDisplay.textContent = `Total Calories Burned: ${totalCalories.toFixed(2)} calories`;
            } else {
                calorieChangeDisplay.textContent = 'No data to calculate total calories burned.';
            }
        }









        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }





    </script>
</x-app-layout>
