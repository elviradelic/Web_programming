# Event Management System  
**Web Programming Course Project**

The Event Management System is a web application that allows users to create, organize, and participate in various events. The project is developed as part of the Web Programming course and is divided into five clearly defined phases (milestones).

---

## Implemented Features  

### Milestone 1 – Frontend and SPA Setup  

- Implemented Single Page Application (SPA) using **jQuery SPApp**  
- Established project structure with separate frontend and backend folders  
- Designed the static frontend using **HTML, CSS, and JS** based on the EventPlanner template  
- Navigation between pages is handled without reloading, fully compliant with SPA principles  
- Responsive and modern design achieved with **Bootstrap** and custom CSS  

**Implemented pages:**  

- Home  
- Gallery  
- Contact  
- Events  
- Event Details  
- Login & Register  
- Profile  
- Settings  
- Create Event  

---

### Milestone 2 – Backend Setup and DAO Layer  

- Created a relational **MySQL database** with at least five entities  
- Implemented a **DAO layer** using **PHP and PDO** for database interaction  

**Developed DAO classes:**  

- UserDao  
- CategoryDao  
- EventDao  
- ReservationDao  
- FeedbackDao  

**Each DAO includes full CRUD functionality:**  

- Create (POST)  
- Read (GET)  
- Update (PUT)  
- Delete (DELETE)  

Database schema was successfully created and verified using **DBeaver**.  

---

### Milestone 3 – FlightPHP Integration and Repository Pattern  

- Integrated **FlightPHP framework** for backend routing  
- Implemented REST API endpoints for all core entities (User, Event, Category, Reservation, Feedback)  
- Connected routes with DAO layer for database operations  
- Implemented **Repository layer** to separate business logic from data access  
- Organized project structure into `dao`, `repository`, `services`, and `config` folders for better maintainability  
- Configured **database.php** for MySQL connection  
- Tested API endpoints using **Swagger (OpenAPI)** documentation  

---

### Milestone 4 – Authentication, Authorization, and Middleware  

- Implemented **JWT (JSON Web Token) authentication** for secure login and session management  
- Added **middleware** for role-based authorization (regular users vs. admins)  
- Protected sensitive API routes and enabled access control  
- Extended functionality for **Reservations** and **Feedback** (create, edit, delete, view by user)  
- Added input validation for API requests and improved error handling with proper HTTP status codes  
- On the frontend, implemented **protected routes** so only logged-in users can access certain pages  
- Managed token storage in frontend (local/session storage) and sending tokens via `Authorization` header  
- Implemented automatic logout/session expiration on invalid or expired tokens  
- Improved user experience with error/success messages on login, reservation, and feedback operations  

---

### Milestone 5 – Planned / Additional Features  

- Full **admin panel** for managing users, events, categories, reservations, and feedback  
- Implement **real-time updates** using AJAX for reservations and feedback without page reloads  
- Add **search, filter, and sorting** functionalities for events and reservations  
- Implement **email notifications** for event registration confirmations and updates  
- Improve **frontend design** and accessibility compliance (WCAG standards)  
- Add **unit and integration tests** for backend API and frontend interactions  

---

## Database and ER Diagram  

The database contains the following core entities:  

- **Users** – Stores user data (full name, email, password, role)  
- **Events** – Event details (name, description, date, location, category)  
- **Categories** – Event categories (e.g., Conference, Festival, Wedding)  
- **Reservations** – Event registrations by users  
- **Feedback** – Contact form messages and feedback  

Relationships between entities are properly structured to support application functionality.  
