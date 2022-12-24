function do_tooltip(a,b){
  //  tealerto (a);
const ttcoin = document.querySelector(a);
//ttcoin.classList.add('tooltip');
let adentro = ttcoin.innerHTML;

adentro = adentro + '    <a class="fragezeichen"><img src="/wp-content/mu-plugins/include/tooltip.png" width="20px" height="20px" ></a> <span class="tooltiptext" style="font-family:\'Roboto\',sans-serif; font-size: 12px; line-height: 14px;">' + b + '</span>';
ttcoin.innerHTML = adentro;
//alert(adentro);

}

var tip_a = "Egal, ob Sie privat oder gesetzlich versichert sind – im Regelfall übernehmen alle Versicherer die Kosten der BluBox. Wenn Sie privat versichert sind, schicken wir Ihnen zunächst die Rechnung, welche Sie bitte begleichen. Anschließend können Sie die Rechnung bei Ihrer Versicherung einreichen und das Geld zurück erhalten. Wenn Sie gesetzlich versichert sind, übernehmen wir die gesamte Abwicklung direkt mit Ihrer Krankenkasse.";
var tip_b = "Kunden mit einer Beihilfeberechtigung können wir zum aktuellen Zeitpunkt leider nicht beliefern. Wir arbeiten derzeit an der Lösung dieses Problems und bitten um Ihr Verständnis.";
var tip_c = "Falls der zu pflegende Patient nicht mehr geschäftsfähig ist, muss die bevollmächtigte Person den Antrag unterschreiben.";
var tip_d = "Sie haben außerdem einen gesetzlichen Anspruch auf 1-3 wiederverwendbare Bettschutzeinlagen pro Jahr. Die Menge kann von Krankenkasse zu Krankenkasse variieren. Diese Bettschutzeinlagen sind waschbar, zum Auskochen geeignet und bestehen aus hautsympathischen Material. Zusätzlich steht Ihnen eine Garantie von 2 Jahren zu.";
var tip_e = "Bei einem Anbieterwechsel bieten wir Ihnen die Möglichkeit, die Daten Ihres vorherigen Lieferanten einzutragen, damit wir diesen zusätzlich zu Ihrer Krankenkasse über den Wechsel informieren und so eventuelle Kosten vermieden werden können.";
var tip_f = "Flügel stehen im Zusammenhang mit den wiederverwendbaren Bettschutzeinlagen für zusätzlich seitlich angebrachtes Material, welches z.B. unterhalb einer Matratze eingeklemmt werden kann, um ein Verrutschen der Bettschutzeinlage zu verhindern.";
var tip_g = 'Hier tragen Sie bitte die Nummer ein, die Ihre Krankenkasse identifiziert. Sie finden diese, bei einer gesetzlichen Krankenversicherung, auf der Rückseite ihrer Versicherungskarte unter Feld 7 „Kennummer des Trägers“.<br>Bei einer privaten Krankenversicherung heißt diese Nummer „Unternehmensnummer“ und befindet sich auf der Vorderseite Ihrer Versicherungskarte.'

do_tooltip('[for="billing_privat_oder_gesetzlich_versichert_privat"]', tip_a);
do_tooltip('#shipping_beihilfeberechtigt_field', tip_b);
do_tooltip('[for="billing_pflegeperson_ist_bevollmchtigt_ja"]', tip_c);
do_tooltip('[for="billing_Bettschutzeinlagen_Ja"]', tip_d);
do_tooltip('[for="shipping_folgendes_mchte_ich_beantragen_Anbieterwechsel"]', tip_e);
do_tooltip('[for="billing_mit_oder_ohne_mit Flügel"]', tip_f);
do_tooltip('[for="billing_kennnummer_unternehmenskennnnummer"]', tip_g);



function tealerto(a){
    alert('Atention:!' + a);
}