

function closenav(leChamp) {
    document.getElementById("bar1").style.position.right="80%";

    document.getElementById("a1").style.width = "0";
    document.getElementById("a1").style.visibility = "hidden";
    document.querySelector("body").style.backgroundColor = "grey";


}

function openNav(leChamp) {



    document.getElementById("bar1").style.position.left="80%";
    //document.getElementById("a1").style.width = "20%";
    document.getElementById("a1").style.visibility = "visible";

}