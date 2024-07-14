<x-guest-layout>
    <style>
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
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
                <x-input-label for="dob_day" :value="__('Date of Birth')" />
                <div class="flex space-x-2 mt-1">
                    <!-- Day -->
                    <select id="dob_day" name="dob_day" class="block w-1/3" required>
                        <option value="">{{ __('Day') }}</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    
                    <!-- Month -->
                    <select id="dob_month" name="dob_month" class="block w-1/3" required>
                        <option value="">{{ __('Month') }}</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                    
                    <!-- Year -->
                    <select id="dob_year" name="dob_year" class="block w-1/3" required>
                        <option value="">{{ __('Year') }}</option>
                        @for ($i = date('Y'); $i >= 1900; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <x-input-error :messages="$errors->get('dob_day')" class="mt-2" />
                <x-input-error :messages="$errors->get('dob_month')" class="mt-2" />
                <x-input-error :messages="$errors->get('dob_year')" class="mt-2" />
            </div>
        </div>

        <!-- Step 4: Physical Information -->
        <div class="form-step">
            <!-- Height -->
            <div class="mt-4">
                <x-input-label for="heightFeet" :value="__('What is your height?')" />

                <!-- Select for Feet -->
                <select id="heightFeet" name="heightFeet" class="block mt-1 w-full" required>
                    <option value="">Feet</option>
                    @for ($i = 0; $i <= 8; $i++)
                        <option value="{{ $i }}">{{ $i }} ft</option>
                    @endfor
                </select>

                <!-- Select for Inches -->
                <select id="heightInches" name="heightInches" class="block mt-1 w-full" required>
                    <option value="">Inches</option>
                    @for ($j = 0; $j < 12; $j++)
                        <option value="{{ $j }}">{{ $j }} in</option>
                    @endfor
                </select>

                <x-input-error :messages="$errors->get('heightFeet')" class="mt-2" />
                <x-input-error :messages="$errors->get('heightInches')" class="mt-2" />
            </div>
        </div>

        <!-- Step 5: Physical Information -->
        <div class="form-step">
            <!-- Weight -->
            <div class="mt-4">
                <x-input-label for="weight" :value="__('What is your weight in lbs?')" />
                <select id="weight" name="weight" class="block mt-1 w-full" required>
                    <option value="">{{ __('Select Weight') }}</option>
                    @for ($i = 50; $i <= 500; $i++)
                        <option value="{{ $i }}">{{ $i }} lbs</option>
                    @endfor
                </select>
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
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
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
                    step.classList.remove('active');
                });
                steps[step].classList.add('active');

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
