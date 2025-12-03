const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebar-overlay');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

// HAMBURGER MENU 
menuBtn.addEventListener('click', () => {
    sidebar.classList.add('active');
    overlay.classList.add('active');
});

closeBtn.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});

const links = document.querySelectorAll('#sidebar a');
links.forEach(link => {
    link.addEventListener('mouseenter', function () {
        this.style.backgroundColor = '#f8f9fa';
    });
    link.addEventListener('mouseleave', function () {
        this.style.backgroundColor = 'transparent';
    });
});

//LIKE / DISLIKE / REPORT
function votaPost(postId, isUpvote) {
    const formData = new FormData();
    formData.append('action', 'vote');
    formData.append('post_id', postId);
    formData.append('is_upvote', isUpvote);

    fetch('api-action.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const upIcon = document.getElementById(`upvote-icon-${postId}`);
                const downIcon = document.getElementById(`downvote-icon-${postId}`);
                const upSpan = document.getElementById(`upvote-${postId}`);
                const downSpan = document.getElementById(`downvote-${postId}`);
                let upCount = parseInt(upSpan.innerText);
                let downCount = parseInt(downSpan.innerText);
                upIcon.classList.remove('text-primary', 'fw-bold');
                downIcon.classList.remove('text-danger', 'fw-bold');

                if (data.status === 'added') {
                    if (data.type === 'upvote') {
                        upIcon.classList.add('text-primary', 'fw-bold');
                        upSpan.innerText = upCount + 1;
                    } else {
                        downIcon.classList.add('text-danger', 'fw-bold');
                        downSpan.innerText = downCount + 1;
                    }
                }
                else if (data.status === 'removed') {
                    if (data.type === 'upvote') {
                        upSpan.innerText = Math.max(0, upCount - 1);
                    } else {
                        downSpan.innerText = Math.max(0, downCount - 1);
                    }
                }
                else if (data.status === 'swapped') {
                    if (data.type === 'upvote') {
                        upIcon.classList.add('text-primary', 'fw-bold');
                        upSpan.innerText = upCount + 1;
                        downSpan.innerText = Math.max(0, downCount - 1);
                    } else {
                        downIcon.classList.add('text-danger', 'fw-bold');
                        downSpan.innerText = downCount + 1;
                        upSpan.innerText = Math.max(0, upCount - 1);
                    }
                }
            } else {
                alert(data.message || "Errore");
            }
        })
        .catch(error => console.error('Errore:', error));
}
// Funzione per il REPORT
function segnalaPost(postId) {
    if (!confirm("Do you really want to report this post?")) return;

    const formData = new FormData();
    formData.append('action', 'report');
    formData.append('post_id', postId);

    fetch('api-action.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Report sent. Thank you..");
            } else {
                alert(data.message || "Error while reporting.");
            }
        })
        .catch(error => console.error('Error:', error));
}

//SEARCH BAR
function fetchSuggestions(searchTerm) {
    const resultsContainer = document.getElementById('search-suggestions');
    if (searchTerm.length < 2) {
        if (resultsContainer) {
            resultsContainer.innerHTML = ''; 
            resultsContainer.style.display = 'none';
        }
        return;
    }
    if (resultsContainer) {
        resultsContainer.style.display = 'block';
        resultsContainer.innerHTML = '<div class="p-2 text-center text-muted small">Caricamento...</div>';
    }
    fetch(`api-search-bar.php?q=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
            if (!resultsContainer) return; 
            
            let htmlContent = '';
            
            if (data.success && data.results && data.results.length > 0) {
                
                data.results.forEach(item => {
                    if (item.type === 'group') { 
                        const link = `forum.php?id=${item.id}`; 
                        htmlContent += `
                            <a href="${link}" class="dropdown-item d-flex align-items-center p-2">
                                <span class="bi bi-chat-dots me-2"></span> 
                                <span class="fw-bold">${item.name}</span>
                            </a>
                        `;
                    }
                });
            } else {
                htmlContent = `<div class="p-2 text-muted small">${data.message || 'Nessun risultato trovato.'}</div>`;
            }

            resultsContainer.innerHTML = htmlContent;
        })
        .catch(error => {
            console.error('Errore durante la ricerca:', error);
            if (resultsContainer) {
                resultsContainer.innerHTML = '<div class="p-2 text-danger small">Errore di rete o del server.</div>';
            }
        });
}

function handleImagePreview(event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');

    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            uploadPlaceholder.style.display = 'none';
        };
        
        reader.readAsDataURL(file);
    } else {
        // Ripristina la visualizzazione se l'utente annulla la selezione
        imagePreview.style.display = 'none';
        imagePreview.src = '#';
        uploadPlaceholder.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-btn');
    const fileInput = document.getElementById('postImageInput');

    if (menuBtn && sidebar && overlay) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    const links = document.querySelectorAll('#sidebar a');
    links.forEach(link => {
        link.addEventListener('mouseenter', function () {
            this.style.backgroundColor = '#f8f9fa';
        });
        link.addEventListener('mouseleave', function () {
            this.style.backgroundColor = 'transparent';
        });
    });
    
    const searchInput = document.getElementById('live-search-input');
    const searchWrapper = document.getElementById('live-search-wrapper');
    const resultsContainer = document.getElementById('search-suggestions');

    if (searchInput) {
        searchInput.addEventListener('keyup', (event) => {
            fetchSuggestions(event.target.value); 
        });
    }
    
    document.addEventListener('click', (event) => {
        if (searchWrapper && resultsContainer && !searchWrapper.contains(event.target)) {
            resultsContainer.style.display = 'none';
        }
    });

    if (fileInput) {
        fileInput.addEventListener('change', handleImagePreview);
    }
    document.addEventListener('click', (event) => {
        if (searchWrapper && resultsContainer && !searchWrapper.contains(event.target)) {
            resultsContainer.style.display = 'none';
        }
    });
});