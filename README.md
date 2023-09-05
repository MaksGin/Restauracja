<a name="readme-top"></a>
<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#features">Features</a></li>
      </ul>
        <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li><a href="#Setup">Setup</a></li>
    <li><a href="#Instructions">Instructions</a></li>
    <li><a href="#Conclusions">Conclusions</a></li> <!-- I corrected the spelling here -->
  </ol>
</details>


## About The Project

"Restaurant App" is a bilingual application that can represent the website of a local restaurant as well as a foreign one. Minimalist design and responsiveness allow for easy and pleasant interaction with the user. The primary goal of this project was to improve my programming skills while creating a practical application that would showcase my skills. The project developed in my spare time embodies my commitment to continuous learning and improvement in the field of software development.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Features

#### Restaurant App offers

Application created in Polish with the ability to translate the application into English for foreign users.

##### For non-login users
The main page offers a full list of restaurant dishes and the ability to book a table.

![MainPage](https://github.com/MaksGin/Restauracja/assets/26302413/c925d8f4-fdf9-406b-ac78-54ef6b361996)




##### For logged users
The login panel is used to log in to individual restaurant employees, offers different views and access to functionalities for the WAITER, COOK, BARTENER and MANAGER.

After Login you get access to Orders Page where you can see list of todays orders, with details like Table Number, Order Status and price.

![image](https://github.com/MaksGin/Restauracja/assets/26302413/76c51d56-f2f0-4d5e-af83-306ef187d08a)

You can click on specific order and display content of the order.

![image](https://github.com/MaksGin/Restauracja/assets/26302413/97adde8c-4b3b-44df-9e08-3e57aa9e6bf1)



Manager has access to all application functions available to other users, additionally he can display and manage the list of employees and manage the list of job positions.


Waiter has a view of current orders, can create new orders, and has access to his own panel where orders come from the kitchen and are ready to serve, then he can click the button "completed and paid"



Process of adding an order by the waiter:

![AddOrder](https://github.com/MaksGin/Restauracja/assets/26302413/588493d4-6325-41ff-a93a-2c685a13304d)


Cook has access to the list of dishes, categories and kitchen panel where orders come in and has the option of accepting the order for execution and transferring the order to be served by the waiter (then the order will appear in the waiter's panel and notify him that he need to pick up the dish from kitchen) or canceling the order.

![KitchenPanel](https://github.com/MaksGin/Restauracja/assets/26302413/df48c84a-ff4f-4400-ac6d-ac21c00e03eb)


Bartender / person working at the bar after logging in has access to the bar panel where drinks and desserts from individual orders come also he can check list of tables and list of drinks/meals.

![BarPanel](https://github.com/MaksGin/Restauracja/assets/26302413/fc9f24f4-9751-451a-b035-e4fb2e3193c9)


The process of creating an order, accepting the order by the kitchen, dividing the order into parts for the bar and kitchen, the waiter confirms that the order has been completed and the payment has been made and then the completed order goes to the waiter's report where there is a summary of the day, it is possible to download the report in pdf format.

![OgolnaPrezentacja](https://github.com/MaksGin/Restauracja/assets/26302413/b10b941d-3f72-48a1-85d4-9e6aee51f9aa)





### Built-with

Project is created with:
* Bootstrap 5.0
* PHP 8.2.4
* Laravel 10.19.0
* JavaScript and Ajax for enhanced interactivity

By using JavaScript and Ajax in the application, I wanted to make the user experience better by adding things like buttons and other elements that react when users click on them. This makes the app more interesting and easy to use. Also, Ajax helped me get data from the server without needing to refresh the whole page. This makes it feel smoother when you're looking through the app.

##### Laravel Eloquent
In my project, I utilized the Eloquent ORM model in Laravel, which offers numerous advantages. Eloquent ORM not only enhances the readability of code but also simplifies the management of database relationships and provides automatic object-relational mapping (ORM). This allowed me to create efficient and maintainable database interactions.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Setup
- PHP (version >= 8.2.4)
- composer
- Node.js and npm

### Instructions: 
1. Clone the repository on your local environment
   Start by cloning this repository to your local machine using the following command:
```
$ git clone https://github.com/MaksGin/Restauracja.git
$ cd folder-name
```
2. Install dependencies (use composer to install php dependecies and npm to install js dependencies)
```
composer install
npm install
```
3. Create an .env file and copy the entire contents of the env.example file to it

Update the file with the appropriate settings, such as data for the database, API keys, etc. Link to the documentation: https://laravel.com/docs/10.x/configuration#introduction

Generate app key:
```
php artisan key:generate
```

4. Run Migrations and Seed Data: Execute database migrations and seed sample data.
```
php artisan migrate
php artisan db:seed
```
5. Start the server
```
php artisan serve
npm run dev
```
6. Open the browser and navigate to
   http://localhost:8000 to see application in action.

  By following these steps, you'll have the Restaurant App set up on your local machine, and you can start exploring its features and functionalities. 

### Conclusions

When it comes to project translation, it is an important aspect and thanks to it you can reach more customers from all over the world, for larger projects than mine I would use translation in a database than in language files because it allows for greater dynamism and scalability.

Overall, I'm happy with the project I've done, but I'm also aware that there's still a lot of work to do.

Thank you for taking the time to explore this project!
