<x-guest-layout>


    <style>
        .form-step {
            display: none;
        }
    </style>

    <form id="registrationForm" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Step 1: User Goal -->
        <div class="form-step active">
            <!-- Goal Selection -->
            <div>
                <x-input-label :value="__('What is your goal?')" />
                <div class="mt-1">
                    <label>
                        <input type="radio" name="goal" value="lose_weight" required />
                        Lose Weight
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="goal" value="maintenance" required />
                        Maintenance
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="goal" value="gain_weight" required />
                        Gain Weight
                    </label>
                </div>
                <x-input-error :messages="$errors->get('goal')" class="mt-2" />
            </div>
        </div>


        <!-- Step 2: Security Information -->
        <div class="form-step">
            <div>
                <!-- Gender -->
                <div class="mt-4">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender" class="block mt-1 w-full">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>
        </div>




        <!-- Step 3: Personal Details -->
        <div class="form-step">
            <!-- Date of Birth -->
            <div class="mt-4">
                <x-input-label for="dob" :value="__('Date of Birth')" />
                <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" required />
                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
            </div>
        </div>

        <!-- Step 4: Physical Information -->
        <div class="form-step">
            <!-- Height -->
            <div class="mt-4">
                <x-input-label for="height" :value="__('What is your height')" />
                <x-text-input id="height" class="block mt-1 w-full" type="tel" name="height" required />
                <x-input-error :messages="$errors->get('height')" class="mt-2" />
            </div>
        </div>


        <!-- Step 5: Physical Information -->
        <div class="form-step">
            <!-- Weight -->
            <div class="mt-4">
                <x-input-label for="weight" :value="__('What is your weight')" />
                <x-text-input id="weight" class="block mt-1 w-full" type="tel" name="weight" required />
                <x-input-error :messages="$errors->get('weight')" class="mt-2" />
            </div>
        </div>

        <!-- Step 5: User Credentials -->
        <div class="form-step active">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>





        <!-- Navigation Buttons -->
        <div class="form-navigation mt-4">
            <button type="button" class="previous-button bg-green-500 p-2 text-white hover:bg-green-600 rounded-md" style="display:none;">Previous</button>
            <button type="button" class="next-button bg-red-500 p-2 text-white hover:bg-red-600 rounded-md">Next</button>
            <button type="submit" class="submit-button bg-blue-500 p-2 text-white hover:bg-blue-600 rounded-md" style="display:none;">Submit</button>
        </div>
        
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const nextButton = document.querySelector('.next-button');
            const previousButton = document.querySelector('.previous-button');
            let currentStep = 0;
            const steps = document.querySelectorAll('.form-step');
            const totalSteps = steps.length;

            function showStep(step) {
                steps.forEach((step, index) => {
                    step.style.display = 'none';
                });
                steps[step].style.display = 'block';

                if (step === 0) {
                    previousButton.style.display = 'none';
                } else {
                    previousButton.style.display = 'inline';
                }

                if (step === totalSteps - 1) {
                    nextButton.style.display = 'none';
                    document.querySelector('.submit-button').style.display = 'inline';
                } else {
                    nextButton.style.display = 'inline';
                    document.querySelector('.submit-button').style.display = 'none';
                }
            }

            nextButton.addEventListener('click', () => {
                if (currentStep < totalSteps - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            previousButton.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(0); // Initialize the form with the first step visible
        });
    </script>




</x-guest-layout>
