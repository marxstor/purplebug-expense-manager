## EXPENSE MANAGER USING LARAVEL AND VUE 3

## folder structure

-   `js/assets` - contains all the necessary assets like images
-   `js/components` - contains all components for different pages
-   `js/Pages` - contains all web pages
-   `js/shared` - for storing the global components
-   `js/shared/components` - contains the global components use by different pages
-   `js/shared/components/partial` - contains the small components use by most pages like Headers, Navlink, Sidebar, Footer

## Additional Middleware

-   `AdminMiddleware` - use to define routes that only accessible if the user role is admin

## Default users

## Note: Run the Migration first and the seeder: DefaultUserSeeder first to create the default users

## To run the seeder

-   `php artisan db:seed --class=DefaultUserSeeder`

## admin user credentials

-   email - `admin@gmail.com`
-   password - `admin`

## Normal user credentials

-   email - `user@gmail.com`
-   password - `user`

## Additional Note:
In order for the dashboard to show the chart the admin needs to add expense category first and add expenses to the expense page.
