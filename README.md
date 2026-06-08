# Portfolio Website — Janisha Jaya

**NIM:** 412024033  
**Mata Kuliah:** Web Programming 2  
**Framework:** CodeIgniter 4.7 · PHP 8.2 · MariaDB

---

## About

Personal portfolio website with a full admin panel for managing articles, gallery photos, and contact messages. Built as the WP2 Final Project.

**Public pages:** Home, About, Projects, News/Articles, Gallery, Contact, Credits  
**Admin panel:** Dashboard, Articles CRUD, Gallery CRUD, Messages inbox

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | CodeIgniter 4.7 (PHP 8.2) |
| Database | MariaDB (port 3307) |
| Frontend (public) | Bootstrap 5, jQuery |
| Frontend (admin) | Tailwind CSS, Material Symbols |
| Local server | XAMPP |

---

## Requirements

- XAMPP (Apache + MariaDB)
- PHP 8.2+
- Composer

---

## Installation

**1. Clone / copy project**

```
C:\xampp\htdocs\412024033_Janisha_Jaya\
```

**2. Install dependencies**

```bash
composer install
```

**3. Configure environment**

Copy `env` to `.env`, then edit:

```
CI_ENVIRONMENT = development

app_baseURL = 'http://localhost/412024033_Janisha_Jaya/public/'

database.default.hostname = localhost
database.default.database = 20222_wp2_412024033
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

**4. Create the database**

In phpMyAdmin, create a database named `20222_wp2_412024033` and import the SQL dump.

Tables required: `articles`, `gallery`, `messages`, `users`

**5. Access the site**

| URL | Description |
|---|---|
| `http://localhost/412024033_Janisha_Jaya/public/` | Public portfolio |
| `http://localhost/412024033_Janisha_Jaya/public/administrator/login` | Admin login |

---

## Project Structure

```
app/
├── Controllers/
│   ├── Admin.php          # Admin panel (auth + CRUD)
│   └── Pages.php          # Public portfolio pages
├── Models/
│   ├── ArticleModel.php
│   ├── GalleryModel.php
│   ├── MessageModel.php
│   └── UserModel.php
├── Views/
│   ├── pages/             # Public page views
│   ├── administrator/     # Admin panel views
│   └── includes/          # Shared partials (nav, footer)
├── Filters/
│   └── AdminFilter.php    # Auth guard for admin routes
└── Config/
    ├── Routes.php
    └── Filters.php

public/
├── assets/
│   ├── css/               # Compiled stylesheets
│   ├── js/                # Scripts
│   └── images/            # Uploaded gallery images
└── ajax/
    └── save_contact.php   # Contact form endpoint
```

---

## Admin Credentials

Register a new account at `/administrator/register`, or use an existing account in the `users` table (passwords are bcrypt-hashed).

---

## Features

- Article management — create, edit, delete, export to XML
- Gallery management — upload, edit, delete photos
- Contact messages — view inbox from portfolio contact form
- Session-based authentication with password hashing
