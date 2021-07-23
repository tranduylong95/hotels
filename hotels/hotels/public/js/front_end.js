function fadeOutEffect(x) {
    x.style.display="block";
    var fadeEffect = setInterval(function () {
        if (!x.style.opacity) {
            x.style.opacity = 1;
        }
        if (x.style.opacity > 0) {
            x.style.opacity -= 0.1;
        } else {
             x.style.display="none";
             x.style.opacity=null;
            clearInterval(fadeEffect);
        }
    }, 300);
}
function form_category(e){
          let x= document.getElementById("form_category");
          let y =document.getElementById('list_category');
          let k=e.getAttribute("class");
          if(k=="btn"){
              e.setAttribute("class","btn active_s1");
              let z= e.previousElementSibling;
              if(z!=null){
                 z.classList.remove("active_s1"); 
                 x.style.display="block";
                 y.style.display="none";
              }
              else{
                  z=e.nextElementSibling;
                  z.classList.remove("active_s1"); 
                  y.style.display="block";
                  x.style.display="none";
              }
          }
}
function form_dvt(e){
        let x= document.getElementById("form_dvt");
        let y =document.getElementById('list_dvt');
        let k=e.getAttribute("class");
        if(k=="btn"){
            e.setAttribute("class","btn active_s1");
            let z= e.previousElementSibling;
            if(z!=null){
               z.classList.remove("active_s1"); 
               x.style.display="block";
               y.style.display="none";
            }
            else{
                z=e.nextElementSibling;
                z.classList.remove("active_s1"); 
                y.style.display="block";
                x.style.display="none";
            }
        }
} 
function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}
function previewFile(e) {
  const preview = document.getElementById('image_product');
  const file = e.files[0];
  const reader = new FileReader();
  let x=document.getElementById('image_product_1');
  let y=x.nextElementSibling;
  reader.addEventListener("load", function () {
    // convert image file to base64 string
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
    x.style.display="flex";
    y.style.padding=0;
  }
}
function list_dvt_big(e){
  if(e.value==1||e==1){
   var x= document.getElementById("list_dvt_big")
   var y=x.nextElementSibling;
   y.style.display="";
   y=y.nextElementSibling;
   y.style.display="";
   }
  else {
    var x= document.getElementById("list_dvt_big")
     var y=x.nextElementSibling;
     y.style.display="none";
     y=y.nextElementSibling;
     y.style.display="none";
  }
} 
function zoom_image(e,x){
 if(x==1){
 e.style.transition= "width 2s, height 2s";
 e.style.width="400px";
 e.style.height="250px";
 }
 else {
  e.style.transition= "width 2s, height 2s";
  e.style.width="40px";
  e.style.height="60px";
 }
}
