# 🎓 School Partner CRUD App (Laravel 11 Assignment)

This is a Laravel 11-based assignment project that implements a full-featured CRUD system for managing school partners. It includes authentication, data export, server-side search, pagination, and a Blade-based dashboard UI.

---

##  Features

- JWT-based **authentication** (Login, Register, Logout)
- Full **CRUD** for `school_partners` (Create, Read, Update, Delete)
- **Search** and filter school partners by name or contact person
- **Paginated results** with responsive UI
- **Export** all records to Excel (XLSX) using Laravel Excel
- Show **logged-in user name** and a **logout** option in the dashboard
- Custom middleware (`CheckJwtAuth`) to protect web routes using localStorage JWT token
- UI built using **Blade**, Bootstrap, and some TailwindCSS

---

## API Endpoints

| Method | Endpoint                     | Description                      |
|--------|------------------------------|----------------------------------|
| POST   | `/api/register`              | Register a new admin             |
| POST   | `/api/login`                 | Login and get JWT token          |
| GET    | `/api/logout` (via JS)       | Logout (handled by clearing token) |
| GET    | `/school-partners`           | List paginated school partners   |
| POST   | `/school-partners`           | Create a new partner             |
| GET    | `/school-partners/{id}`      | View a partner                   |
| PUT    | `/school-partners/{id}`      | Update partner                   |
| DELETE | `/school-partners/{id}`      | Delete partner                   |
| GET    | `/school-partners/export`    | Export all partners to Excel     |

---

## Technologies Used

- **Laravel 11**
- **Blade Templating**
- **Bootstrap 5** + **TailwindCSS** (light use)
- **JWT Auth**: [`tymon/jwt-auth`](https://github.com/tymondesigns/jwt-auth)
- **Excel Export**: [`maatwebsite/excel`](https://github.com/Maatwebsite/Laravel-Excel)
- **Laravel Factory & Seeder** for demo data

---

## Authentication Flow

- Auth is handled via **Blade UI forms** using `fetch` to call the `JWT` API endpoints.
- On login, token is stored in `localStorage` and a `jwt_token` cookie.
- All web routes are protected by a custom middleware `CheckJwtAuth`, which checks for a valid JWT token in `localStorage`.

---

## Example UI Features

- Flash messages (success/fail) with close button and auto timeout
- Export button styled with `rounded-pill` class
- Search + Clear filter + Add New buttons in toolbar
- Table listing with action buttons (View/Edit/Delete)

---

## Setup Instructions

```bash
# 1. Clone the repository
git clone https://github.com/anshika282/school-partner-crud.git
cd school-partner-app

# 2. Install dependencies
composer install

# 3. Copy and configure .env
cp .env.example .env
# Update DB credentials and JWT_SECRET

# 4. Generate keys
php artisan key:generate
php artisan jwt:secret

# 5. Run migrations
php artisan migrate

# 6. Seed dummy data (optional)
php artisan db:seed --class=SchoolPartnerSeeder

# 7. Serve the app
php artisan serve
