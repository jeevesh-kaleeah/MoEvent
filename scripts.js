// add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

//redirects the user to the admin_user.php page upon clicking on total admin
document.getElementById('adminLink').addEventListener('click', function(){
    window.location.href='admin_user.php';
})

//redirects the user to the admin_inquiries.php page upon clicking on total messages
document.getElementById('messageLink').addEventListener('click', function(){
    window.location.href='admin_inquiries.php';
})


var genreInput = document.getElementById('genreInput');
var durationInput = document.getElementById('durationInput');
var infoInput = document.getElementById('infoInput');

//this function will switch from required to disable when the type is concert
function switchRequired(){
  var event_type = document.getElementById('type').value;
  var isConcert = event_type ==='concert';

  genreInput.required = !isConcert;
  genreInput.disabled = isConcert;

  durationInput.required = !isConcert;
  durationInput.disabled = isConcert;

  infoInput.required = !isConcert;
  infoInput.disabled = isConcert;

}

document.getElementById('type').addEventListener('change', switchRequired);
switchRequired();


