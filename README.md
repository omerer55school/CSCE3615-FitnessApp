# Fitness Tracker

# Calorie Calculation

## Overview
Our application calculates the calories burned during various physical activities using a formula based on the Metabolic Equivalent of Task (MET) values. This method ensures a standardized estimation of the energy expenditure for activities ranging from light walking to intense physical exercises.

## Formula Used
The formula for calculating calories burned is:

```Calories Burned = MET × Weight in kg × Duration in hours```


- **MET (Metabolic Equivalent of Task)**: Represents the energy cost of physical activities as multiples of the resting metabolic rate (RMR). 1 MET is the rate of energy expenditure while sitting at rest.
- **Weight in kg**: The user's body weight converted from pounds (if applicable).
- **Duration in hours**: The time spent performing the activity, converted from minutes to hours.

## MET Values
Here are some example MET values used for common activities within our system:

- **Running**: 10 METs
- **Walking**: 3.3 METs (Moderate pace)
- **Biking**: 6.8 METs (Moderate pace)
- **Swimming**: 8 METs
- **Rowing**: 7 METs
- **Elliptical Training**: 5.5 METs
- **Jump Rope**: 12 METs
- **Stair Climbing**: 9 METs
- **HIIT (High-Intensity Interval Training)**: 12.5 METs
- **General Workout (Weightlifting, unspecified intensity)**: 5 METs

## Conversions Used
- **Weight Conversion**: If weight is provided in pounds, it is converted to kilograms using the formula:
  

```Weight in kg = Weight in lbs / 2.20462```


- **Time Conversion**: Activity duration provided in minutes is converted to hours:

```Duration in hours = Duration in minutes / 60```


## Example Calculation
For a user weighing 185 lbs performing a 30-minute general workout:

- Convert weight: `185 / 2.20462 ≈ 83.9 kg`
- Convert time: `30 / 60 = 0.5 hours`
- Using a MET of 5 for a general workout:


```Calories Burned = 5 × 83.9 × 0.5 ≈ 209.75 calories```


## Additional Notes
- The MET values can vary based on the source and the intensity level of the activity.
- The calculation assumes that the duration and intensity of the activity are accurately reported.
- Users are encouraged to adjust activity types to more accurately reflect the intensity of their workouts for more precise calorie calculations.







## Welcome to Our Fitness Tracking App (for dev)

This project is built using Laravel, a web application framework with expressive, elegant syntax. Below is a guide to help you set up and start developing.

### Prerequisites

Before you begin, make sure you have the following installed:
- Git
- PHP (version 8.0 or higher)
- Composer
- Node.js

### Getting Started

1. Clone the Repository

   Open your terminal and run the following command to clone the project repository:
   git clone https://github.com/omerer55school/CSCE3615-FitnessApp
   cd CSCE3615-Group-project

2. Install PHP Dependencies

   Run the following command to install the necessary PHP dependencies:
   composer install

3. Environment Setup

   Copy the example environment file and make the necessary configuration adjustments as needed:
   cp .env.example .env

   Then generate the application key with:
   php artisan key:generate

4. Install JavaScript Dependencies

   Run the following command to install the necessary JavaScript packages:
   npm install

5. Compile Assets

   Compile the front-end assets using:
   npm run dev

6. Start the Development Server

   Start the Laravel development server by running:
   php artisan serve

   This command will start the server at http://127.0.0.1:8000. You can open this URL in a browser to see the application.

### Contributing

Thank you for considering contributing to our project! Please read our contribution guidelines in the repository or the official Laravel contribution guide.

### Code of Conduct

We strive to create a welcoming and inclusive environment. Please review and adhere to our Code of Conduct.

### Reporting Issues

If you discover any issues or have suggestions, please open an issue on our GitHub repository.

### License

The project is open-sourced software licensed under the MIT license.

### Need Help?

If you run into problems, feel free to ask for help. We're here to assist each other in our learning and development journey.

