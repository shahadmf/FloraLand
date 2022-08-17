//ADMIN FORMS VALIDATION. DONE BY FATIMA M. ALNASSER, 2190003750, CS MAJGOR LEVEL 8 GROUP 1.
var product_name;
var product_price;
var product_stock;
var product_desc;
var category;
var product_pic1;
var product_pic2;
var product_pic3;
var product_pic4;
var product_pic5;

var helpText1;
var helpText2;
var helpText3;
var helpText4;
var helpText5;
var helpText6;
var helpText7;
var helpText8;
var helpText9;
var helpText10;


function init() {
    var form = document.getElementById("form");
    product_name = document.getElementById("product_name");
    product_price = document.getElementById("product_price");
    product_stock = document.getElementById("product_stock");
    product_desc = document.getElementById("product_desc");
    category = document.getElementById("category");
    product_pic1 = document.forms['form']['product_pic1'];
    product_pic2 = document.forms['form']['product_pic2'];
    product_pic3 = document.forms['form']['product_pic3'];
    product_pic4 = document.forms['form']['product_pic4'];
    product_pic5 = document.forms['form']['product_pic5'];

    helpText1 = document.getElementById("helpText1");
    helpText2 = document.getElementById("helpText2");
    helpText3 = document.getElementById("helpText3");
    helpText4 = document.getElementById("helpText4");
    helpText5 = document.getElementById("helpText5");
    helpText6 = document.getElementById("helpText6");
    helpText7 = document.getElementById("helpText7");
    helpText8 = document.getElementById("helpText8");
    helpText9 = document.getElementById("helpText9");
    helpText10 = document.getElementById("helpText10");


    form.onsubmit = check;
    form.onreset = func2;
} // end function init

function check() {
    var pass = "";

    if (product_name.value == "") {
        pass = "*The Product Name Cannot Be Blank. Please Fill This Field.<br/>";
        helpText1.innerHTML = pass;
        return false;
    }

    if (category.value == "") {
        pass = "*A Product Category Must Be Selected. <br/>";
        helpText2.innerHTML = pass;
        return false;
    }

    if (product_stock.value == "") {
        pass = "*Product Stock Cannot Be Blank. Please Fill This Field.<br/>";
        helpText3.innerHTML = pass;
        return false;
    }

    if (product_price.value == "") {
        pass = "*Product Price Cannot Be Blank. Please Fill This Field.<br/>";
        helpText4.innerHTML = pass;
        return false;
    }

    if (product_pic1.value == "") {
        pass = "*Product Image 1 Cannot Be Empty.<br/>";
        helpText5.innerHTML = pass;
        return false;
    }

    if (product_pic2.value == "") {
        pass = "*Product Image 2 Cannot Be Empty.<br/>";
        helpText6.innerHTML = pass;
        return false;
    }

    if (product_pic3.value == "") {
        pass = "*Product Image 3 Cannot Be Empty.<br/>";
        helpText7.innerHTML = pass;
        return false;
    }

    if (product_pic4.value == "") {
        pass = "*Product Image 4 Cannot Be Empty.<br/>";
        helpText8.innerHTML = pass;
        return false;
    }

    if (product_pic5.value == "") {
        pass = "*Product Image 5 Cannot Be Empty.<br/>";
        helpText9.innerHTML = pass;
        return false;
    }

    if (product_desc.value == "") {
        pass = "*Product Description Cannot Be Blank. Please Fill This Field.<br/>";
        helpText10.innerHTML = pass;
        return false;
    }
}

function func2() {
    return confirm("Are you sure you want to clear?");
}

window.addEventListener("load", init, false);


