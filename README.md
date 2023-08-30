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
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#conslusions">Conslusions</a></li>
  </ol>
</details>


## About The Project

The "Restaurant App" is an application that can serve as a representation of restaurant in polish city. Its minimalist design and responsiveness allow for easy and enjoyable user interactions.
The primary goal of this project was to elevate my programming skills while simultaneously crafting a practical application that showcases my abilities. Developed during my spare time, the project embodies my dedication to continuous learning and improvement within the realm of software development.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Features

#### Restaurant App offers

Application created in Polish with the ability to translate the application into English for foreign users. The main page for the client can be translated fully. I have introduced a partial translation for the employee.

##### For non-login users
The main page offers a full list of restaurant dishes and the ability to book a table.

/post a gif here/


##### For logged users
The login panel is used to log in to individual restaurant employees, offers different views and access to functionalities for the WAITER, COOK, BARTENER and MANAGER.

After Login you get access to Orders Page where you can see list of todays orders, with details like Table Number, Order Status and price.
![OrdersPage](https://github.com/MaksGin/Restauracja/assets/26302413/8c6444ae-404f-41bc-8a02-37de2a379a76)

You can click on specific order and display content of the order.

![OrderDetails](https://github.com/MaksGin/Restauracja/assets/26302413/a6487bdf-9ba0-459a-bb5c-c7a459d69154)


Manager has access to all application functions available to other users, additionally he can display and manage the list of employees and manage the list of job positions.
img

Waiter has a view of current orders, can create new orders, and has access to his own panel where orders come from the kitchen and are ready to serve, then he can click the button "completed and paid"
/add new order image/ raports img/ and waiter panel img

Cook has access to the list of dishes, categories and kitchen panel where orders come in and has the option of accepting the order for execution and transferring the order to be served by the waiter (then the order will appear in the waiter's panel and notify him that he need to pick up the dish from kitchen) or canceling the order.
/kitchen panel img/

Bartender / person working at the bar after logging in has access to the bar panel where drinks and desserts from individual orders come.
/bar panel img/



### Build With

Project is created with:
* Bootstrap
* PHP 8.2.4
* Laravel 10.19.0
* JavaScript and Ajax for enhanced interactivity

By using JavaScript and Ajax in the application, I wanted to make the user experience better by adding things like buttons and other elements that react when users click on them. This makes the app more interesting and easy to use. Also, Ajax helped me get data from the server without needing to refresh the whole page. This makes it feel smoother when you're looking through the app.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Setup
- PHP (version >= 8.2.4)
- composer
- Node.js and npm

### Instructions: 
1. Clone the repository on your local environment
   Start by cloning this repository to your local machine using the following command:
```
$ git clone [<repository-url>]([https://github.com/MaksGin/StudentManagmentCrud.git](https://github.com/MaksGin/Restauracja.git))
$ cd folder-name
```
2. Install dependencies (use composer to install php dependecies and npm to install js dependencies)
```
composer install
npm install
```
3. Run Migrations and Seed Data: Execute database migrations and seed sample data.
```
php artisan migrate
php artisan db:seed
```
4. Start the server
```
php artisan serve
npm run dev
```
5. Open the browser and navigate to
   http://localhost:8000 to see application in action.

  By following these steps, you'll have the Restaurant App set up on your local machine, and you can start exploring its features and functionalities. 

### Conclusions

When it comes to project translation, it is an important aspect and thanks to it you can reach more customers from all over the world, for larger projects than mine I would use translation in a database than in language files because it allows for greater dynamism and scalability.

