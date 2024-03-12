const postitsApiUrl = "/api/postits/";

function renderPostIts() {
    const container = document.querySelector('.postit-container');
    container.innerHTML = '';
    postIts.forEach(postIt => {
        container.innerHTML += `
            <div class="postit" data-id="${postIt.id}">
                <h3>${postIt.title}</h3>
                <p>${postIt.content.replace(/\n/g,"<br>")}</p>
                <button class="editBtn btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="deleteBtn btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        `;
    });
    attachEventListeners();
}

function attachEventListeners() {
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const postItId = this.parentElement.getAttribute('data-id');
            const postIt = postIts.find(p => p.id == postItId);
            document.getElementById('editId').value = postIt.id;
            document.getElementById('editTitle').value = postIt.title;
            document.getElementById('editContent').value = postIt.content;
            $('#editModal').modal('show');
        });
    });

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce post-it ?')) {
                const postItId = this.parentElement.getAttribute('data-id');

                fetch(postitsApiUrl+postItId, {
                    method: 'DELETE', // Méthode HTTP
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La requête a échoué avec le statut ' + response.status);
                    }
                    return response.json(); // Convertir la réponse en JSON
                })
                .then(data => {
                    if(data.error){
                        throw new Error('Erreur lors de la suppression: '+data.error);
                    }
                    postIts = postIts.filter((p)=>(p.id!=postItId));
                    renderPostIts();
                })
                .catch(error => {
                    alert("Erreur lors de la suppression du postit: "+error);
                    console.error('Erreur lors de la requête:', error);
                });
            }
        });
    });

}

$( document ).ready(function() {

    document.getElementById('editPostItForm').addEventListener('submit', e => {
        e.preventDefault();
        const id = document.getElementById('editId').value;
        const title = document.getElementById('editTitle').value;
        const content = document.getElementById('editContent').value;
        const postItIndex = postIts.findIndex(p => p.id == id);
        backup = postIts[postItIndex];
        postIts[postItIndex] = { id, title, content };

        renderPostIts();

        fetch(postitsApiUrl+id, {
            method: 'PUT', // Méthode HTTP
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postIts[postItIndex]) // Convertir l'objet de données en chaîne JSON
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La requête a échoué avec le statut ' + response.status);
            }
            return response.json(); // Convertir la réponse en JSON
        })
        .then(data => {
            postIts[postItIndex].id = Number(data.id);
            postIts[postItIndex].user_id = Number(data.user_id);
            postIts[postItIndex].title = data.title;
            postIts[postItIndex].content = data.content;
            renderPostIts();
        })
        .catch(error => {
            postIts[postItIndex] = backup;
            alert("Erreur lors de la modification du postit: "+error);
            renderPostIts();
            console.error('Erreur lors de la requête:', error);
        });
        
        $('#editModal').modal('hide');
    });

    document.getElementById('createPostItForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const title = document.getElementById('createTitle').value;
        const content = document.getElementById('createContent').value;
        /*const maxId = postIts.reduce(function(prev, current) {
            return (prev && prev.id > current.id) ? prev : current
        })*/
        
        const newPostIt = {id: -1, title: title, content:content};
        postIts.push(newPostIt);
        renderPostIts();

        fetch(postitsApiUrl, {
            method: 'POST', // Méthode HTTP
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newPostIt) // Convertir l'objet de données en chaîne JSON
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La requête a échoué avec le statut ' + response.status);
            }
            return response.json(); // Convertir la réponse en JSON
        })
        .then(data => {
            const tempPostIt = postIts.find(p=>p.id==-1);
            tempPostIt.id = Number(data.id);
            tempPostIt.user_id = Number(data.user_id);
            tempPostIt.title = data.title;
            tempPostIt.content = data.content;
            renderPostIts();
        })
        .catch(error => {
            postIts = postIts.filter((p)=>p.id!=-1);
            alert("Erreur lors de l'ajout du postit: "+error);
            renderPostIts();
            console.error('Erreur lors de la requête:', error);
        });

    
        $('#createModal').modal('hide');
        document.getElementById('createTitle').value = '';
        document.getElementById('createContent').value = '';
        
    });

    $('.close').each(function() {
        $(this).click(function() {
            $('#editModal').modal('hide');
            $('#createModal').modal('hide');
        });
    });

    document.getElementById('showFormBtn').addEventListener('click', function() {
        $('#createModal').modal('show');
    });

    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        document.querySelectorAll('.postit').forEach(postit => {
            const title = postit.querySelector('h3').textContent.toLowerCase();
            const content = postit.querySelector('p').textContent.toLowerCase();
            if (title.includes(searchTerm) || content.includes(searchTerm)) {
                postit.style.display = '';
            } else {
                postit.style.display = 'none';
            }
        });
    });
    
    renderPostIts();    
});




