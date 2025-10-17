let FighterBluepoints = '';
let fighterRedpoints = '';
function setbluefighterpoints(number) {
    FighterBluepoints = number;

}
function setredfighterpoints(number) {
    fighterRedpoints = number;

}
function calculatePoints() {
    let result = FighterBluepoints-fighterRedpoints;
    let whowon = ""
    if(result > 0) {
        whowon = "Blue"
    } else {
        whowon = "Red"
    }
    result = Math.abs(result)
    if (result != 0) {
       document.getElementById("Pointdisplay").value = `${result} point(s) to ${whowon}`; 
    } else {
        document.getElementById("Pointdisplay").value = `No Points`;
    }
}
function addfighter(fighter) {
    var z = document.createElement("option");
    z.setAttribute("value", fighter);
    var t = document.createTextNode(fighter);
    z.appendChild(t);
    document.getElementById("dropdownfighter").appendChild(z);

}
function doAJAX () {
  fetch("Main.php")
  .then(res => res.text())
  .then(data => console.log(data));
}