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
                                <h3 class="flex justify-center text-xl leading-6 font-semibold text-gray-900 dark:text-white">
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
                                        <input type="text" name="cardio_type" id="cardio_type" class="max-w-lg block w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
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
                                <div id="success-message" class="hidden bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3 my-3" role="alert">
                                    <p class="font-bold">Activity logged successfully!</p>
                                    <p class="text-sm">Your activity has been saved.</p>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" onclick="submitForm(event)" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
            <input type="text" name="workout_type[]" class="block w-full sm:text-sm border-gray-300 rounded-md" required>
        </div>
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Sets
            </label>
            <input type="number" name="sets[]" class="block w-full sm:text-sm border-gray-300 rounded-md" required>
        </div>
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start mt-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Reps
            </label>
            <input type="number" name="reps[]" class="block w-full sm:text-sm border-gray-300 rounded-md" required>
        </div>
    `;
    container.appendChild(entry);
}



function clearForm() {
    const form = document.getElementById('activity_form');
    form.reset();
    document.getElementById('workouts_container').innerHTML = '';
    addWorkoutEntry(); // Add an initial empty workout entry

    // Show the success message
    const successMessage = document.getElementById('success-message');
    successMessage.classList.remove('hidden');

    // Hide the success message after 5 seconds
    setTimeout(() => {
        successMessage.classList.add('hidden');
    }, 5000);
}


function submitForm(event) {
    event.preventDefault();

    const form = document.getElementById('activity_form');
    const formData = new FormData(form);


    console.log('formData: ');
    const formDataObj = {};
formData.forEach((value, key) => {
    formDataObj[key] = value;
});
console.log(formDataObj);



    const cardioActivity = {
        cardio_type: formData.get('cardio_type'),
        distance: formData.get('distance'),
        time: formData.get('time')
    };

    const workouts = [];
    const workoutTypes = formData.getAll('workout_type[]');
    const sets = formData.getAll('sets[]');
    const reps = formData.getAll('reps[]');

    for (let i = 0; i < workoutTypes.length; i++) {
        workouts.push({
            workout_type: workoutTypes[i],
            sets: sets[i],
            reps: reps[i]
        });
    }

    const activityData = {
        activity_date: formData.get('activity_date'),
        cardio_activity: cardioActivity,
        workouts: workouts
    };

    fetch('/api/activities', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCSRFToken()  // CSRF token for Laravel
        },
        body: JSON.stringify(activityData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        clearForm();
    })
    .catch((error) => {
        console.error('Error:', error);
        // Handle error
    });
}

function getCSRFToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

    </script>
</x-app-layout>
