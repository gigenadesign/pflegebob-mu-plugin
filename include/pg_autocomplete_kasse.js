const versichKasseName = document.getElementById('billing_pflegekasse_field');
//const tituloKasse = document.querySelector('')
//versichKasseName.setAttribute('style', 'background-color: #E9CDB6 !important;');
versichKasseName.classList.add('search-container');

versichKasseName.innerHTML += '<div class="suggestions"><ul class="autocomplete"></ul></div>';


const input = document.querySelector('[name="billing_pflegekasse"]');
const suggestions = document.querySelector('.suggestions ul');

const fruit = ['AOK - Die Gesundheitskasse für Niedersachsen', 'AOK - Die Gesundheitskasse in Hessen', 'AOK Baden-Württemberg', 'AOK Bayern - Die Gesundheitskasse', 'AOK Bremen / Bremerhaven', 'AOK Nordost - Die Gesundheitskasse', 'AOK NordWest - Die Gesundheitskasse', 'AOK PLUS - Die Gesundheitskasse für Sachsen und Thüringen', 'AOK Rheinland/Hamburg - Die Gesundheitskasse', 'AOK Rheinland-Pfalz/Saarland-Die Gesundheitskasse', 'AOK Sachsen-Anhalt - Die Gesundheitskasse', 'Audi BKK', 'BAHN-BKK', 'BARMER', 'BERGISCHE KRANKENKASSE', 'Bertelsmann BKK', 'Betriebskrankenkasse Mobil', 'Betriebskrankenkasse PricewaterhouseCoopers', 'BIG direkt gesund', 'BKK Akzo Nobel Bayern', 'BKK B. Braun Aesculap', 'BKK BPW Bergische Achsen KG', 'BKK Deutsche Bank AG', 'BKK Diakonie', 'BKK EUREGIO', 'BKK EVM', 'BKK EWE', 'BKK exklusiv', 'BKK Faber-Castell & Partner', 'BKK firmus', 'BKK Freudenberg', 'BKK GILDEMEISTER SEIDENSTICKER', 'BKK Groz-Beckert', 'BKK Herkules', 'BKK KARL MAYER', 'BKK Linde', 'BKK MAHLE', 'bkk melitta hmr', 'BKK Miele', 'BKK MTU', 'BKK PFAFF', 'BKK Pfalz', 'BKK ProVita', 'BKK Public', 'BKK Rieker.RICOSTA.Weisser', 'BKK Salzgitter', 'BKK Scheufelen', 'BKK Schwarzwald-Baar- Heuberg', 'BKK STADT AUGSBURG', 'BKK Technoform', 'BKK Textilgruppe Hof', 'BKK VDN', 'BKK VerbundPlus', 'BKK Verkehrsbau Union (BKK VBU)', 'BKK Voralb HELLER*INDEX*LEUZE', 'BKK Werra-Meissner', 'BKK Wirtschaft & Finanzen', 'BKK Würth', 'BKK ZF & Partner', 'BKK_DürkoppAdler', 'BKK24', 'BMW BKK', 'Bosch BKK', 'Continentale Betriebskrankenkasse', 'DAK-Gesundheit', 'Debeka BKK', 'energie-Betriebskrankenkasse', 'Ernst & Young BKK', 'Handelskrankenkasse (hkk)', 'Heimat Krankenkasse', 'HEK - Hanseatische Krankenkasse', 'IKK - Die Innovationskasse (IK)', 'IKK Brandenburg und Berlin', 'IKK classic', 'IKK gesund plus', 'IKK Südwest', 'Kaufmännische Krankenkasse - KKH', 'KNAPPSCHAFT', 'Koenig & Bauer BKK', 'Krones BKK', 'Mercedes-Benz BKK', 'Merck BKK', 'mhplus Betriebskrankenkasse', 'Novitas BKK', 'pronova BKK', 'R+V Betriebskrankenkasse', 'Salus BKK', 'SECURVITA BKK', 'Siemens-Betriebskrankenkasse (SBK)', 'SKD BKK', 'Sozialversicherung für Landwirtschaft', 'Forsten und Gartenbau (SVLFG)', 'Südzucker BKK', 'Techniker Krankenkasse', 'TUI BKK', 'VIACTIV Krankenkasse', 'vivida bkk', 'WMF Betriebskrankenkasse', 'Allianz Private Krankenversicherung', 'Alte Oldenburger Krankenversicherung', 'ARAG Krankenversicherung', 'AXA Krankenversicherung', 'Barmenia Krankenversicherung', 'die Bayerische', 'Generali Krankenversicherung', 'Concordia Krankenversicherung', 'Continentale Krankenversicherung', 'DBV Deutsche Beamtenversicherung', 'Debeka Krankenversicherungsverein', 'Deutscher Ring Krankenversicherungsverein', 'DEVK Krankenversicherung', 'DKV - Deutsche Krankenversicherung', 'Envivas Krankenversicherung', 'ERGO Krankenversicherung', 'Gothaer Krankenversicherung', ' HALLESCHE Krankenversicherung', 'HanseMerkur Krankenversicherung', 'HUK-Coburg Krankenversicherung', 'Inter Krankenversicherung', 'LKH Landeskrankenhilfe', 'LVM Krankenversicherung', 'Mecklenburgische Krankenversicherung', 'Münchener Verein Krankenversicherung', 'Nürnberger Krankenversicherung', 'ottonova Krankenversicherung', 'R+V Krankenversicherung', 'Süddeutsche Krankenversicherung', 'Signal Iduna Krankenversicherung', 'Versicherungskammer Bayern', 'VGH Krankenversicherung', 'vigo Krankenversicherung', 'UKV Union Krankenversicherung', 'Universa Krankenversicherung', 'VRK Krankenversicherung AG', 'Württembergische Krankenversicherung'];


//const fruit = [ 'Apple', 'Apricot', 'Avocado 🥑', 'Banana', 'Bilberry', 'Blackberry', 'Blackcurrant', 'Blueberry', 'Boysenberry', 'Currant', 'Cherry', 'Coconut', 'Cranberry', 'Cucumber', 'Custard apple', 'Damson', 'Date', 'Dragonfruit', 'Durian', 'Elderberry', 'Feijoa', 'Fig', 'Gooseberry', 'Grape', 'Raisin', 'Grapefruit', 'Guava', 'Honeyberry', 'Huckleberry', 'Jabuticaba', 'Jackfruit', 'Jambul', 'Juniper berry', 'Kiwifruit', 'Kumquat', 'Lemon', 'Lime', 'Loquat', 'Longan', 'Lychee', 'Mango', 'Mangosteen', 'Marionberry', 'Melon', 'Cantaloupe', 'Honeydew', 'Watermelon', 'Miracle fruit', 'Mulberry', 'Nectarine', 'Nance', 'Olive', 'Orange', 'Clementine', 'Mandarine', 'Tangerine', 'Papaya', 'Passionfruit', 'Peach', 'Pear', 'Persimmon', 'Plantain', 'Plum', 'Pineapple', 'Pomegranate', 'Pomelo', 'Quince', 'Raspberry', 'Salmonberry', 'Rambutan', 'Redcurrant', 'Salak', 'Satsuma', 'Soursop', 'Star fruit', 'Strawberry', 'Tamarillo', 'Tamarind', 'Yuzu'];


function search(str) {
	let results = [];
	const val = str.toLowerCase();

	for (i = 0; i < fruit.length; i++) {
		if (fruit[i].toLowerCase().indexOf(val) > -1) {
			results.push(fruit[i]);
		}
	}

	return results;
}

function searchHandler(e) {
	const inputVal = e.currentTarget.value;
	let results = [];
	if (inputVal.length > 0) {
		results = search(inputVal);
	}
	showSuggestions(results, inputVal);
}

function showSuggestions(results, inputVal) {
    
    suggestions.innerHTML = '';

	if (results.length > 0) {
		for (i = 0; i < results.length; i++) {
			let item = results[i];
			// Highlights only the first match
			// TODO: highlight all matches
			const match = item.match(new RegExp(inputVal, 'i'));
			item = item.replace(match[0], `<strong>${match[0]}</strong>`);
			suggestions.innerHTML += `<li>${item}</li>`;
		}
		suggestions.classList.add('has-suggestions');
	} else {
		results = [];
		suggestions.innerHTML = '';
		suggestions.classList.remove('has-suggestions');
	}
}

function useSuggestion(e) {
	input.value = e.target.innerText;
	input.focus();
	suggestions.innerHTML = '';
	suggestions.classList.remove('has-suggestions');
}

input.addEventListener('keyup', searchHandler);
suggestions.addEventListener('click', useSuggestion);