<?php
include 'entete.php';

if (!empty($_GET['matre'])) {
    $employe = getemploye($_GET['matre']);
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6; // Nombre d'articles par page
$offset = ($page - 1) * $limit;

?>
<?php 
if (!isset($_GET['matre'])) {
    // Générer un nouveau matricule
    $matricule = generateMatricule($connexion);
} else {
    // Lors de la modification, récupérer le matricule actuel
    $id = $_GET['matre'];
    $stmt = $connexion->prepare("SELECT matricule FROM temploye WHERE matre = :matre");
    $stmt->execute(['matre' => $id]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    $matricule = $employee['matricule'];
}
?>
<script>
    
        function Calcul() {
            const dateAField = document.getElementById('datedebut');
            const dateCalculField = document.getElementById('dateentresolde');
            const soldeCongeField = document.getElementById('soldeconge');
            
            // Obtenez la date à partir du champ de date_a
            const dateAValue = new Date(dateAField.value);

            // Ajoutez 1 an à la date
            const nextYear = dateAValue.getFullYear() + 1;
            dateAValue.setFullYear(nextYear);

            // Mettez à jour le champ de date_calcul avec la nouvelle date formatée
            dateCalculField.value = dateAValue.toISOString().split('T')[0];

            // Vérifiez si la date calcul est arrivée ou dépassée par rapport à aujourd'hui
            const today = new Date();
            if (dateAValue <= today) {
                soldeCongeField.value = 30; // Remplir avec 30 jours de congé
            } else {
                soldeCongeField.value = 0; // Sinon, rester à 0
            }
        }
    </script>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['matre']) ?  "../model/modifemploye.php" : "../model/ajoutemploye.php" ?>" method="post">

                <input type="text" id="matricule" name="matricule" value="<?php echo htmlspecialchars($matricule); ?>" readonly>

                <input value="<?= !empty($_GET['matre']) ?  $employe['nome'] : "" ?>" type="text" name="nome" id="nome" placeholder="Veuillez saisir le nom">
                
                <input value="<?= !empty($_GET['matre']) ?  $employe['prenome'] : "" ?>" type="text" name="prenome" id="prenome" placeholder="Veuillez saisir le prénom">

                <input value="<?= !empty($_GET['matre']) ?  $employe['adre'] : "" ?>" type="text" name="adre" id="adre" placeholder="Veuillez saisir l'adresse">

                <input value="<?= !empty($_GET['matre']) ?  $employe['tel'] : "" ?>" type="text" name="tel" id="tel" placeholder="Veuillez saisir le N° de téléphone">
               
                <input value="<?= !empty($_GET['matre']) ?  $employe['mail'] : "" ?>" type="mail" name="mail" id="mail" placeholder="Veuillez saisir l'email">

                <input value="<?= !empty($_GET['matre']) ?  $employe['datedebut'] : "" ?>" type="date" name="datedebut" id="datedebut" placeholder="Veuillez saisir le date debut du service" onchange="Calcul()">

                <input value="<?= !empty($_GET['matre']) ?  $employe['dateentresolde'] : "" ?>" type="date" name="dateentresolde" id="dateentresolde" placeholder="Veuillez saisir le date d'entre du congé">

                <input value="<?= !empty($_GET['matre']) ?  $employe['soldeconge'] : "" ?>" type="" name="soldeconge" id="soldeconge" placeholder="Votre solde est ...." readonly>

                <input value="<?= !empty($_GET['matre']) ?  $employe['matre'] : "" ?>" type="hidden" name="matre" id="matre" >
                
                <label for="idservice"></label>
    <select name="idservice" id="idservice">
        <option value="">--Poste--</option>
        <?php
        $post=getservice();
        if(is_array($post) && !empty($post)){
            foreach($post as $key =>$value){
        ?>
            <option <?= !empty($_GET['matre']) && $employe['idservice'] == $value['idservice'] ?  "selected" : "" ?> value="<?= $value['idservice'] ?>"><?= $value['nomservice'] ?></option>
        <?php 
        }
    }
        ?>
        
    </select><br>
                <button type="submit">Valider</button>

                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                }
                ?>
            </form>

        </div>
        <div class="mbox">
            <table class="mtable">
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th class="hide-column">E-mail</th>
                    <th class="hide-column">Date debut</th>
                    <th class="hide-column">Date N. solde</th>
                    <th>Solde conge</th>
                    <th class="hide-column">Service</th>
                    <th>Action</th>
                </tr>
                <?php
                $totalemploye = 0;
                $total_pages = 0;
                if (!empty($_GET['s'])) {
                    $employes = getemploye(null, $_GET, $limit, $offset);

                    $count = countemploye($_GET);
                    $totalemploye = $count['total'];
                    $total_pages = ceil($totalemploye / $limit);
                } else {
                    $employes = getemploye(null, null, $limit, $offset);

                    $count = countemploye(null);
                    $totalemploye= $count['total'];
                    $total_pages = ceil($totalemploye / $limit);
                }
                // $employes = getemploye();

                if (!empty($employes) && is_array($employes)) {
                    foreach ($employes as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['matricule'] ?></td>
                            <td><?= $value['nome'] ?></td>
                            <td><?= $value['prenome'] ?></td>
                            <td><?= $value['adre'] ?></td>
                            <td><?= $value['tel'] ?></td>
                            <td class="hide-column"><?= $value['mail'] ?></td>
                            <td class="hide-column"><?= $value['datedebut'] ?></td>
                            <td class="hide-column"><?= $value['dateentresolde'] ?></td>
                            <td><?= $value['soldeconge'] ?></td>
                            <td class="hide-column"><?= $value['nomservice'] ?></td>
                            <td>
                                <a href="?matre=<?= $value['matre'] ?>"><i class='bx bx-edit'></i></a>
                                <a href="../model/suppremploye.php?matre=<?= $value['matre']?>" style="color: red;"><i class='bx bx-trash'></i></a>
                                <a href="voiremploye.php?matre=<?= $value['matre']?>" style="color: green;"><i class='bx bx-show'></i></a>
                                <a href="genererpdfemploye.php?matre=<?= $value['matre']?>" style="color: brown;"><i class='bx bx-file'>PDF</i></a>                                               
                            </td>
                        </tr>
                <?php

                    }
                }
                ?>
            </table>
            <?php

            echo "<div class='pagination'>";
          
            if ($page > 1) {
                $prev_page = $page - 1;
                echo "<a href='?page=$prev_page'>&laquo; Précédent</a> ";
            }
            
            for ($i = 1; $i <= $total_pages; $i++) {
                
                if($i==$page) $active = "active"; else $active = "";
                echo "<a class='$active' href='?page=$i'>$i</a> ";
            }

            // Lien vers la page suivante
            if ($page < $total_pages) {
                $next_page = $page + 1;
                echo "<a href='?page=$next_page'>Suivant &raquo;</a> ";
            }
            echo "</div>";

            ?>
        </div>
    </div>

</div>
</section>

<?php
include 'enpied.php';
?>
