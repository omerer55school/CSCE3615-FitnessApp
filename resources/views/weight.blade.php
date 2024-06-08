<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Log New Weight') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">

                    <div class="border-b-2 py-3">
                        <h3 class="flex justify-center text-xl leading-6 font-semibold text-gray-900 dark:text-white">
                            Log Weight
                        </h3>
                        <p class="mt-3 max-w-2xl text-sm text-gray-500 dark:text-gray-300">
                            Enter your weight so you can keep track of your weights over time.
                        </p>
                    </div>

                    <form id="weight_form" class="space-y-6 mt-5">
                        <div>
                            <label for="weight_date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Date
                            </label>
                            <input type="date" id="weight_date" name="weight_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        
                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Weight (lbs)
                            </label>
                            <input type="number" id="weight" name="weight" placeholder="Enter your weight" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="submitWeightForm()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save Weight
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitWeightForm() {
            const form = document.getElementById('weight_form');
            const formData = new FormData(form);
            console.log('Weight Data:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
            event.preventDefault(); // Prevent form from submitting normally
        }
    </script>
</x-app-layout>
