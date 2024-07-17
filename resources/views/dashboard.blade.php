<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-24">
        <div class="flex flex-col h-screen bg-gray-100 dark:bg-gray-800 pb-24">
            <div class="flex justify-between items-center p-4 bg-gray-100 dark:bg-gray-900 ml-4">
                <h1 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Welcome, <span class="username mr-1">{{ Auth::user()->name }}</span>!</h1>
            </div>
    
            <div class="flex-1">

                <!-- Activity Log Section -->
                <div class="section p-4 flex justify-center bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <div class="text-lg font-semibold">Tracking Progress</div>
                </div>






                <!-- Activity Log Section -->
                <div class="section px-4 pb-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                    <div class="py-4 font-[500] flex cursor-pointer ml-2">
                        <p>Activity Log</p>
                    </div>
                    <div class="sub-section p-2 bg-gray-100" id="activitySubSection">
                        <div>
                            <div class="flex flex-col mb-4">
                                <div class="flex justify-between mb-2 w-1/2">
                                    <label for="calorieStartDate" class="text-sm font-semibold text-gray-700 dark:text-gray-300">From Start Date:</label>
                                    <label for="calorieEndDate" class="text-sm font-semibold text-gray-700 dark:text-gray-300">To End Date:</label>
                                </div>
                                <div class="flex justify-between">
                                    <input type="date" id="calorieStartDate" class="border px-2 py-1 rounded">
                                    <input type="date" id="calorieEndDate" class="border px-2 py-1 rounded">
                                    <button onclick="filterCalories()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Calories Burned Over Time</button>
                                </div>
                            </div>
                        </div>
                        <h3 class="mt-8">Calories Burned Over Time</h3>

                        <div class="my-4 px-6 text-lg" id="calorieChangeDisplay">
                            <!-- Calorie change will be displayed here -->
                        </div>
                        <hr>
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
                            <button onclick="previousPage('activity', event)" class="previous-button-activity mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Previous</button>
                            <div class="pagination-container-activity flex space-x-2"></div>
                            <button onclick="nextPage('activity', event)" class="next-button-activity mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Next</button>
                        </div>
                    </div>
                </div>







                <!-- Weight Log Section -->
                <div class="section px-4 pb-4 bg-white dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600 pb-24">
                    <div class="py-4 font-[500] flex cursor-pointer ml-2">
                        <p>Weight Log</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="8" class="mx-5">
                            <path d="M182.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L128 109.3V402.7L86.6 361.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l96 96c12.5 12.5 32.8 12.5 45.3 0l96-96c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 402.7V109.3l41.4 41.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-96-96z"/>
                        </svg>
                    </div>
                    <div class="sub-section p-2 bg-gray-100" id="weightSubSection">

                    <div>
                        <div class="flex flex-col mb-4">
                            <div class="flex justify-between mb-2 w-1/2">
                                <label for="startDate" class="text-sm font-semibold text-gray-700 dark:text-gray-300">From Start Date:</label>
                                <label for="endDate" class="text-sm font-semibold text-gray-700 dark:text-gray-300">To End Date:</label>
                            </div>
                            <div class="flex justify-between">
                                <input type="date" id="startDate" class="border px-2 py-1 rounded">
                                <input type="date" id="endDate" class="border px-2 py-1 rounded">
                                <button onclick="filterWeights()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Calculate Weight Change Over Time</button>
                            </div>
                        </div> 
                        <h3 class="mt-8">Weight Change Over Time</h3>
                    </div>

                        <!-- Date Range Filter -->


                        <!-- Weight Change Display -->
                        <div class="my-4 px-6 text-lg" id="weightChangeDisplay">
                            <!-- Display weight change here -->
                        </div>
                        <hr>
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

                        <!-- Pagination controls -->
                        <div class="flex justify-between padding-4">
                            <button onclick="previousPage('weight', event)" class="previous-button-weight mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Previous</button>
                            <div class="pagination-container-weight flex space-x-2"></div>
                            <button onclick="nextPage('weight', event)" class="next-button-weight mt-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Next</button>
                        </div>
                    </div>
                </div>


                <footer class="bg-gray-800 text-white text-center py-4 bottom-0 w-full">
                    UNT CSCE 3615 Group 1 | Stephanie Molina | Daniel Burgess | Omer Muhammad | Vanshika Ganga | Zachary Gilbert 
                </footer>
                


            </div>
        </div>
        
    </div>









    
    <script>


let currentPageActivity = 1;
let currentPageWeight = 1;

function previousPage(entity, event) {
    event.stopPropagation();
    if (entity === 'activity' && currentPageActivity > 1) {
        currentPageActivity--;
        loadData('activity');
    } else if (entity === 'weight' && currentPageWeight > 1) {
        currentPageWeight--;
        loadData('weight');
    }
}

function nextPage(entity, event) {
    event.stopPropagation();
    if (entity === 'activity') {
        currentPageActivity++;
        loadData('activity');
    } else if (entity === 'weight') {
        currentPageWeight++;
        loadData('weight');
    }
}

function loadPage(entity, page, event) {
    event.stopPropagation();
    if (entity === 'activity') {
        currentPageActivity = page;
        loadData('activity');
    } else if (entity === 'weight') {
        currentPageWeight = page;
        loadData('weight');
    }
}

function loadData(entity) {
    if (entity === 'activity') {
        fetch(`/api/user-activities?page=${currentPageActivity}`, {
            headers: {
                'X-CSRF-TOKEN': getCSRFToken(),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            displayActivities(data.data);
            handleActivityPagination(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    } else if (entity === 'weight') {
        fetch(`/api/user-weights?page=${currentPageWeight}`, {
            headers: {
                'X-CSRF-TOKEN': getCSRFToken()
            }
        })
        .then(response => response.json())
        .then(data => {
            displayWeights(data.data);
            handleWeightPagination(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
}

function handleActivityPagination(data) {
    const prevButton = document.querySelector('.previous-button-activity');
    const nextButton = document.querySelector('.next-button-activity');
    const paginationContainer = document.querySelector('.pagination-container-activity');

    prevButton.disabled = !data.prev_page_url;
    nextButton.disabled = !data.next_page_url;

    paginationContainer.innerHTML = '';
    const totalPages = data.last_page;
    const currentPage = data.current_page;

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, currentPage + 2);

    if (startPage > 1) {
        paginationContainer.innerHTML += `<button onclick="loadPage('activity', 1, event)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">1</button>`;
        if (startPage > 2) {
            paginationContainer.innerHTML += `<span class="px-4 py-2">...</span>`;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationContainer.innerHTML += `<button onclick="loadPage('activity', ${i}, event)" class="px-4 py-2 ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white'} rounded hover:bg-gray-600">${i}</button>`;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationContainer.innerHTML += `<span class="px-4 py-2">...</span>`;
        }
        paginationContainer.innerHTML += `<button onclick="loadPage('activity', ${totalPages}, event)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">${totalPages}</button>`;
    }
}

function handleWeightPagination(data) {
    const prevButton = document.querySelector('.previous-button-weight');
    const nextButton = document.querySelector('.next-button-weight');
    const paginationContainer = document.querySelector('.pagination-container-weight');

    prevButton.disabled = !data.prev_page_url;
    nextButton.disabled = !data.next_page_url;

    paginationContainer.innerHTML = '';
    const totalPages = data.last_page;
    const currentPage = data.current_page;

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, currentPage + 2);

    if (startPage > 1) {
        paginationContainer.innerHTML += `<button onclick="loadPage('weight', 1, event)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">1</button>`;
        if (startPage > 2) {
            paginationContainer.innerHTML += `<span class="px-4 py-2">...</span>`;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationContainer.innerHTML += `<button onclick="loadPage('weight', ${i}, event)" class="px-4 py-2 ${i === currentPage ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white'} rounded hover:bg-gray-600">${i}</button>`;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationContainer.innerHTML += `<span class="px-4 py-2">...</span>`;
        }
        paginationContainer.innerHTML += `<button onclick="loadPage('weight', ${totalPages}, event)" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">${totalPages}</button>`;
    }
}

function displayActivities(activities) {
    const tbody = document.getElementById('activity-log-tbody');
    tbody.innerHTML = '';

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

function displayWeights(weights) {
    const tbody = document.getElementById('weight-log-tbody');
    tbody.innerHTML = '';
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
                console.log(data);
                displayWeights(data.data);  // Assumes data is the array of weights
                calculateWeightChange(data.data);
            })
            .catch((error) => {
                console.error('Error:', error);
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











function getCSRFToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

document.addEventListener('DOMContentLoaded', function() {
    loadData('activity');
    loadData('weight');
});


    </script>
</x-app-layout>
