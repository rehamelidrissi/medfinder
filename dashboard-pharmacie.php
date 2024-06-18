<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmacy Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container mt-3">
  <h1 class="text-center mb-4">Pharmacy Dashboard</h1>
  <div class="mb-4">
    <h2>Ajouter une offre</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addOfferModal">Ajouter une offre</button>
  </div>
  <div class="container mt-3">
    <h2>Historique des demandes satisfaites</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prix</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $con = mysqli_connect('localhost', 'root', '', 'medfinder');
          if (!$con) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $result_satisfied = mysqli_query($con, "SELECT recherche.id_recherche, medicament.nom, medicament.prix
                                                  FROM medicament
                                                  INNER JOIN recherche ON medicament.id_medicament = recherche.id_medicament WHERE satisfait=1");
          while ($row_satisfied = mysqli_fetch_array($result_satisfied)) {
              echo '<tr>
                      <td>'. $row_satisfied['nom']. '</td>
                      <td>'. $row_satisfied['prix']. '</td>
                    </tr>';
          }
        ?>
      </tbody>
    </table>
  </div>

  <div class="row">
    <div class="col-md-8">
      <h2>Historique des offres</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité recherchée</th>
            <th>Opérations</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $result = mysqli_query($con, "SELECT recherche.id_recherche, recherche.quantite_recherche, medicament.prix, medicament.nom 
                                          FROM medicament
                                          INNER JOIN recherche ON medicament.id_medicament = recherche.id_medicament");
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>
                        <td>'. $row['nom']. '</td>
                        <td>'. $row['prix']. '</td>
                        <td>'. $row['quantite_recherche']. '</td>
                        <td>
                          <button class="btn btn-primary edit-offer" data-bs-toggle="modal" data-bs-target="#editOfferModal" 
                            data-id="'. $row['id_recherche']. '" data-name="'. $row['nom']. '" data-price="'. $row['prix']. '" 
                            data-quantity="'. $row['quantite_recherche']. '">Modifier</button>
                          <button class="btn btn-danger delete-offer" data-id="'. $row['id_recherche']. '">Supprimer</button>
                        </td>
                      </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Ajouter Offre -->
<div class="modal" id="addOfferModal" tabindex="-1" aria-labelledby="addOfferModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addOfferModalLabel">Ajouter une offre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addOfferFormModal">
          <div class="form-group">
            <label for="productNameModal">Nom</label>
            <input type="text" class="form-control" id="productNameModal" name="productNameModal" required>
          </div>
          <div class="form-group">
            <label for="productPriceModal">Prix</label>            <input type="number" class="form-control" id="productPriceModal" name="productPriceModal" required>
          </div>
          <div class="form-group">
            <label for="productQuantityModal">Quantité</label>
            <input type="number" class="form-control" id="productQuantityModal" name="productQuantityModal" required>
          </div>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Modifier Offre -->
<div class="modal" id="editOfferModal" tabindex="-1" aria-labelledby="editOfferModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOfferModalLabel">Modifier une offre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editOfferFormModal">
          <div class="form-group">
            <label for="editProductNameModal">Nom</label>
            <input type="text" class="form-control" id="editProductNameModal" name="editProductNameModal" required>
          </div>
          <div class="form-group">
            <label for="editProductPriceModal">Prix</label>
            <input type="number" class="form-control" id="editProductPriceModal" name="editProductPriceModal" required>
          </div>
          <div class="form-group">
            <label for="editProductQuantityModal">Quantité</label>
            <input type="number" class="form-control" id="editProductQuantityModal" name="editProductQuantityModal" required>
          </div>
          <input type="hidden" id="editProductIdModal" name="editProductIdModal">
          <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>

<!-- Script pour soumettre le formulaire d'ajout d'offre -->
<script>
$(document).ready(function() {
  // Écoutez la soumission du formulaire d'ajout
  $("#addOfferFormModal").submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Get form values
    var productName = $("#productNameModal").val();
    var productPrice = $("#productPriceModal").val();
    var productQuantity = $("#productQuantityModal").val();

    // Send data to the server via AJAX
    $.ajax({
      url: "ajouter-offre.php",
      method: "POST",
      dataType: "json",
      data: {
        nom: productName,
        prix: productPrice,
        quantite_recherche: productQuantity
      },
      success: function(data) {
        if (data.success) {
          alert("Offre ajoutée avec succès.");
          location.reload(); // Reload the page to show new data
        } else {
          alert("Erreur lors de l'ajout de l'offre. Veuillez réessayer.");
        }
      },
      error: function(error) {
        console.error("Erreur lors de l'ajout de l'offre:", error);
        alert("Erreur lors de l'ajout de l'offre. Veuillez réessayer.");
      }
    });
  });

  // Charger les données dans le formulaire de modification
  $(".edit-offer").click(function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var quantity = $(this).data('quantity');

    $("#editProductIdModal").val(id);
    $("#editProductNameModal").val(name);
    $("#editProductPriceModal").val(price);
    $("#editProductQuantityModal").val(quantity);

    // Affichez la modale de modification
    $('#editOfferModal').modal('show');
  });

  // Écoutez la soumission du formulaire de modification
  $("#editOfferFormModal").submit(function(event) {
    event.preventDefault(); // Empêche le formulaire d'être soumis normalement

    // Récupérez les valeurs des champs
    var id = $("#editProductIdModal").val();
    var name = $("#editProductNameModal").val();
    var price = $("#editProductPriceModal").val();
    var quantity = $("#editProductQuantityModal").val();

    // Envoyez les données au serveur via AJAX
    $.ajax({
      url: "modifier-offre.php",
      method: "POST",
      dataType: "json",
      data: {
        id: id,
        nom: name,
        prix: price,
        quantite_recherche: quantity
      },
      success: function(data) {
        if (data.success) {
          alert("Offre modifiée avec succès.");
          location.reload(); // Rechargez la page pour afficher les nouvelles données
        } else {
          alert("Erreur lors de la modification de l'offre. Veuillez réessayer.");
        }
      },
      error: function(error) {
        console.error("Erreur lors de la modification de l'offre:", error);
        alert("Erreur lors de la modification de l'offre. Veuillez réessayer.");
      }
    });
  });

  // Supprimer une offre
  $(".delete-offer").click(function() {
    if (confirm("Voulez-vous vraiment supprimer cette offre ?")) {
      var id = $(this).data('id');

      $.ajax({
        url: "supprimer-offre.php",
        method: "POST",
        dataType: "json",
        data: { id: id },
        success: function(data) {
          if (data.success) {
            alert("Offre supprimée avec succès.");
            location.reload(); // Rechargez la page pour afficher les nouvelles données
          } else {
            alert("Erreur lors de la suppression de l'offre. Veuillez réessayer.");
          }
        },
        error: function(error) {
          console.error("Erreur lors de la suppression de l'offre:", error);
          alert("Erreur lors de la suppression de l'offre. Veuillez réessayer.");
        }
      });
    }
  });
});
</script>
</body>
</html>

