window.onload = function () {
};
    
    setInterval("date_heure()", 1000); //Actualisation de l'heure


function compZero(nombre) {
    return nombre < 10 ? '0' + nombre : nombre;
}

function date_heure() {
    const infos = new Date();
    //Date
    const mois = new Array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre',
        'octobre', 'novembre', 'décembre');
    const jours = new Array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

    //Heure
    document.getElementById('date_heure').innerHTML = compZero(infos.getHours()) + ':' + compZero(infos
        .getMinutes()) + ':' + compZero(infos.getSeconds());

    //document.getElementById('date_heure').innerHTML += ' et nous sommes le ' + jours[infos.getDay()] + ' ' + infos.getDate() + ' ' + mois[infos.getMonth()] + ' ' + infos.getFullYear() + '.';
}