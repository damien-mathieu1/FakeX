let trigger = document.getElementById("trigger");
let search = document.getElementById("searchbar");



trigger.addEventListener("mousedown", () => {
    search.classList.toggle("activated");
})

document.getElementById("cart").classList.add("hide");
document.getElementById("showCart").addEventListener("mousedown", () => {
    document.getElementById("cart").classList.toggle("hide");
})

document.getElementById("closeCart").addEventListener("mousedown", () => {
    document.getElementById("cart").classList.add("hide");
})


const sizes = document.getElementsByClassName("size-btn");


function parse(url, add) {
    console.log(url);
    let toreturn = "";
    let i = 0;
    while (url[i] != "?" && i < url.length) {
        toreturn += url[i];
        i++;
    }
    return toreturn + "?size=" + add;
}

for (let i = 0; i < sizes.length; i++) {
    sizes[i].addEventListener("mousedown", () => {
        document.getElementById("submitprod").disabled = false;
        if (!sizes[i].classList.contains("disabled")) {
            for (let k = 0; k < sizes.length; k++) {
                sizes[k].classList.remove("selected");
            }
            sizes[i].classList.add("selected");
            document.getElementById("sizeselector").value = sizes[i].innerText;
        }

    })
}

function parseURL(url,size) {
    let toreturn = "";
    let i = 0;
    while (url[i] !== "&" && i < url.length) {
        toreturn += url[i];
        i++;
    }
    if(url.length> i+6){
        toreturn += url.substring(i+6);
    }
    return toreturn + size;
}

function getRecommandations(pattern) {
    let url = parseURL(document.URL);
    fetch(url+'?action=recommand&controller=modele&search=' + pattern)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            for (let i = 0; i < data.length; i++) {
                document.querySelector("#suggestions ol").innerHTML += "<li><a href=\""+ url + "?action=readSingleProduct&controller=modele&id="+data[i].id +"\">" + data[i].nom+ "</a></li>";
            }
        });
}

document.getElementById("searchbar-input").addEventListener("keyup", () => {
    document.querySelector("#suggestions ol").innerHTML = "";
    if (document.getElementById("searchbar-input").value != "") {
        getRecommandations(document.getElementById("searchbar-input").value);

    }
});

