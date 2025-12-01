//ADMIN
function inviaAzione(action, postId) {
        if (action === 'delete' && !confirm("Sei sicuro di voler eliminare questo post definitivamente?")) {
            return;
        }
        const formData = new FormData();
        formData.append('action', action);
        formData.append('postId', postId);
        fetch('api-admin.php', {
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
