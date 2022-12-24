
// VERSION 1.2 funcionando

/*Ejecuto*/

Comprobar_Ambiterwechseln();
Comprobar_Lieferung();

//Form checkout
const my_formulario = document.querySelector('[name="checkout"]');
my_formulario.onsubmit = function(){
	Comprobar_Ambiterwechseln();
	Comprobar_Lieferung();
	hideWeiter();
};
my_formulario.onchange = function(){
	
	Comprobar_Ambiterwechseln();
	Comprobar_Lieferung();
	hideWeiter();

};

setInterval(hideWeiter, 1000);




/*hide Weiter button if are in step 4*/

function hideWeiter(){


const pest4 = document.querySelector('#step-4');
const pest1 = document.querySelector('#step-1');
const weiter = document.querySelector('#action-next');
const previ = document.querySelector('#action-prev');

if(pest1.className == 'first active' || pest1.className =='first thwmscf-finished-step active'){
	weiter.classList.add('pg_super_der');
	previ.classList.add('invisible');
	weiter.classList.remove('invisible');
}
else{
		
		if(pest4.className == 'last active'){
			weiter.classList.remove('pg_super_der');
			weiter.classList.add('invisible');
			previ.classList.add('invisible');
		}
		else{
		weiter.classList.remove('pg_super_der');
		weiter.classList.remove('invisible');
		previ.classList.remove('invisible');
		}
}





}


/*La Función*/
function Comprobar_Ambiterwechseln(){

//Proveedor
				const Proveedor = document.getElementById("shipping_name_des_vorherigen_anbieters");
				const ProveedorField = document.getElementById("shipping_name_des_vorherigen_anbieters_field");
				const nomProv  = document.querySelector('[for="shipping_name_des_vorherigen_anbieters"]');


      if(document.getElementById("shipping_folgendes_mchte_ich_beantragen_Anbieterwechsel").checked) {
          //alert("Anbieterwechsel");
		        //Proveedor
		  		//ProveedorField.classList.add('validate-required');
                Proveedor.setAttribute('style', 'border:.5px solid green;');//was red
                //nomProv.innerHTML = 'Name des vorherigen Anbieters&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
				//now want optional feld
				nomProv.innerHTML = 'Name des vorherigen Anbieters&nbsp;<span class="optional">(optional)</span>';
				ProveedorField.setAttribute('style', 'display: block;');
				 
                   
            }else if(document.getElementById("shipping_folgendes_mchte_ich_beantragen_Erstbelieferung").checked) {
                //Proveedor
				ProveedorField.classList.remove('validate-required');
                Proveedor.setAttribute('style', 'border:.5px solid green;');
				Proveedor.value = '';
                nomProv.innerHTML = 'Name des vorherigen Anbieters&nbsp;<span class="optional">(optional)</span>';
				ProveedorField.setAttribute('style', 'display: none;');
				

            }
//Auftragsnummer
			
			const Numero = document.getElementById("shipping_vorherigen_anbieters_auftragsnummer");
			const NumeroField = document.getElementById("shipping_vorherigen_anbieters_auftragsnummer_field");
			const nomNumero  = document.querySelector('[for="shipping_vorherigen_anbieters_auftragsnummer"]');


			if(document.getElementById("shipping_folgendes_mchte_ich_beantragen_Anbieterwechsel").checked) {
         
		        
				 //NumOrden
				 //NumeroField.classList.add('validate-required');
				 Numero.setAttribute('style', 'border:.5px solid green;');//was red
				
				// nomNumero.innerHTML = 'Auftragsnummer&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
				//now want Optional feld
				nomNumero.innerHTML = 'Auftragsnummer&nbsp;<span class="optional">(optional)</span>';
				 NumeroField.setAttribute('style', 'display: block;');
				 
                   
            }else if(document.getElementById("shipping_folgendes_mchte_ich_beantragen_Erstbelieferung").checked) {
                
				//NumOrden
				NumeroField.classList.remove('validate-required');
				 Numero.setAttribute('style', 'border:.5px solid green;');
				 Numero.value = '';
				 nomNumero.innerHTML = 'Auftragsnummer&nbsp;<span class="optional">(optional)</span>';
				 NumeroField.setAttribute('style', 'display: none;');
				 

            }
//straße
			const LaCalle = document.getElementById("shipping_anschrift_des_vorherigen_anbieters");
			const LaCalleField = document.getElementById("shipping_anschrift_des_vorherigen_anbieters_field");
			const nomLaCalle  = document.querySelector('[for="shipping_anschrift_des_vorherigen_anbieters"]');


			if(document.getElementById("shipping_folgendes_mchte_ich_beantragen_Anbieterwechsel").checked) {
          
		        
				 //LaCalle
				 LaCalleField.setAttribute('style', 'display: block;');
				 //LaCalleField.classList.add('validate-required');
				 LaCalle.setAttribute('style', 'border:.5px solid green; display: block;');//was red
				 //nomLaCalle.innerHTML = 'Anschrift des vorherigen Anbieters&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
                 nomLaCalle.innerHTML = 'Anschrift des vorherigen Anbieters&nbsp;<span class="optional">(optional)</span>';
                   
            }else if(document.getElementById("shipping_folgendes_mchte_ich_beantragen_Erstbelieferung").checked) {
                
				 //LaCalle
				 LaCalleField.classList.remove('validate-required');
				 LaCalle.setAttribute('style', 'border:.5px solid green;');
				 LaCalle.value = '';
				 nomLaCalle.innerHTML = 'Anschrift des vorherigen Anbieters&nbsp;<span class="optional">(optional)</span>';
				 LaCalleField.setAttribute('style', 'display: none;');

            }

}//ultimo corchete

//FIN 1.2
function Comprobar_Lieferung(){
	const APvorname = document.getElementById('billing_vorname_angehoerige_person');
	const APname = document.getElementById('billing_nachname_angehoerige_person');
	const APtel = document.getElementById('billing_telefon_angehoerige_person');
	const APmail = document.getElementById('billing_email_angehoerige_person');
	const APstr = document.getElementById('billing_address_angehoerige_person');
	const APplz = document.getElementById('billing_postcode_angehoerige_person');
	const APcity = document.getElementById('billing_city_angehoerige_person');
	const APherrfrau = document.getElementById('billing_anrede_angehoerige_person_field');

	const FAPvorname = document.getElementById('billing_vorname_angehoerige_person_field');
	const FAPname = document.getElementById('billing_nachname_angehoerige_person_field');
	const FAPtel = document.getElementById('billing_telefon_angehoerige_person_field');
	const FAPmail = document.getElementById('billing_email_angehoerige_person_field');
	const FAPstr = document.getElementById('billing_address_angehoerige_person_field');
	const FAPplz = document.getElementById('billing_postcode_angehoerige_person_field');
	const FAPcity = document.getElementById('billing_city_angehoerige_person_field');

	//labels
	const LAPvorname = document.querySelector('[for="billing_vorname_angehoerige_person"]');
	const LAPname = document.querySelector('[for="billing_nachname_angehoerige_person"]');
	const LAPtel = document.querySelector('[for="billing_telefon_angehoerige_person"]');
	const LAPmail = document.querySelector('[for="billing_email_angehoerige_person"]');
	const LAPstr = document.querySelector('[for="billing_address_angehoerige_person"]');
	const LAPplz = document.querySelector('[for="billing_postcode_angehoerige_person"]');
	const LAPcity = document.querySelector('[for="billing_city_angehoerige_person"]');
	//const LAPherrfrau = document.querySelector('[for="billing_anrede_angehoerige_person_Frau"]');
    const INPanredeF = document.getElementById('billing_anrede_angehoerige_person_Frau');
    const INPanredeH = document.getElementById('billing_anrede_angehoerige_person_Herr');
    



	if(document.getElementById("billing_lieferung_der_blubox_an_die/den Angehörige(n)/Pflegeperson").checked) {

		FAPvorname.setAttribute('style','display:block');
		FAPname.setAttribute('style','display:block');
		FAPtel.setAttribute('style','display:block');
		FAPmail.setAttribute('style','display:block');
		FAPstr.setAttribute('style','display:block');
		FAPplz.setAttribute('style','display:block');
		FAPcity.setAttribute('style','display:block');
		APherrfrau.setAttribute('style', 'display:block;');

		APvorname.setAttribute('style', 'border: .7px solid red;');
		APname.setAttribute('style', 'border: .7px solid red;');
		APtel.setAttribute('style', 'border: .7px solid red;');
		APmail.setAttribute('style', 'border: .7px solid red;');
		APstr.setAttribute('style', 'border: .7px solid red;');
		APplz.setAttribute('style', 'border: .7px solid red;');
		APcity.setAttribute('style', 'border: .7px solid red;');
		//APherrfrau.setAttribute('style', 'display: block;');
		

		LAPvorname.setAttribute('style','display:block');
		LAPname.setAttribute('style','display:block');
		LAPtel.setAttribute('style','display:block');
		LAPmail.setAttribute('style','display:block');
		LAPstr.setAttribute('style','display:block');
		LAPplz.setAttribute('style','display:block');
		LAPcity.setAttribute('style','display:block');
        //INPanredeF.checked=false;
        //INPanredeH.checked=false;


		LAPvorname.innerHTML = 'Vorname&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		LAPname.innerHTML = 'Nachname&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		LAPtel.innerHTML = 'Telefon&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		LAPmail.innerHTML = 'E-Mail-Adresse&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		LAPstr.innerHTML = 'Straßenname und Hausnummer&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		LAPplz.innerHTML = 'Postleitzahl&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		LAPcity.innerHTML = 'Ort / Stadt&nbsp;<abbr class="required" title="erforderlich">*</abbr>';
		//LAPherrfrau.innerHTML = 'Anrede&nbsp;<abbr class="required" title="erforderlich">*</abbr>';

	}else{
		APvorname.setAttribute('style', 'border: .7px solid green;');
		APname.setAttribute('style', 'border: .7px solid green;');
		APtel.setAttribute('style', 'border: .7px solid green;');
		APmail.setAttribute('style', 'border: .7px solid green;');
		APstr.setAttribute('style', 'border: .7px solid green;');
		APplz.setAttribute('style', 'border: .7px solid green;');
		APcity.setAttribute('style', 'border: .7px solid green;');

		APvorname.value='';
		APname.value='';
		APtel.value='';
		APmail.value='';
		APstr.value='';
		APplz.value='';
		APcity.value='';

        INPanredeF.checked=false;
        INPanredeH.checked=false;


		LAPvorname.innerHTML = 'Vorname&nbsp;<span class="optional">(optional)</span>';
		LAPname.innerHTML = 'Nachname&nbsp;<span class="optional">(optional)</span>';
		LAPtel.innerHTML = 'Telefon&nbsp;<span class="optional">(optional)</span>';
		LAPmail.innerHTML = 'E-Mail-Adresse&nbsp;<span class="optional">(optional)</span>';
		LAPstr.innerHTML = 'Straßenname und Hausnummer&nbsp;<span class="optional">(optional)</span>';
		LAPplz.innerHTML = 'Postleitzahl&nbsp;<span class="optional">(optional)</span>';
		LAPcity.innerHTML = 'Ort / Stadt&nbsp;<span class="optional">(optional)</span>';

		FAPvorname.setAttribute('style','display:none');
		FAPname.setAttribute('style','display:none');
		FAPtel.setAttribute('style','display:none');
		FAPmail.setAttribute('style','display:none');
		FAPstr.setAttribute('style','display:none');
		FAPplz.setAttribute('style','display:none');
		FAPcity.setAttribute('style','display:none');
		APherrfrau.setAttribute('style', 'display: none;');
/*
		LAPvorname.setAttribute('style','display:none');
		LAPname.setAttribute('style','display:none');
		LAPtel.setAttribute('style','display:none');
		LAPmail.setAttribute('style','display:none');
		LAPstr.setAttribute('style','display:none');
		LAPplz.setAttribute('style','display:none');
		LAPcity.setAttribute('style','display:none');
*/

		}

	}
