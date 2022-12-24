const conalas = document.querySelector("#billing_mit_oder_ohne_field");
const disparo = document.querySelector("#billing_Bettschutzeinlagen_Ja");
const nodisparo = document.querySelector("#billing_Bettschutzeinlagen_Nein");
const mitfluegel = document.getElementById('billing_mit_oder_ohne_mit Flügel');
const ohnefluegel = document.getElementById('billing_mit_oder_ohne_ohne Flügel');




window.onload = function(){
    show_not_show();
};
function show_not_show(){
    if (disparo.checked){
        conalas.setAttribute("style","display:block;");
        mitfluegel.checked = true;
        }else{ //para asegurarme si es que no esta chequeado ni JA ni NEIN.-
            conalas.setAttribute("style","display:none;");
            mitfluegel.checked = false;
            ohnefluegel.checked = false;

    }
    if (nodisparo.checked){
       
            conalas.setAttribute("style","display:none;");
            mitfluegel.checked = false;
            ohnefluegel.checked = false;
    }
}
disparo.onchange = function(){show_not_show();};

nodisparo.onchange = function(){show_not_show();};

show_not_show();//lo llamo por las dudas no lo ejecute en window.onload.-
//Cupon Code Snippet

jQuery(document).ready(function($) {
    $('.checkout_coupon').show();
    });
    var chkcup = document.querySelector(".checkout_coupon");
    function show_cupon(){
        chkcup.setAttribute("style","display:block;");
    }
    setInterval(show_cupon, 500);

