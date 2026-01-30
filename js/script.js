document.addEventListener('DOMContentLoaded', function () {
    console.log("Página cargada correctamente / Page loaded successfully ✅");

    // Botón rojo (solo si existe)
    const btnRed = document.querySelector('.btn-red');
    if (btnRed) {
        btnRed.addEventListener('click', function () {
            window.scrollTo({
                top: window.innerHeight,
                behavior: 'smooth'
            });
        });
    }

    // Navbar scroll
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function () {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // Scroll automático a form-plato
    if (window.location.hash === "#form-plato") {
        const form = document.querySelector("#form-plato");
        if (form) {
            form.scrollIntoView({ behavior: "smooth" });
        }
    }
});



