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

    // UI po roli/tokenu
    const token = localStorage.getItem('token');
    const role = localStorage.getItem('role');

    if (token && role) {
        $('#logout-btn').show();

        if (role === 'admin') {
            $('#admin-link').show();
        } else {
            $('#admin-link').hide();
        }
    } else {
        $('#logout-btn').hide();
        $('#admin-link').hide();
    }
});

// LOGIN
$(document).on('submit', '#login-form', function (e) {
    e.preventDefault();

    const data = {
        email: $('#login-email').val(),
        password: $('#login-password').val()
    };

    $.ajax({
        url: 'http://localhost/ElviraDelic/Web_programming/backend/rest/login',
        type: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        success: function (response) {
    console.log("Odgovor sa servera:", response);

    if (!response || !response.token) {
        alert("Login uspješan, ali token nije vraćen od servera!");
        return;
    }

    localStorage.setItem('token', response.token);

    try {
        const payload = JSON.parse(atob(response.token.split('.')[1]));
        localStorage.setItem('role', payload.user.role);
    } catch (error) {
        console.error("Greška pri parsiranju tokena:", error);
        alert("Login nije uspio zbog neispravnog tokena.");
        return;
    }

    alert("Uspješan login!");
    window.location.href = '#dashboard';
},


        error: function () {
            alert("Login nije uspio!");
        }
    });
});

// REGISTRACIJA
$(document).on('submit', '#register-form', function (e) {
    e.preventDefault();

    const data = {
        full_name: $('#register-name').val(),
        email: $('#register-email').val(),
        password: $('#register-password').val(),
        role: 'user'
    };

    $.ajax({
        url: 'http://localhost/ElviraDelic/Web_programming/backend/rest/register',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function () {
            alert("Registracija uspješna! Prijavite se.");
            window.location.href = '#login';
        },
        error: function () {
            alert("Registracija nije uspjela!");
        }
    });
});

// LOGOUT
$(document).on('click', '#logout-btn', function () {
    localStorage.removeItem('token');
    localStorage.removeItem('role');
    alert("Odjavljeni ste.");
    window.location.href = '#login';
});
