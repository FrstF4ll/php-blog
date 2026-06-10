# php-blog

A blog built using Tailwind CSS V4, plain PHP and SQLite3 for the database. 

## Features

* Pages style with navigation
* Blog posts creation
* Posts managment (delete + edit)
* Full authentication method
* Categories for the articles

---

## Working on the project

### Prerequisites

Before you begin, ensure you have the following installed on your machine:
* **PHP** (with the `sqlite3` extension enabled)
* **Composer** (for php autoloading & dependencies)
* **Node.js & npm** (for building Tailwind CSS)
* **SQLite3 CLI** (*optional*, recommended for DB initialization)

## Installation 

1. **Clone the repository and go to the project directory** 
```bash
  git clone https://github.com/FrstF4ll/php-blog.git
  cd php-blog
```

2. **Install PHP dependencies**
```bash 
  composer install
```
3. **Install Node.js dependencies**
```bash
  npm install
```

### Database setup
Since this project uses SQLite, you need to set up a database file and run the initial migrations.

1. Create a **database.db** file.
```bash
  touch database.db
```

2. **If you're using SQLite CLI**, run the provided schema script to create the required tables (users and posts)
```bash
sqlite3 database.db < database/schema.sql
```

*You can also open your preferred SQLite GUI tool, connect to database.db, and execute the scripts located in database/schema.sql*

## Running the application

To properly work on the project, you'll need to run both PHP local server and Tailwind compiler

### PHP server

Go to project's root directory and run the following npm script, pointing to the **public/** folder. 

```bash
npm run dev
```

### Tailwind CSS

Open a separate terminal window and run the watcher using the following command. 

```bash
npm run watch:css
```

*If you only want to build the CSS once, you can also run `npm run build:css` for production-ready file.*
