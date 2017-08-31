//addMasteryPoint(key)
//drawMastery(key)
//loadMasteries(key)

//addRuneToColor(rune, inventoryColor, color, max)
//buyRune(rune)
//calculateRunes()
//loadRunes
//multiplyRunes(rune, count)
//sellRune(obj)

//getChampsList()
//getStat(base, perLevelCoeff, level)

function loadMasteries() {
//Print Masteries List.  Debugging only.
	/*
	$( "<pre/>", {
			"class": "my-new-list",
				html: JSON.stringify(masteriesGlobalJSON, null, '\t')
	}).appendTo( "body" );
	*/
	
	/*
	$( "<img/>", {
			"class": "my-new-list",
				html: JSON.stringify(masteriesGlobalJSON, null, '\t')
	}).appendTo( "#ferocityHolder" );
	*/
	$("<table/>", {
		html: "<tbody><tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>" 
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr></tbody>",
		"class": "center"
	}).appendTo('#ferocityHolder');
	
	$("<table/>", {
		html: "<tbody><tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>" 
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr></tbody>",
		"class": "center"
	}).appendTo('#cunningHolder');
	
	$("<table/>", {
		html: "<tbody><tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>" 
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr>"
			+ "<tr><td></td><td></td><td></td></tr></tbody>",
		"class": "center"
	}).appendTo('#resolveHolder');
	
	//Initialize the mastery structure.
	masteriesAssigned['points'] = {};
	masteriesAssigned['trees'] = {};
	masteriesAssigned['rows'] = {};				
	
	$.each(masteriesGlobalJSON.data, function(key, val) {
		//style="padding-top: 8vw; text-align: left; padding-left: 5vw; top: 5vs; left: 5vw;"
		
		//Set Total Assigned Points to zero.
		masteriesAssigned['total'] = 0;
		
		//Fill the assigned masteries with 0's.
		masteriesAssigned['points'][key] = 0;
		
		//Fill the assigned trees with 0's.
		masteriesAssigned['trees'][key[1]] = 0;
		
		//Fill the assigned rows with 0's.
		masteriesAssigned['rows'][key[1] + [key[2]]] = 0;
		
		drawMastery(key);
	});
	
	console.log(masteriesAssigned);

}

function addMasteryPoint(key) {
	
	key = key.toString();
	
	//Need to check:
	//TOTAL Masteries < 30
	//Masteries in tree < 18
	//Determine min. points in tree per row. 0,5,6,11,12,17.
	//Make sure there aren't more than the max rank mastery points in any row.
	//Make sure that each individual mastery does not exceed it's max number of points.  (Redundant?)
	//It'll be more readable if I fill the data structure with 0's.
	
	var minRanks = [0, 5, 6, 11, 12, 17, 18];
	
	/*
	//Debugging.
	console.log(masteriesAssigned.total < 30);
	console.log(masteriesAssigned['trees'][key[1]] < 18);
	console.log(masteriesAssigned['trees'][key[1]] >= minRanks[parseInt(key[2]) - 1]);
	console.log(masteriesAssigned['rows'][key[1] + key[2]] <= masteriesGlobalJSON.data[key].ranks);
	
	console.log(masteriesAssigned['trees'][key[1]]);
	console.log(minRanks[parseInt(key[2])]);
	*/
	
	//First check if we're okay to add.
	if (masteriesAssigned.total < 30 && masteriesAssigned['trees'][key[1]] < 18 && masteriesAssigned['trees'][key[1]] >= minRanks[parseInt(key[2]) - 1] && masteriesAssigned['rows'][key[1] + key[2]] < masteriesGlobalJSON.data[key].ranks ) {
		masteriesAssigned.total++;						//Add to total mastery count.
		masteriesAssigned['trees'][key[1]]++;			//Add to mastery tree count.
		masteriesAssigned['rows'][key[1] + key[2]]++;	//Add to mastery row count.
		masteriesAssigned['points'][key]++;				//Add points to the individual mastery.
		drawMastery(key);
		
		//console.log("Adding a point to Mastery.");
		
	} else if (masteriesAssigned['trees'][key[1]] <= minRanks[parseInt(key[2])] && masteriesAssigned['trees'][key[1]] >= minRanks[parseInt(key[2]) - 1] && masteriesAssigned["points"][key] > 0) {
	//See if I should remove a point.
		//Are there at least 1/6/7/12/13/18 points assigned?
		//Is the mastery row at max rank?
			
		//Reset points to zero.
		masteriesAssigned.total -= masteriesAssigned['points'][key];				//Subtract currently assigned points from total mastery count.
		masteriesAssigned['trees'][key[1]] -= masteriesAssigned['points'][key];			//Subtract from the tree count.
		masteriesAssigned['rows'][key[1] + key[2]] -= masteriesAssigned['points'][key];	//Subtract from the row count.
		masteriesAssigned['points'][key] -= masteriesAssigned['points'][key];				//Subtract from the individual mastery count.
		drawMastery(key);
		
		console.log("Moving mastery to zero.");
		
	} else {
	//See if I should move a point sideways.
		//Are we at Max Ranks for the row?  Make sure we aren't already at Max Ranks!
		if (masteriesAssigned['rows'][key[1] + key[2]] == masteriesGlobalJSON.data[key].ranks && masteriesAssigned['points'][key] < masteriesGlobalJSON.data[key].ranks) {
			console.log("We can Move Sideways!");
			
			//First, we need to find all masteries in the same row.
			var sameRow = {};
			var removed = false;
			
			$.each(masteriesGlobalJSON.data, function(keyGlobal, val){
				//Check if we're in the same row!
				if (keyGlobal[1] == key[1] && keyGlobal[2] == key[2])								 {
					//If it's a different mastery, and it has at least one point, and we haven't removed a point yet, remove a point, and say that we did!
					if (keyGlobal != key) {
						if (masteriesAssigned["points"][keyGlobal] > 0 && !removed) {
							masteriesAssigned["points"][keyGlobal]--;
							removed = true;
							
							drawMastery(keyGlobal);
						}
					} else {
						//It's the same mastery!  Add a point!
						masteriesAssigned["points"][key]++;
						drawMastery(key);
					}
				}
			});
		} else {
			console.log("Tried to move sideways but couldn't.");
		}
	}
	
	document.getElementById("ferocityCountButton").innerHTML = masteriesAssigned['trees'][1];
	document.getElementById("cunningCountButton").innerHTML = masteriesAssigned['trees'][3];
	document.getElementById("resolveCountButton").innerHTML = masteriesAssigned['trees'][2];
	
	getChampStats();
	
	//alert(masteriesAssigned[key]);	
	//console.log(masteriesAssigned);
}



function drawMastery(key) {

	var patch = document.getElementById("patch").innerHTML;
	
	var cleanedAssigned = masteriesAssigned['points'][key] == undefined ? 0 : masteriesAssigned['points'][key];
	
	if (masteriesAssigned['points'][key] == masteriesGlobalJSON.data[key].ranks) {
		//Gold Icons
		var imgSrcMastery = "datadragon/" + patch + "/img/mastery/" + masteriesGlobalJSON.data[key].image.full;
		var imgStyleMastery = "width: 4vw; margin: .2vw; border: solid gold 1px;";
		var textStyleMastery = "border: solid gold 1px; color: gold; background-color: #222222; width: 3vw; margin-left: 1.5vw; margin-top: -1.0vw; position: relative; font-size: .8vw;";
	} else if (masteriesAssigned['points'][key] > 0) {
		//Gold Icons
		var imgSrcMastery = "datadragon/" + patch + "/img/mastery/" + masteriesGlobalJSON.data[key].image.full;
		var imgStyleMastery = "width: 4vw; margin: .2vw; border: solid lime 1px;";
		var textStyleMastery = "border: solid lime 1px; color: lime; background-color: #222222; width: 3vw; margin-left: 1.5vw; margin-top: -1.0vw; position: relative; font-size: .8vw;";
	} else {
		//Gray icons (No points assigned)
		var imgSrcMastery = "datadragon/" + patch + "/img/mastery/gray_" + masteriesGlobalJSON.data[key].image.full;
		var imgStyleMastery = "width: 4vw; margin: .2vw; border: solid gray 1px;";
		var textStyleMastery = "border: solid gray 1px; color: gray; background-color: #222222; width: 3vw; margin-left: 1.5vw; margin-top: -1.0vw; position: relative; font-size: .8vw;";
	}
	
	//I'll need to check if this should be gray or not here.
	var imageMastery = $("<img/>", {
		src: imgSrcMastery,
		style: imgStyleMastery,
		title: masteriesGlobalJSON.data[key].name + ": " + masteriesGlobalJSON.data[key].description[masteriesGlobalJSON.data[key].description.length - 1],
		onclick: "addMasteryPoint(" + key + ")"
		//html: JSON.stringify(masteriesGlobalJSON, null, '\t')
	});
	
	var pointsMastery = $("<div/>", {
		html: "<span id='ranks_" + key + "'>" + cleanedAssigned + "</span>&nbsp;&nbsp;/&nbsp;&nbsp;<span id='maxRanks_" + key + "'>" + masteriesGlobalJSON.data[key].ranks + "</span>",
		style: textStyleMastery
			
	});
	
	key = key.toString();
	
	//Map rows.
	var row = parseInt(key[2]) - 1;
	//Normalize Columns: Some Ferocity masteries appear in Column 4.
	var col = parseInt(key[3]) - 1 == 3 ? 2 : parseInt(key[3]) - 1;
	//Normalize Rows and Columns: All Cunning and Resolve masteries in even rows have their row's 2nd mastery in Column 2 instead of 3.
	col = parseInt(key[0]) > 0 && row % 2 == 0 && col == 1 ? 2 : col;
	
	if (key[1] == "1") {
		$('#ferocityHolder')[0].childNodes[0].rows[row].cells[col].innerHTML = "";
		imageMastery.appendTo($('#ferocityHolder')[0].childNodes[0].rows[row].cells[col]);
		pointsMastery.appendTo($('#ferocityHolder')[0].childNodes[0].rows[row].cells[col]);
		
	} else if (key[1] == "3") {
		$('#cunningHolder')[0].childNodes[0].rows[row].cells[col].innerHTML = "";
		imageMastery.appendTo($('#cunningHolder')[0].childNodes[0].rows[row].cells[col]);
		pointsMastery.appendTo($('#cunningHolder')[0].childNodes[0].rows[row].cells[col]);
	} else if (key[1] == "2") {
		$('#resolveHolder')[0].childNodes[0].rows[row].cells[col].innerHTML = "";
		imageMastery.appendTo($('#resolveHolder')[0].childNodes[0].rows[row].cells[col]);
		pointsMastery.appendTo($('#resolveHolder')[0].childNodes[0].rows[row].cells[col]);					
	
	}
	
	//console.log($('#ferocityHolder')[0].childNodes[0]);
	
	
}



function loadRunes() {
	//Print Rune List.  Debugging only.
	/*
	$( "<pre/>", {
			"class": "my-new-list",
				html: JSON.stringify(runesGlobalJSON, null, '\t')
	}).appendTo( "body" );
	*/

	//console.log(runesGlobalJSON);
	
	var arrayRunesRed = [];
	var arrayRunesBlue = [];
	var arrayRunesYellow = [];
	var arrayRunesBlack = [];
	
	$.each(runesGlobalJSON.data, function(key, val) {
		if (val.rune.tier == "3") {
			if (val.rune.type == "red") {
				val.id = key;							
				arrayRunesRed.push(val);
			}
			if (val.rune.type == "yellow") {
				val.id = key;							
				arrayRunesYellow.push(val);
			}
			if (val.rune.type == "blue") {
				val.id = key;							
				arrayRunesBlue.push(val);
			}
			if (val.rune.type == "black") {
				val.id = key;							
				arrayRunesBlack.push(val);
			}
		}
	
	});
	
	//console.log(arrayRunesRed);
	
	//Add Reds to Rune Shop.
	var table = $('<table></table>').addClass('foo');
	
	$.each(arrayRunesRed, function (key, val){
		var row = "<tr onclick='buyRune(" + val.id + ")'><td><img src='datadragon/" + patchGlobal + "/img/rune/" + val.image.full + "' width='32px'></td><td>" + val.description.replaceAll("per level", "/lvl").replaceAll("at champion level 18", "@18") + "</td></tr>";
		
		table.append(row);
		
	});
		
	$('#runeShopReds').append(table);

	
	//Add Yellows to Rune Shop.
	var table = $('<table></table>').addClass('foo');
	
	$.each(arrayRunesYellow, function (key, val){
		var row = "<tr onclick='buyRune(" + val.id + ")'><td><img src='datadragon/" + patchGlobal + "/img/rune/" + val.image.full + "' width='32px'></td><td>" + val.description.replaceAll("per level", "/lvl").replaceAll("at champion level 18", "@18") + "</td></tr>";
		
		table.append(row);
		
	});
		
	$('#runeShopYellows').append(table);				
	
	//Add Blues to Rune Shop.
	var table = $('<table></table>').addClass('foo');
	
	$.each(arrayRunesBlue, function (key, val){
		var row = "<tr onclick='buyRune(" + val.id + ")'><td><img src='datadragon/" + patchGlobal + "/img/rune/" + val.image.full + "' width='32px'></td><td>" + val.description.replaceAll("per level", "/lvl").replaceAll("at champion level 18", "@18") + "</td></tr>";
		
		table.append(row);
		
	});
		
	$('#runeShopBlues').append(table);
	
	//Add Quints to Rune Shop.
	var table = $('<table></table>').addClass('foo');
	
	$.each(arrayRunesBlack, function (key, val){
		var row = "<tr onclick='buyRune(" + val.id + ")'><td><img src='datadragon/" + patchGlobal + "/img/rune/" + val.image.full + "' width='32px'></td><td>" + val.description.replaceAll("per level", "/lvl").replaceAll("at champion level 18", "@18") + "</td></tr>";
		
		table.append(row);
		
	});
		
	$('#runeShopQuints').append(table);				
	
}

function buyRune(rune) {
	//alert(rune);
	//console.log(runesGlobalJSON.data[rune]);
	
	addRuneToColor(rune, "runeInventoryReds", "red", 9);
	addRuneToColor(rune, "runeInventoryYellows", "yellow", 9);
	addRuneToColor(rune, "runeInventoryBlues", "blue", 9);
	addRuneToColor(rune, "runeInventoryQuints", "black", 3);

	calculateRunes();
}

function sellRune(obj) {
	//console.log(obj);

	var colorCount = parseInt(obj.parentNode.getAttribute("data-total-count"));
	
	obj.parentNode.setAttribute("data-total-count", colorCount - 1);

	var count = parseInt(obj.getAttribute("data-count"));
	
	if (count > 1) {
		count--;
	
		obj.setAttribute("data-count", count);
		
		var rune = obj.getAttribute("data-key");
		
		obj.innerHTML = count + "x <img src='datadragon/" + patchGlobal + "/img/rune/" 
				+ runesGlobalJSON.data[rune].image.full + "' width='32px'>" + multiplyRunes(rune, count);
				
		runesListGlobal[rune] = parseInt(runesListGlobal[rune]) - 1;
				
	} else {
		var rune = obj.getAttribute("data-key");
		delete runesListGlobal[rune];
		obj.remove();
	}
	
	calculateRunes();
	
	console.log(runesListGlobal);
	
}

function calculateRunes() {
	//Attempt to clone the stats, re-initilaze all fields to zero
	$.each(runesGlobalJSON.basic.stats, function(key, val) {
		runeStatsGlobal[key] = 0;
	}); 
	
	var runeTypes = ["runeInventoryReds", "runeInventoryYellows", "runeInventoryBlues", "runeInventoryQuints"];
	
	$.each(runeTypes, function(key, val){
	
		$.each(document.getElementById(val).childNodes, function(key, val) {
			//console.log(key);
			//console.log(val);
			
			var rune = val.getAttribute("data-key");
			
			$.each(runesGlobalJSON.data[rune].stats, function(key, valRune) {
			
				//console.log(key);
				//console.log(valRune);
				//console.log(runeStatsGlobal[key]);
				runeStatsGlobal[key] += valRune * parseInt(val.getAttribute("data-count"));
			});
		});
	
	});
	//console.log(runeStatsGlobal);
	
	getChampStats();
}

function addRuneToColor(rune, inventoryColor, color, max) {
	//Skip buying rune if inventory is full.
	if (parseInt(document.getElementById(inventoryColor).getAttribute("data-total-count")) == max) {
		return;
	}
	
	if (runesGlobalJSON.data[rune].rune.type == color) {
		runesListGlobal[rune] = runesListGlobal[rune] == undefined ? 1 : parseInt(runesListGlobal[rune]) + 1;
		
	}
	
	//console.log(runesListGlobal);
	
	var newTest = false;
	
	$.each(document.getElementById(inventoryColor).childNodes, function(key, val) {
		//console.log(document.getElementById(inventoryColor));
		//console.log(val.getAttribute('data-key'));
		//console.log(val.getAttribute('data-count'));
		
		//console.log(rune);
		
		//console.log(val.getAttribute('data-key') == rune);
		
		//Found a duplicate, add the stats together.
		if (val.getAttribute('data-key') == rune) {
			
			//We found one.  Don't create a new rune.
			newTest = true;
			
			var thisRow = document.getElementById(inventoryColor).childNodes[key];
			
			var count = thisRow.getAttribute("data-count");
			
			count++;
			
			thisRow.setAttribute("data-count", count);
			
			//Create display output for the multiplied runes.
			document.getElementById(inventoryColor).childNodes[key].innerHTML = count + "x <img src='datadragon/" + patchGlobal + "/img/rune/" 
				+ runesGlobalJSON.data[rune].image.full + "' width='32px'>" + multiplyRunes(rune, count);
			
			//Add a rune to the total count.
			document.getElementById(inventoryColor).setAttribute("data-total-count", parseInt((document.getElementById(inventoryColor).getAttribute("data-total-count"))) + 1);
			
			//console.log(document.getElementById(inventoryColor).childNodes[key]);
		}
	});
				
	
	
	
	if (!newTest && runesGlobalJSON.data[rune].rune.type == color) {
	
		//Create display output for the new rune.
		var newRuneStack = "<tr onclick='sellRune(this)' data-key='" + rune + "' data-count='1'><td>" + 1 + "x <img src='datadragon/" + patchGlobal + "/img/rune/" 
			+ runesGlobalJSON.data[rune].image.full + "' width='32px'>" + multiplyRunes(rune, 1) + "</td></tr>";
	
		$("#" + inventoryColor).append(newRuneStack);
		
		//Add a rune to the total count.
		document.getElementById(inventoryColor).setAttribute("data-total-count", parseInt((document.getElementById(inventoryColor).getAttribute("data-total-count"))) + 1);
		
	}			

}

function multiplyRunes(rune, count) {			

	var regex = /[+-]?\d+(\.\d+)?/g;

	var str = runesGlobalJSON.data[rune].description;
	
	var numbers = str.split(/[0-9]./g);
	
	var lettersWithEmpty = str.split(/[0-9]./g);
	
	var lettersCleaned = [];
	
	//Push non-empty string fragments to the new letters array.
	for (var i = 0; i < lettersWithEmpty.length; i++) {
		if (lettersWithEmpty[i].length > 0) {
			lettersCleaned.push(lettersWithEmpty[i]);
		}
	}
	
	var outputDescription = "";
	
	var floats = str.match(regex).map(function(v) { return parseFloat(v); });
	//console.log(floats);
	
	//Re-assemble the string.
	for (var i = 0; i < lettersCleaned.length; i++) {
		outputDescription += lettersCleaned[i];
		
		if (i < floats.length) {
		
			if (floats[i] == 18) {
				outputDescription += floats[i];
			}
			else {
				outputDescription += Math.round(floats[i] * count * 100)/100.0;
			}
		}
			
		
	}	

	return outputDescription;

}
			
			
			
function getChampsList() {

	var patch = patchGlobal;
	
	var select = document.getElementById("champSelector");
	
	$.each(champsGlobalJSON.data, function(key, val) {
		var option = document.createElement("option");
		
		option.innerHTML = val.name;
		option.value = val.id;
		//option.setAttribute("name", val.id);
		
		select.appendChild(option);
	
	});						
	
	for (var i = 1; i <= 18; i++) {
		var option = document.createElement("option");
		
		option.innerHTML = i;
		option.value = i;
		
		document.getElementById("levelSelector").appendChild(option);
	}

	getChampStats();				
	
}			


//used for calculating Stat Growth.			
function getStat(base, perLevelCoeff, level) {
	var B = base;
	var x = perLevelCoeff;
	var n = level;
	
	
	
	var growth = 0;
			
	for (var l = 1; l <= level; l++) {
		
		//console.log(l);
		
		if (l == 2)
			growth = growth + 0.72;
		
		if (l == 3)
			growth = growth + 0.755;
		
		if (l == 4)
			growth = growth + 0.79;
					 
		if (l >= 5 && l <= 17)
			growth = growth + l * 0.035 - 0.07 + 0.72;
	 
		if (l == 18)
			growth = growth + 1.28;
		
		//console.log(growth);
		
	}
	
	var stat = base + perLevelCoeff * growth;
		
	
	//var stat = B + x * ((7.0 /400.0) * (Math.pow(n, 2) - 1) + 267.0/400.0 * (n - 1));
	
	return stat;            
}