# Daily Task Management System

## Introduction

This project is a simple daily task management system built with Laravel's Blade templating engine and Command Cron Jobs. It allows users to manage their daily tasks through a user interface (UI) and receive daily emails with pending tasks.

## Features

- **User Authentication**: Only registered users can access the system.
- **Task Management**: Users can add, edit, delete, and update the status of tasks.
- **Daily Email Notifications**: Automated email sent to each user daily, listing pending tasks.
- **Caching**: Frequently accessed tasks are cached for performance improvement.

---

## Requirements

- PHP >= 8.0
- Composer
- Laravel >= 9.x
- MySQL or another compatible database

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/Dralve/daily-task-management.git
   cd daily-task-management

2. **Navigate to the Project Directory**

    ```bash
    cd daily-task-management
    ```

3. **Install Dependencies**

    ```bash
    composer install
    npm install && npm run dev
    ```

4. **Set Up Environment Variables**

   Copy the `.env.example` file to `.env` and configure your database and other environment settings.

    ```bash
    cp .env.example .env
    ```

    Update the database settings and mail configuration in the .env file:

     ```bash
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your_email
    MAIL_PASSWORD=your_email_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your_email
    MAIL_FROM_NAME="${APP_NAME}"
    ```
    

5. **Run Migrations**

    ```bash
    php artisan migrate
    ```


6. **Start the Development Server**

    ```bash
    php artisan serve
    ```

## Task Management Interface

- **Accessing the Task Management System**: After logging in, users can view a personalized list of their daily tasks, displaying details such as title, description, due date, and status.

- **Adding a New Task**: Users can add tasks by filling out a simple form with fields for the title, description, and due date, then submitting it to save the task.

- **Editing or Deleting Tasks**: Each task has options to edit or delete it. Editing opens a form where users can update the task details, while deleting removes the task from the list.

- **Marking Tasks as Completed**: Users can toggle the status of a task between "Pending" and "Completed" with a single click, making it easy to keep track of progress.

## Scheduling the Daily Task Email with Cron

The application includes a command that sends a daily email to each user listing their pending tasks. To run this automatically, follow these steps:

1. **Define the Cron Job:**

    ```bash
    crontab -e
    ```
2. **Add the Cron Job Entry:**

    ```bash
   0 9 * * * /usr/bin/php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
   ```
   Make sure to replace /path-to-your-project with the actual path to your Laravel project.


3. **Testing the Cron Job Locally:**

   Run the command manually to test if emails are being sent:

    ```bash
   php artisan schedule:run
   ```
   This command will run once.

    ```bash
   php artisan schedule:work
   ```
   Using this command will keep the scheduler running.

## Development Notes

- **Blade Directives**: The views use Blade directives like @if, @foreach, and @csrf to enhance usability and security.

- **Caching**: Laravel caching is implemented to improve performance on frequently accessed tasks.

- **Error Handling**: Basic error handling is added to ensure users receive relevant feedback.


## Documentation

All code is documented with appropriate comments and DocBlocks. For more details on the codebase, refer to the inline comments.

## Conclusion

This project demonstrates the use of Blade for UI, Cron Jobs for automation, and Eloquent for database management in Laravel. Enjoy managing your tasks efficiently with this simple yet effective application!


## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
