# Pet Sitting App – Trone Admission Test

A full-stack pet sitting management application built with **Vue 3** (frontend) and **PHP (PDO + MVC)** on the backend.

The application allows users to manage pets and schedule pet sitting appointments through a clean API-driven architecture.

---

## 🚀 Tech Stack

### Frontend
- Vue 3 (Composition API)
- Vue Router
- Axios
- Raw CSS (custom styling)

### Backend
- PHP 8+
- PDO (MySQL)
- MVC Architecture
- RESTful API

### Database
- MySQL

---

## 📦 Features

### Core Features (Required)
- Create, read, update, delete pets
- Pets have:
  - Name
  - Breed
  - Size (small / medium / large)
  - Birthdate
  - Created & updated timestamps
- Frontend form for creating and editing pets
- Live updates without page refresh
- Proper form validation
- Confirmation dialog before deleting a pet

### Bonus Features
- Appointment scheduling system (backend)
  - Stores pet ID
  - Pet sitter name
  - Date
  - Time
  - Duration
- Clean API endpoints for appointments
- Modular MVC backend structure

---

## 🗂 Project Structure

```
pet-sitting-app/
│
├── backend/
│   ├── app/
│   │   ├── Controllers/
│   │   ├── Services/
│   │   ├── Repositories/
│   │   ├── Models/
│   │   ├── Core/
│   │   └── routes/
│   ├── database/
│   │   └── migrations/
│   └── public/
│
└── frontend/
    ├── src/
    │   ├── components/
    │   ├── views/
    │   ├── router/
    │   ├── axios.js
    │   └── main.css
    └── index.html
```

---

## 🛠 Setup Instructions

### Prerequisites
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Node.js 16+ and npm
- Composer (optional, if using dependencies)

### Backend Setup

1. **Create a MySQL database:**
   ```sql
   CREATE DATABASE pet_sitting_app;
   ```

2. **Configure database connection:**
   
   Update the database credentials in:
   ```
   backend/app/Core/Database.php
   ```
   
   Example:
   ```php
   return new PDO(
       "mysql:host=localhost;dbname=pet_sitting_app",
       "root",
       "",
       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );
   ```

3. **Run migrations:**
   ```bash
   cd backend
   php database/migrate.php
   ```

4. **Start the PHP server:**
   ```bash
   php -S localhost:8000 -t public
   ```
   
   The API will be available at:
   ```
   http://localhost:8000
   ```

### Frontend Setup

1. **Install dependencies:**
   ```bash
   cd frontend
   npm install
   ```

2. **Run the dev server:**
   ```bash
   npm run dev
   ```

3. **Open in browser:**
   
   Navigate to `http://localhost:5173`

---

## 🧪 API Endpoints

### Pets

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/pets` | Get all pets |
| POST | `/api/pets` | Create a new pet |
| PUT | `/api/pets/{id}` | Update a pet |
| DELETE | `/api/pets/{id}` | Delete a pet |

### Appointments (Bonus)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/appointments` | Get all appointments |
| POST | `/api/appointments` | Create a new appointment |
| DELETE | `/api/appointments/{id}` | Delete an appointment |

---

## 🏗 Architecture

This application follows a clean **MVC architecture** with clear separation of concerns:

- **Controllers** – Handle HTTP requests and responses
- **Services** – Contain business logic
- **Repositories** – Manage database operations
- **Models** – Represent data structures
- **Core** – Database connection and utilities

This structure ensures:
- ✅ Maintainability
- ✅ Testability
- ✅ Scalability
- ✅ Single responsibility principle

---

## ✅ Requirements Checklist

### Required Features
- [x] CRUD operations for pets
- [x] Vue 3 frontend
- [x] PHP backend with PDO
- [x] Database design and migrations
- [x] Form validation (frontend and backend)
- [x] Live updates without page refresh
- [x] Delete confirmation dialog
- [x] Error handling

### Bonus Features
- [x] Appointment scheduling system (backend)
- [x] RESTful API design
- [x] MVC architecture with service layer

---

## 📝 Notes

- Backend is structured using MVC with repository and service layers for clean separation of concerns
- API returns meaningful error messages with appropriate HTTP status codes
- Frontend handles validation and backend errors gracefully
- Styling is intentionally kept lightweight and readable using raw CSS
- Database migrations allow for version-controlled schema changes

---

## 👤 Author

**Muhammad Faizan**  
Trone Admission Test

---

## 📄 License

This project is created as part of an admission test assessment.