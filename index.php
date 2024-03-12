<?php
require_once __DIR__.'/config.php';

$stmt = $pdo->prepare('SELECT * FROM postits WHERE user_id = ?');
$stmt->execute([$gUserId]);
$postIts = $stmt->fetchAll();

$postItsJson = json_encode($postIts);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Babillard de Post-its Électroniques</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="./styles.css?val=1" />

    <script>
      let postIts = <?= $postItsJson ?>;
    </script>
  </head>
  <body>
    <header class="bg-primary text-white text-center py-3">
      <h1>Babillard de Post-its Électroniques</h1>
    </header>

    <div class="container my-4">
      <div class="d-flex justify-content-between">
        <div>
          <button id="showFormBtn" class="btn btn-success mb-3">
            Ajouter Post-it
          </button>
        </div>
        <div>
          <input
            type="text"
            id="searchInput"
            class="form-control"
            placeholder="Rechercher un Post-it"
          />
        </div>
      </div>

      <section id="listePostIts">
        <h2>Liste des Post-its</h2>
        <div
          class="postit-container d-flex flex-wrap justify-content-around align-items-start"
        >
          <!-- Exemple de post-it -->
          <!--<div class="postit">
            <h3>Rencontre d'équipe</h3>
            <p>
              Rappel : réunion d'équipe demain à 10h00 en salle de conférence.
            </p>
            <button class="editBtn btn btn-sm btn-warning">
              <i class="fas fa-edit"></i>
            </button>
            <button class="deleteBtn btn btn-sm btn-danger">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>-->
        </div>
      </section>
    </div>

    <footer class="bg-primary text-white text-center py-3 fixed-bottom">
      <p>&copy; 2024 Babillard de Post-its Électroniques</p>
    </footer>

    <script src="./script.js"></script>

    <!-- Fenêtre modale pour la modification des post-its -->
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modifier Post-it</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editPostItForm">
              <input type="hidden" id="editId" />
              <div class="form-group">
                <label for="editTitle">Titre:</label>
                <input
                  type="text"
                  id="editTitle"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label for="editContent">Contenu:</label>
                <textarea
                  id="editContent"
                  class="form-control"
                  required
                ></textarea>
              </div>
              <button type="submit" class="btn btn-primary">
                Sauvegarder les changements
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Fenêtre modale pour la création des post-its -->
    <div
      class="modal fade"
      id="createModal"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
      style="display: none"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Créer un Nouveau Post-it</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="createPostItForm">
              <div class="form-group">
                <label for="createTitle">Titre:</label>
                <input
                  type="text"
                  id="createTitle"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label for="createContent">Contenu:</label>
                <textarea
                  id="createContent"
                  class="form-control"
                  required
                ></textarea>
              </div>
              <button type="submit" class="btn btn-primary">
                Créer Post-it
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
