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
            const spanId = (data.type === 'upvote') ? `upvote-${postId}` : `downvote-${postId}`;
            const span = document.getElementById(spanId);
            
            let currentCount = parseInt(span.innerText);

            if(data.status === 'added') {
                span.innerText = currentCount + 1; 
            } else if (data.status === 'removed') {
                span.innerText = Math.max(0, currentCount - 1); 
            }
        } else {
            alert(data.message || "Generic Error");
        }
    })
    .catch(error => console.error('Error:', error));
}

// Funzione per il REPORT
function segnalaPost(postId) {
    if(!confirm("Do you really want to report this post?")) return;

    const formData = new FormData();
    formData.append('action', 'report');
    formData.append('post_id', postId);

    fetch('api-action.php', { method: 'POST', body: formData })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert("Report sent. Thank you..");
        } else {
            alert(data.message || "Error while reporting.");
        }
    })
    .catch(error => console.error('Error:', error));
}