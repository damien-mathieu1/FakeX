function parseURL(url) {
    let toreturn = "";
    let i = 0;
    while (url[i] !== "?" && i < url.length) {
        toreturn += url[i];
        i++;
    }
    return toreturn;
}

const aside = document.querySelector("aside");

function changeHero(rank){
    while (aside.firstChild) {
        aside.removeChild(aside.firstChild);
    }

    let url = parseURL(document.URL);
    fetch(url+'?action=bestSeller&controller=modele&rank=' + rank)
        .then(response => response.json())
        .then(data => {

            aside.innerHTML = "<h2>BY "+ data.creator +"</h2>";
            document.getElementById("name-shoe").innerText = data.nom;
            document.getElementById("creator-shoe").innerText = "By " + data.creator;
            document.querySelector("#image img").src = data.image;

            for(let i = 0; i < data.others.length; i++){
                let elt = document.createElement("img");
                elt.src = data.others[i].image;
                aside.append(elt);
            }
        });
}
changeHero(0);

const li = document.getElementsByClassName("selectshoe");

for(let k = 0; k< li.length; k++){
    li[k].addEventListener("mousedown", () => {
        changeHero(k);
        for(let i = 0; i< li.length; i++){
            li[i].classList.remove("activated");
        }
        li[k].classList.add("activated");
    });
}