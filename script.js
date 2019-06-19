    var checkFn = function (e) {

        //Déclaration des variables et création des boutons
        var buton = document.createElement("INPUT");
        buton.setAttribute("type", "button");
        buton.setAttribute('value', 'Supprimer');
        buton.classList.add("myBtn");
        var check = document.querySelectorAll('input[type=checkbox]');
        var images = document.querySelectorAll('img');
        var td = document.querySelectorAll('td');
        //Cette varible récupère la position du td qui va recevoir le boutton effacer
        var last_td = td[td.length - 2];
        //On écoute la chekbox si elle est cochée alors on va valider toutes les chekboxes
        if (e.target.checked) {
            check.forEach(element => {
                element.checked = true;
            });
            //On place le boutton
            last_td.appendChild(buton);
            //On ajoute une écoute de click du boutton supprimer
            buton.addEventListener('click', function (e) {
                //Création de deux tableaux vides qui vont recevoir les indexes et le chemin relatif des images
                var tab_index = [];
                var tab_name = [];

                //On remplit les  tableaux
                images.forEach(item => {
                    tab_index.push(item.nextElementSibling.getAttribute('id'));
                    tab_name.push(item.getAttribute('src'));
                    item.remove();
                });
                //Maintenant que les tableaux contiennent les infos on supprime les checkboxes et les images
                check.forEach(item => {
                    item.remove();
                });
                e.target.remove(buton);
                console.log(tab_index);
                console.log(tab_name);

                //Préparation des tablaux pour être envoyé en format text par Ajax
                var myIndex = JSON.stringify(tab_index);
                var myurl = JSON.stringify(tab_name);

                //Code Ajax 
                var request = new XMLHttpRequest();
                //ouverture requête
                request.open("POST", "Json_suppr.php", true);
                //Type de données
                request.setRequestHeader("Content-type", "application/json");
                //Envoi des données
                request.send(JSON.stringify({ myIndex, myurl }));
                request.onreadystatechange = function () {
                    //Réponse si positif
                    if (this.readyState == 4 && this.status == 200) {
                        console.log('validation');
                        var h4 = document.createElement("h4");
                        h4.setAttribute('id', "showResult");
                        var text = document.createTextNode('Fichiers effacer avec succès');
                        h4.appendChild(text);
                        var h1 = document.querySelector('h1.index_h1');
                        h1.appendChild(h4);
                        setTimeout(function () { h4.remove(); }, 3000);
                        //Réponse si négatif
                    } else {
                        console.log('no response yet');
                    }
                };

            });
        } else {
            //On décoche ici tous les chekbox :Check est un tableau et on parcours tous ses éléments
            check.forEach(element => {
                element.checked = false;
            });

            document.querySelectorAll(".myBtn").forEach(item => {
                item.remove();
            });
            buton.remove();
        }
    };
    var mycheck = document.querySelector('input[type=checkbox].th_check');
    mycheck.addEventListener('click', checkFn);


    //Suppression d'une image a la fois
    function suppression(val) {
        var x = document.createElement("INPUT");
        x.setAttribute("type", "button");
        x.setAttribute('value', 'Supprimer');
        x.setAttribute('id', val);
        if (val.checked) {
            val.parentNode.appendChild(x);
            x.addEventListener('click', function () {
                var img = document.querySelector('img');
                img.remove(this);
                val.remove();
                x.remove();
            });
        } else {
            if (val) val.nextSibling.remove(x);
        }
    }