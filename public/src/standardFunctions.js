//getUrlParameter(sParam) //Extracts a parameter from a URL and returns it.
//getCookie(cookieLoad) //Gets a cookie.
//String.prototype.replaceAll(search, replace) //Replaces all instances of a search string.
//String.prototype.removeMarkups() //Remove HTML markups (e.g. <, >)
//Round1 - Simple round to 1 decimal
//Round2 - Simple round to 2 decimals


var getUrlParameter = function getUrlParameter(sParam) {
		//console.log(window.location.search.substring(1));
		var sPageURL,
			sURLVariables,
			sParameterName,
			i;
		
		//console.log(window.location.search.substring(1));
		
		//console.log(window.location);
		
		sPageURL = decodeURIComponent(window.location.search.substring(1));
		
		
		/*
		try {
			sPageURL = decodeURIComponent(window.location.search.substring(1));
		} catch(e) {
			sPageURL = window.location.search.substring(1);
		}*/
		sURLVariables = sPageURL.split('&');

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0].toLowerCase() === sParam.toLowerCase()) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};
	
	
function getCookie(cookieLoad) {
	//alert(cookieLoad);
	
	var cookieLength = cookieLoad.length + 1;
	
	var cookieString;
	
	if (document.cookie !== null && document.cookie.indexOf(cookieLoad) > -1)
	{
		var afterCookie = document.cookie.substr(document.cookie.indexOf(cookieLoad + "=") + cookieLength);                    

		//alert (afterCookie);
		if (afterCookie.indexOf(";") > -1) {
			cookieString = afterCookie.substr(0,afterCookie.indexOf(';'));
			//alert ('afterCookie: ' + afterCookie + '\nif cookieString: ' + cookieString);
		} else {
			cookieString = afterCookie;
			//alert ('afterRegion: ' + afterRegion + '\nelse cookieString: ' + cookieString);
		}
	}
	
	return cookieString;
	
}				

String.prototype.replaceAll = function(search, replacement) {
	var target = this;
	return target.split(search).join(replacement);
};	



String.prototype.removeMarkups = function() {
	var target = this;
	
					
	var separators = ['<', '>'];
	var tokens = target.split(new RegExp(separators.join('|'), 'g'));
	
	for (var i = 0; i < tokens.length; i++) {
		if (i % 2 == 1) {
			tokens[i] = null;
		}
	}
	
	return tokens.join("");
};

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}

function addWall() {
	
	console.log("Checking if we need to Add a Wall13");

	if( window.canRunAds === undefined || window.madsbygoogle === undefined ){

                var freeVisits = getCookie('freeVisits');

                console.log(freeVisits);

                if (freeVisits == undefined) {
                  freeVisits = 0;
                }

                freeVisits++;

                document.cookie =  "freeVisits=" + freeVisits + "; expires=Fri, 30 Dec 2022 12:00:00 UTC;";

                if (freeVisits > 20) {


		        for (var i = 0; i < 3; i++)
			{
				//I should probably make an image so it's not filtered out.
				var div = document.createElement("div");
				//div.setAttribute("class", "democlass"); 
				//div.setAttribute("class", "democlass"); 
				
				var opacity = Math.random() * .06 + .92;
				
				//Random digits.
				var int1 = Math.floor((Math.random() * 10)); 
				var int2 = Math.floor((Math.random() * 10)); 
				var int3 = Math.floor((Math.random() * 10)); 
				
				var bgColor = "#0" + int1 + "0" + int2 + "0" + int3;
				var textColor = "#F" + int1 + "0" + int2 + "0" + int3;
				
				var widthShield = "50.0" + int1 + "vw";
				var heightShield = "15.0" + int2 + "vw";
				var leftShield = "25.0" + int2 + "vw";
				var topShield = "12.0" + int2 + "vw";
				
				//var styleShield = "background-color: " + bgColor + "; opacity: " + opacity + "; color: red; width: " + widthShield + "; height: " + heightShield + "; position: absolute; left: " + leftShield + "; top: " + topShield + "; text-align: center;";
				
				//alert (styleShield);
				
				div.setAttribute("style", "background-color: " + bgColor + "; opacity: " + opacity + "; color: red; width: " + widthShield + "; height: " + heightShield + "; position: fixed; left: " + leftShield + "; bottom: " + "0px" + "; text-align: center; border: solid orange 1px"); 

				/*
				.democlass {
					color: #FF0000;
					background-color: #111111F8;
					width: 80vw;
					height: 50vw;
					position: absolute;
					left: 10vw;
					top: 12vw;
					text-align: center;
					box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				}*/				

				
				var para = document.createElement("h2");
				div.appendChild(para);
				var t = document.createTextNode("\"AHHHHHHHH\"");
				para.appendChild(t);			
				
				var para = document.createElement("h3");
				div.appendChild(para);
				var t = document.createTextNode("AdBlock is ON!");
				para.appendChild(t);
				
				var para = document.createElement("p");
				div.appendChild(para);
				var t = document.createTextNode("We can't help you Carry with Knowledge without paying for the cost of the server!  Please disable AdBlock, then Refresh the page.");
				/*
				var t = document.createTextNode("We can't help you Carry with Knowledge without paying for the cost of the server!  Please disable AdBlock, then Refresh the page."
					+ "<\\n\\nNOTE:  We understand your concerns of computer security with regards to ads.  This is why we only use ads from the Google Adsense network."
					+ "<br> Many of our competitors will circumvent adblock by serving ads from less reputable sources (Taboola etc)."
					+ "<br> If you find one of our ads dangerous, offensive, or overly annoying, please send us the URL, and we will block it and report it to Google."
					+ "<br> Addionally, you can use AdChoices (Triangle in upper-right corner of ad pane) to configure your ad preferences.");*/
				para.appendChild(t);
				
				
				var para = document.createElement("p");
                                para.style.fontSize = "small";
				div.appendChild(para);
				var t = document.createTextNode("Although Google strives to maintain a high quality in its ads using a strict content policy, some ads may still occasionally be served that have a negative user experience (Autoplaying sound/video etc).  You can close any ad module by pressing the 'X' next to it, or report annoying ads to Google with Ad Choices using the triangle in the upper right of the ad module.");
				para.appendChild(t);				
				
				//var img = document.createElement("img");
				//img.setAttribute("src", "website/bronze_v.png"); 
				//img.setAttribute("height", "1200"); 
				//div.appendChild(img);
				//var t = document.createTextNode("Please help me continue to dispense Justice by paying for the cost of the server!  Please disable AdBlock, then Refresh the page.");
				//para.appendChild(t);

				document.body.appendChild(div);
			}
                }		 




	} else {
          console.log("NOT undefined!");
          console.log(window.canRunAds);
          console.log(window.madsbygoogle);
        }

	
}

function round1(myNum) {
  return Math.round(10.0 * myNum) / 10;

}

function round2(myNum) {
  return Math.round(100.0 * myNum) / 100;

}
