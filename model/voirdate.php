<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Calculation Form</title>
    <script>
        function updateAutoField() {
            // Récupération des valeurs des champs date
            var dateDebut = document.getElementById("datedebut").value;
            var dateFin = document.getElementById("datefin").value;

            // Si les deux dates sont remplies
            if (dateDebut && dateFin) {
                // Conversion des chaînes de date en objets Date
                var startDate = new Date(dateDebut);
                var endDate = new Date(dateFin);

                // Vérification si la date de fin est postérieure à la date de début
                if (endDate < startDate) {
                    document.getElementById("autofield").value = "Erreur: Date de fin antérieure à la date de début";
                } else {
                    // Calcul de la différence en jours
                    var timeDifference = endDate.getTime() - startDate.getTime();
                    var dayDifference = timeDifference / (1000 * 3600 * 24); // Convertir les millisecondes en jours

                    // Affichage de la différence en jours dans le champ automatique
                    document.getElementById("autofield").value = dayDifference + " jours";
                }
            }
        }
    </script>
</head>
<body>
    <form>
        <label for="datedebut">Date Début:</label>
        <input type="date" id="datedebut" name="datedebut" oninput="updateAutoField()"><br><br>

        <label for="datefin">Date Fin:</label>
        <input type="date" id="datefin" name="datefin" oninput="updateAutoField()"><br><br>

        <label for="autofield">Champ Automatique:</label>
        <input type="text" id="autofield" name="autofield" readonly><br><br>
    </form>
</body>
</html>
