# Web_programming

Event Management System

Event Management System is a web application that allows users to create, organize and participate in various events. This application was developed as part of the Web Programming course, and the implementation takes place through several phases (milestones).

Currently implemented functionalities (Milestone 1):
✅ Single Page Application (SPA) – Navigation takes place without refreshing the page, using jQuery SPApp.
✅ Project structure – Separated frontend and backend directories in accordance with SPA principles.
✅ Frontend design – All necessary static files and pages created according to the EventPlanner template.
✅ Navigation and UI design – Bootstrap and custom CSS for a modern and responsive design.
✅ Pages implemented:

Home

Gallery

Contact

Events

Event Details

Login & Register

Profile

Settings

Create Event

---------------------------------------------------

As part of the database planning, 5 main entities with their mutual relationships were defined:

1️⃣ Users – Contains user data (name, email, password, role)

2️⃣ Events – Event details (name, description, location, date, category, organizer)

3️⃣ Categories – Event categories (Conference, Festival, Networking, Weddings...)

4️⃣ Registrations – User registrations for events (which user is going to which event)

5️⃣ Messages – User messages from the contact form

📌 ER Diagram:

![alt text](<ER_Diagram - Database.png>)

-----------------------------------------------------

Live Demo (Deployed Link)
🔗 []

Tehnologije koje su korišćene
Frontend: HTML, CSS (Bootstrap), JavaScript (jQuery, jQuery SPApp)

Backend (u narednim fazama): PHP (FlightPHP), MySQL, PHP PDO, JWT autentifikacija

Deployment: GitHub Pages / Netlify (za frontend), Heroku / DigitalOcean (za backend)

Napomena: Frontend nije završen, biti će još dorade na njemu definitivno