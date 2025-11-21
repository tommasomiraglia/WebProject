const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

// Apri sidebar
menuBtn.addEventListener('click', () => {
    sidebar.classList.add('active');
    overlay.classList.add('active');
});

// Chiudi sidebar
closeBtn.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});

// Chiudi sidebar cliccando sull'overlay
overlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});

// Aggiungi effetto hover ai link (opzionale, con Bootstrap utilities)
const links = document.querySelectorAll('#sidebar a');
links.forEach(link => {
    link.addEventListener('mouseenter', function () {
        this.style.backgroundColor = '#f8f9fa';
    });
    link.addEventListener('mouseleave', function () {
        this.style.backgroundColor = 'transparent';
    });
});