let choice = "0";
do {
    // ;
    let choice = prompt("Quel choix ?");
    switch (choice) {
        case "1":
            /////////////////
            // Exercise 1.1
            /////////////////
            alert("Ecrire un algorithme qui demande à l’utilisateur un nombre compris entre 1 et 3 jusqu’à ce que la réponse convienne.");
            let nber1 = 4;
            while (nber1 < 1 || nber1 > 3) {
                nber1 = parseInt(prompt("Saisir un nombre entre 1 et 3", "0"), 10);
            }

            break;

        default:
            break;
    }
}
while (choice !== "0");

///////////////
// Fin
/////////////////

alert("C'est fini !");