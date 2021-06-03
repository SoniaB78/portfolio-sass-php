//API jokes TOUTES LES PAGES
var jokeTitle = document.querySelector("#joke span")
var typesJokes = ["Programming","Miscellaneous","Dark","Any"]
var couleurs = ["#5adf4a", "#df4ac2", "#393739", "#3cbab4"]

for(let i = 0; i < typesJokes.length; i++) {
  if(jokeTitle.innerHTML.includes(typesJokes[i])) {
    jokeTitle.style.backgroundColor = couleurs[i]
  }
}


// Carousel page CLIENTS

         
// Fancybox de la page PORTFOLIO
$(".fancybox")
    .attr('rel', 'gallery')
    .fancybox({
        loop: true,
        buttons: ["zoom", "share", "slideShow", "fullSreen", "download", "thumbs", "close"],
        animationEffect: 'zoom-in-out"',
        padding    : 0,
        margin     : 5,
        nextEffect : 'fade',
        prevEffect : 'none',
        autoCenter : true,
        afterLoad  : function () {
            $.extend(this, {
                aspectRatio : false,
                type    : 'html',
                width   : '100%',
                height  : '100%',
                content : '<div class="fancybox-image" style="background-image:url(' + this.href + '); background-size: cover; background-position:50% 50%;background-repeat:no-repeat;height:100%;width:100%;" /></div>'
            });
        }
    });
    
    
// Salutations qui changent en fonction de l'heure ACCUEIL
var salutation = document.getElementById("bonjour");

var date = new Date();
var heure = date.getHours();
// pour tester
// var heure = "14";
if(heure >= "18" && heure <= "23" || heure == "00") {
  salutation.innerHTML = "Bonsoir";
} 
else if (heure < "18" && heure >= "05") {
  salutation.innerHTML = "Bonjour";
}
else if (heure >= "01" && heure < "05") {
  salutation.innerHTML = "Coucou visiteur de la nuit";
}
