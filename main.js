var MenuItems = document.getElementById("MenuItems");

MenuItems.style.maxHeight == "0px";

function menutoggle() {
    if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px";
    } else {
        MenuItems.style.maxHeight = "0px";
    }
}

var servicesForm = document.getElementById("servicesForm");
var productsForm = document.getElementById("productsForm");
var indicator = document.getElementById("indicator");

function products() {
    productsForm.style.transform = "translateX(0px)";
    servicesForm.style.transform = "translateX(0px)";
    indicator.style.transform = "translateX(100px)";
}

function services() {
    productsForm.style.transform = "translateX(300px)";
    servicesForm.style.transform = "translateX(300px)";
    indicator.style.transform = "translateX(0px)";
}


// var menuBtn = document.getElementById("menuBtn");
// var sideNav = document.getElementById("MenuItems");
// var menu = document.getElementById("menu");
// sideNav.style.right == "-250px"; /*the nav is hidden in the webpage*/
// menuBtn.onclick = function() {
//     if (sideNav.style.right == "-250px") {
//         sideNav.style.right = "0"; /*the navbar appears on the web page*/
//         menu.src = "images/close.png"; /*the close image shows up*/
//     } else {
//         sideNav.style.right = "-250px";
//         menu.src = "images/menu.png"; /*the open image shows up*/
//     }
// }
       