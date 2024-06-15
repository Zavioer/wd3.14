# Endeal

Application designed for commercial companies and sales representatives.
It automates the process of adding new orders, items for sale, and customers.
It also provides basic analytical data such as monthly profit and top-selling products.
It operates in two modes: 
- mobile - for sales representatives to easily add orders from their phone or tablet,
- web - allowing for listing orders, products, and customers, as well as displaying reports.

In today's world, automation, data gathering, and analysis are crucial, and the Endeal application meets these standards.

# Table of Contents 

1. [Features](#features)
2. [Technology Stack](#technology-stack)
3. [Architecture](#architecture)
4. [Installation](#installation)
5. [Screens of app](#screens-of-app)
6. [Contributing](#contributing)
7. [License](#license)


## Features

- **products and clients management** - adding, displaying and modifying.
- **placing orders** - considering inventory levels.
- **user management** - ability to add new salespeople or analysts with specific resource permissions.
- **dashboard** - presenting sales reports.
- **ease of installation** - the application is fully containerized, making it very easy to run.
- **responsive design** - support variety of screen sizes e.g. mobile devices, laptops, and monitors.
- **simplicity** - the graphical user interface is designed to be straightforward and intuitive for ease of use.

## Technology Stack

A good tool for business must be reliable and dependable, which is why proven technologies were used in the project.

1. **PHP** - back-end site, used to create micro web framework.
2. **PostgreSQL** - modern and solid database with multiple of possibilites.
3. **HTML, CSS** - front-end site, structuring and styling user interface.
4. **JavaScript** - add dynamic to website also charts (Charts.js lib).
5. **Nginx** - high-performance web server.
6. **Docker** - containerization of the application for easy development and deployment.

## Architecture

1. Database  
    - `ERD (Entity-Relationship Diagram)`- visual representaiton of tables and entity properites used in project.
    - available to see in [/docs/endeal_erd.pdf](/docs/endeal_erd.pdf) file.
    - SQL files with detailed definitions are placed in `/docker/db/sql`. File `main.sql` work as entry point to recreate db on startup.
    
2. App
    - use `MVC (Model-View-Controller)` to separate business logic from presentation layer.
    - repository patter for easy access to data persistance.
    - separated mobile version prepared for tranformation to PWA in future.

## Installation

1. Clone repository and navigate to project folder.
2. Fill variables in `.env.example` file with you own secrets.
3. Rename this file to `.env` (on linux with command `mv .env.example .env`).
4. Change `admin` account details in file `/docker/db/sql/admin.sql`.
5. Build container images `docker compose build`.
6. Run `docker compose up`.
7. App is ready to use.

**`/docker/db/admin.sql` config admin user with weak password `asdf` must be change in production use**

## Screens of app

### Dashboard

Web view of dashboard with reports.
![Dashboard](/docs/img/dashboard.png)

### Add new product

Mobile view of add product.
![Add product](/docs/img/add_product_mobile.png)

### List products

Listing products on mobile screen.
![List products](/docs/img/list_product_mobile.png)

### Modify client

Example of update forms, in this case `Client` model.
![Modify client](/docs/img/client_modify.png)

### Add new salesman

Creation form for `User` model.
![Create salesman](/docs/img/add_salesman.png)

### Salesman mobile home

Home page for mobile version dedicated to salesmans.
![Salesman home mobile](/docs/img/salesman_home.png)

### Add order

Add order form from mobile version.
![Add order](/docs/img/salesman_add_order.png)

### List salesman

List of users with roles.
![List salesmans](/docs/img/list_salesman.png)

## Contributing

Always looking for good advices how app can be improved, and requests for new features :)


## License

This project is licensed under the MIT License.
