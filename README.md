Event Management System
Web Programming Course Project

The Event Management System is a web application that allows users to create, organize, and participate in various events. The project is developed as part of the Web Programming course and is divided into five clearly defined phases (milestones).

-----------------------------------------------------------------------------------------

Implemented Features

Milestone 1 – Frontend and SPA Setup

-Implemented Single Page Application (SPA) using jQuery SPApp
-Established project structure with separate frontend and backend folders
-Designed the static frontend using HTML, CSS, and JS based on the EventPlanner template
-Navigation between pages is handled without reloading, fully compliant with SPA principles
-Responsive and modern design achieved with Bootstrap and custom CSS

Implemented pages:

-Home

-Gallery

-Contact

-Events

-Event Details

-Login & Register

-Profile

-Settings

-Create Event

------------------------------------------------------------------------------------------------

Milestone 2 – Backend Setup and DAO Layer

-Created a relational MySQL database with at least five entities

-Implemented a DAO layer using PHP and PDO for database interaction

Developed the following DAO classes:
-UserDao

-CategoryDao

-EventDao

-ReservationDao

-FeedbackDao

Each DAO includes full CRUD functionality:
-Create (POST)

-Read (GET)

-Update (PUT)

-Delete (DELETE)

Database schema was successfully created and verified using DBeaver.

-------------------------------------------------------------------------------------------------

Database and ER Diagram

The database contains the following core entities:
-Users – Stores user data (full name, email, password, role)

-Events – Event details (name, description, date, location, category)

-Categories – Event categories (e.g. Conference, Festival, Wedding)

-Reservations – Event registrations by users

-Feedback – Contact form messages and feedback

Relationships between entities are properly structured to support application functionality.

--------------------------------------------------------------------------------------------------





