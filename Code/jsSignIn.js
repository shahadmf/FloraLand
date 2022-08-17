//Done by Shahad Alfaddagh
var current = null;
var form;
var aid;
var pass;
var helpText;

function init()
    {
form = document.getElementById("form");
aid = document.getElementById("EID");
pass = document.getElementById("password");
helpText = document.getElementById("helpText");
form.onsubmit = check;
    }
function check() {
  var fields = "";

  if (aid.value == "") {
    fields = "<br><br><b>The ID Connot Be Empty.</b>";   
}

if (pass.value == "") {
  fields = fields + "<br><b>The Password Connot Be Empty.</b>";  
}
if (fields != "")
        {
            helpText.innerHTML = fields;
            return false;
        } 
		else
            return true;
}
window.addEventListener("load", init, false);

document.querySelector("#EID").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: 0,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "240 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });
});
document.querySelector("#password").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: -336,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "240 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });
});
document.querySelector("#submit").addEventListener("focus", function (e) {
  if (current) current.pause();
  current = anime({
    targets: "path",
    strokeDashoffset: {
      value: -730,
      duration: 700,
      easing: "easeOutQuart"
    },
    strokeDasharray: {
      value: "530 1386",
      duration: 700,
      easing: "easeOutQuart"
    }
  });
});
