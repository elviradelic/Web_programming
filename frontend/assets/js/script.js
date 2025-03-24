$(document).ready(function () {
    if (!$.spapp) {
        console.error("SPApp nije pronađen! Proveri da li je `jquery.spapp.min.js` pravilno učitan.");
        return;
    }

    console.log("SPApp uspešno pokrenut.");

    if (typeof myEvents === 'undefined') {
        var myEvents = [];
    }


    var app = $.spapp({
        defaultView: "home",
        templateDir: "views/"
    });

    var routes = [
        { view: "home", load: "home.html" },
        { view: "services", load: "services.html" },
        { view: "about", load: "about.html" },
        { view: "gallery", load: "gallery.html" },
        { view: "contact", load: "contact.html" },
        { view: "events", load: "events.html" },
        { view: "event-details", load: "event-details.html" },
        { view: "dashboard", load: "dashboard.html" },
        { view: "profile", load: "profile.html" },
        { view: "settings", load: "settings.html" },
        { view: "create-event", load: "create-event.html" },
        { view: "login", load: "login.html" },
        { view: "register", load: "register.html" },
        { view: "manage-users", load: "manage-users.html" },
        { view: "my-reservations", load: "my-reservations.html" }
    ];

    routes.forEach(function (route) {
        app.route(route);
        console.log("Dodana ruta:", route.view, "učitava:", route.load);
    });

    app.run();

    console.log("SPApp je pokrenut sa početnim prikazom:", app.defaultView);
});

