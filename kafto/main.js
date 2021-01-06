var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

function clickfunction(n){
var itemtypes = document.getElementsByClassName("itemtype");
var dispitems = document.getElementsByClassName("item-display");
var tshirt =  document.getElementsByClassName("tshirt");
var stshirt =  document.getElementsByClassName("sweatshirt");
var kapuson =  document.getElementsByClassName("kapuson");

for(i=0;i<itemtypes.length;i++){
  itemtypes[i].className = itemtypes[i].className.replace(" active2", "");
}
  itemtypes[n-1].className += " active2";


for(i=0;i<dispitems.length;i++){
    dispitems[i].className = dispitems[i].className.replace("visible","hide");
}

for(i=0;i<dispitems.length;i++){
    if(n==1){
      tshirt[i].firstElementChild.className = tshirt[i].firstElementChild.className.replace("hide", "visible");
    }
    else if(n==2){
      stshirt[i].firstElementChild.className = stshirt[i].firstElementChild.className.replace("hide", "visible");
    }
    else if(n==3){
      kapuson[i].firstElementChild.className = kapuson[i].firstElementChild.className.replace("hide", "visible");
    }
}
}

function uyegirisiyok() {
  Swal.fire(
      'Hata',
      'Sepetinize ürün eklemek için hesabınıza giriş yapınız.',
      'error'
  )
}

function sifirla() {
  var itemtypes = document.getElementsByClassName("itemtype");
  var dispitems = document.getElementsByClassName("item-display");
  var sizetypes = document.getElementsByClassName("sizetype")
  document.getElementById("sex").selectedIndex = "0";
  document.getElementById("size").selectedIndex = "0";

  for(i=0;i<itemtypes.length;i++){
    itemtypes[i].className = itemtypes[i].className.replace(" active2", "");
  }
  for(i=0;i<dispitems.length;i++){
      dispitems[i].className = dispitems[i].className.replace("hide","visible");
  }
  for(i=0;i<sizetypes.length;i++){
    sizetypes[i].className = sizetypes[i].className.replace(" active2", "");
  }
}

function addcart(n){
  var flag=0;
  var sizetypes = document.getElementsByClassName("sizetype");
  var carts = document.getElementsByClassName("cart");

  for(i=(n*3)-1;i>=((n*3)-3);i--){
    if(sizetypes[i].className == "sizetype active2"){
      flag=1;
      break;
    }
  }
  if (flag==1) {
    alert("Sepete Eklendi");
    sizeclick(0);
  }
  else {
    alert("Lutfen Sepete Eklemek İçin Beden Seçiniz");
  }
}

function filter(){
  var dispitems = document.getElementsByClassName("item-display");

  var size = document.getElementById("size");
  var text = size.options[size.selectedIndex].text;
  var sizetypes = document.getElementsByClassName("sizetype");

  var sex = document.getElementById("sex");
  var sextext = sex.options[sex.selectedIndex].text;

  for (var i = 0; i < dispitems.length; i++) {
    for (var j = 0; j < 3; j++) {
      if(sizetypes[(i*3)+j].className == "sizetype noclick" && sizetypes[(i*3)+j].text == text){
        dispitems[i].className = dispitems[i].className.replace("visible","hide");
      }
    }
  }

  for (var i = 0; i < dispitems.length; i++) {
      if(dispitems[i].className == "item-display visible Erkek" && sextext == "Kadın"){
        dispitems[i].className = dispitems[i].className.replace("visible","hide");
      }
      else if(dispitems[i].className == "item-display visible Kadın" && sextext == "Erkek"){
        dispitems[i].className = dispitems[i].className.replace("visible","hide");
      }
  }
}
