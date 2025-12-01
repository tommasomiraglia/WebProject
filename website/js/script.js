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

// Aggiungi effetto hover ai link
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
