//ADMIN
function inviaAzione(action, postId) {
    if (action === 'delete' && !confirm("Are you sure you want to permanently delete this post?")) {
        return;
    }
    const formData = new FormData();
    formData.append('action', action);
    formData.append('postId', postId);
    fetch('api-admin-post.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const postElement = document.getElementById('post-' + postId);
                if (postElement) {
                    postElement.style.transition = "opacity 0.5s ease";
                    postElement.style.opacity = "0";
                    setTimeout(() => postElement.remove(), 500);
                }
                if (document.querySelectorAll('article').length <= 1) {
                    setTimeout(() => location.reload(), 600);
                }
            } else {
                alert("Errore: " + data.message);
            }
        })
        .catch(error => {
            console.error('Errore:', error);
            alert("Errore di comunicazione col server.");
        });
}
function deleteForum(forumId) {
    if (!confirm("Sei sicuro di voler eliminare questo forum?")) {
        return;
    }

    const formData = new FormData();
    formData.append('action', 'delete_forum');
    formData.append('forumId', forumId);
    fetch('/WebProject/website/src/api-admin-forum.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const postElement = document.getElementById("row-" + forumId);
                if (postElement) {
                    postElement.style.transition = "opacity 0.5s ease";
                    postElement.style.opacity = "0";
                    setTimeout(() => postElement.remove(), 500);
                } else {
                    location.reload();
                }
                const list = document.querySelector('ul.list-unstyled');
                if (list && list.children.length === 0) {
                    list.innerHTML = '<div class="alert alert-info mt-3">Nessun forum presente.</div>';
                }

            } else {
                alert("Errore dal server: " + data.message);
            }
        })
        .catch(error => {
            console.error(error);
            alert("Errore di connessione.");
        });
}