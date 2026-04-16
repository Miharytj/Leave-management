<?php
include 'entete.php';
// require_once '../model/voirdate.php';

if (!empty($_GET['idconge'])) {
    $conge = getconge($_GET['idconge']);
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4; // Nombre d'articles par page
$offset = ($page - 1) * $limit;

$employes = $connexion->query("SELECT matre, prenome, soldeconge FROM temploye")->fetchAll(PDO::FETCH_ASSOC);

$joursFeries = $connexion->query("SELECT datejourf FROM tjourf")->fetchAll(PDO::FETCH_COLUMN);

?>

<script>
    // Convertir les jours fériés récupérés du serveur en tableau JavaScript
    var joursFeries = <?php echo json_encode($joursFeries); ?>;

    function calculdate() {
        // Récupération des valeurs des champs date
        var dateDebut = document.getElementById("datedebut").value;
        var dateFin = document.getElementById("datefin").value;

        var employeSelect = document.getElementById("employe");
        var soldeConge = parseInt(employeSelect.options[employeSelect.selectedIndex].getAttribute("data-solde-conge"));

        // Si les deux dates sont remplies
        if (dateDebut && dateFin) {
            // Conversion des chaînes de date en objets Date
            var startDate = new Date(dateDebut);
            var endDate = new Date(dateFin);

            // Vérification si la date de fin est postérieure à la date de début
            if (endDate < startDate) {
                document.getElementById("soldeutilise").value = "Erreur";
                document.getElementById("solderestant").value = "Erreur";
                return;
            }

            // Vérifier si l'employé a déjà pris un congé dans le mois courant
            var xhr1 = new XMLHttpRequest();
            xhr1.open("GET", "../model/mensuel.php?matre=" + employeSelect.value + "&dateDebut=" + dateDebut, false);
            xhr1.send();

            if (xhr1.responseText === "true") {
                alert("Erreur : Cet employé a déjà pris un congé ce mois-ci.");
                document.getElementById("soldeutilise").value = "Erreur";
                document.getElementById("solderestant").value = "Erreur";
                return;
            }

            // Vérifier le nombre de personnes ayant déjà pris un congé sur cette période
            var xhr2 = new XMLHttpRequest();
            xhr2.open("GET", "../model/dejapris.php?dateDebut=" + dateDebut + "&dateFin=" + dateFin, false);
            xhr2.send();

            if (parseInt(xhr2.responseText) >= 3) {
                alert("Erreur : Trois employés ont déjà pris un congé sur cette période.");
                document.getElementById("soldeutilise").value = "Erreur";
                document.getElementById("solderestant").value = "Erreur";
                return;
            }

            var joursEffectifs = 0;

            // Parcourir chaque jour entre startDate et endDate
            for (var d = startDate; d <= endDate; d.setDate(d.getDate() + 1)) {
                var jourSemaine = d.getDay(); // 0 = Dimanche, 6 = Samedi
                var dateStr = d.toISOString().split('T')[0]; // Convertir la date en format YYYY-MM-DD

                // Vérifier si le jour est un samedi, un dimanche ou un jour férié
                if (jourSemaine !== 0 && jourSemaine !== 6 && !joursFeries.includes(dateStr)) {
                    joursEffectifs++;
                }
            }

            // Vérifier la limite de 15 jours
            if (joursEffectifs > 15) {
                alert("Erreur : Il est impossible de prendre plus de 15 jours de congé.");
                document.getElementById("soldeutilise").value = "Erreur";
                document.getElementById("solderestant").value = "Erreur";
            } else {
                // Vérification du solde restant
                var soldeRestant = soldeConge - joursEffectifs;
                if (soldeRestant < 0) {
                    alert("Erreur : Solde de congé insuffisant.");
                    document.getElementById("soldeutilise").value = "Erreur";
                    document.getElementById("solderestant").value = "Erreur";
                } else {
                    // Mise à jour des champs
                    document.getElementById("qtt").value = joursEffectifs + " jours";
                    document.getElementById("soldeutilise").value = joursEffectifs + " jours";
                    document.getElementById("solderestant").value = soldeRestant + " jours";
                }
            }
        } else {
            // Réinitialiser les champs si les dates ne sont pas remplies
            document.getElementById("soldeutilise").value = "";
            document.getElementById("solderestant").value = "";
        }
    }
</script>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['idconge']) ?  "../model/modifconge.php" : "../model/ajoutconge.php" ?>" method="post">

                <select id="employe" name="employe" onchange="calculdate()">
                    <option value="">Sélectionner un employé</option>
                    <?php foreach ($employes as $key => $value): ?>
                        <option <?= !empty($_GET['idconge']) && $conge['matre'] == $value['matre'] ?  "selected" : "" ?> value="<?= $value['matre']; ?>" data-solde-conge="<?= $value['soldeconge']; ?>">
                            <?= $value['prenome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

                <input value="<?= !empty($_GET['idconge']) ?  $conge['datedebut'] : "" ?>" type="date" name="datedebut" id="datedebut" placeholder="Veuillez saisir le date debut" oninput="calculdate()">

                <input value="<?= !empty($_GET['idconge']) ?  $conge['datefin'] : "" ?>" type="date" name="datefin" id="datefin" placeholder="Veuillez saisir le date fin" oninput="calculdate()">

                <input value="<?= !empty($_GET['idconge']) ?  $conge['qtt'] : "" ?>" type="" name="qtt" id="qtt" placeholder="Votre congé dure" readonly>

                <input value="<?= !empty($_GET['idconge']) ?  $conge['soldeutilise'] : "" ?>" type="" name="soldeutilise" id="soldeutilise" placeholder="Votre solde utilisé est" readonly>

                <input value="<?= !empty($_GET['idconge']) ?  $conge['solderestant'] : "" ?>" type="" name="solderestant" id="solderestant" placeholder="Votre solde restant est" readonly>

                <input value="<?= !empty($_GET['idconge']) ?  $conge['idconge'] : "" ?>" type="hidden" name="idconge" id="idconge">

                <label for="idtypec"></label>
                <select name="idtypec" id="idtypec">
                    <option value="">--Type congé--</option>
                    <?php
                    $typec = gettypeconge();
                    if (is_array($typec) && !empty($typec)) {
                        foreach ($typec as $key => $value) {
                    ?>
                            <option <?= !empty($_GET['idconge']) && $conge['idtypec'] == $value['idtypec'] ?  "selected" : "" ?> value="<?= $value['idtypec'] ?>"><?= $value['nomtype'] ?></option>
                    <?php
                        }
                    }
                    ?>
                </select><br>

                <input type="hidden" name="idsoldec" id="idsoldec">
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
            <?php
            ?>
        </div>
        <div class="mbox">
            <table class="mtable">
                <tr>
                    <th>Prénom(s)</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Quantité</th>
                    <th>Utilisé</th>
                    <th>Restant</th>
                    <th>Type congé</th>
                    <th>Action</th><br>
                </tr>

                <?php
                $totalconge = 0;
                $total_pages = 0;
                if (!empty($_GET['s'])) {
                    $conges = getconge(null, $_GET, $limit, $offset);

                    $count = countconge($_GET);
                    $totalconge = $count['total'];
                    $total_pages = ceil($totalconge / $limit);
                } else {
                    $conges = getconge(null, null, $limit, $offset);

                    $count = countconge(null);
                    $totalconge = $count['total'];
                    $total_pages = ceil($totalconge / $limit);
                }

                // $conges = getconge();

                if (!empty($conges) && is_array($conges)) {
                    foreach ($conges as $key => $value) {
                ?>
                        <tr>
                            <td><?= $value['prenome'] ?></td>
                            <td><?= $value['datedebut'] ?></td>
                            <td><?= $value['datefin'] ?></td>
                            <td><?= $value['qtt'] ?></td>
                            <td><?= $value['soldeutilise'] ?></td>
                            <td><?= $value['solderestant'] ?></td>
                            <td><?= $value['nomtype'] ?></td>
                            <td>
                                <a href="?idconge=<?= $value['idconge'] ?>"><i class='bx bx-edit'></i></a>
                                <a href="../model/annuleconge.php?idconge=<?= $value['idconge'] ?>" style="color: red;"><i class='bx bx-minus-circle'></i></a>
                                <a href="voirconge.php?idconge=<?= $value['idconge'] ?>" style="color: green;"><i class='bx bx-show'></i></a>
                                <a href="genererpdf.php?idconge=<?= $value['idconge'] ?>" style="color: brown;"><i class='bx bx-file'>PDF</i></a>
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

                if ($i == $page) $active = "active";
                else $active = "";
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