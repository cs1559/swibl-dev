
/**
 *  JLEAGUE - BACKEND JAVASCRIPT LIBRARY
 
 data: 'teamid=' + teamid + '&seasonid=' + seasonid,
 
 */
 
var jfst = jQuery.noConflict();

function updateDivisionSelectList() {
	var id=jfst("#season_id").attr("value");	
	jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getDivisionListForSeason',{ seasonid: id },function(j) {
    	  var options = '';
	      for (var i = 0; i < j.length; i++) {
	      	sel = '';
	      	if (i == 0) {
	      		sel = 'selected';
	      	} 
	        options += '<option value="' + j[i].optionValue + '" ' + sel + '>' + j[i].optionDisplay + '</option>';
	      }
	      jfst("select#division_id").html(options);
	      updateTeamsSelectList();
	});
}

function updateTeamsSelectList() {
	var id=jfst("#division_id").attr("value");
	jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getDivisionCompetingTeams',{ divid: id },function(j) {
    	  var options = '';
	      for (var i = 0; i < j.length; i++) {
	        options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
	      }
	      jfst("select#hometeam_id").html(options);
	      jfst("select#awayteam_id").html(options);
	});
}
function removeTeamContact(id,teamid) {
	if (!confirm("Confirm DELETE request")) {
		return;
	}
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxRemoveTeamContact',
	    data: 'id=' + id + '&teamid=' + teamid,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
       		jfst("#team-current-contacts-list").html(textStatus);
   		},
   		success: function(data){
   			jfst("#team-current-contacts-list").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
}

function addTeamContact(form) {

	if (form.contactname.value == '') {
			alert('Contact Name is required');
			form.contactname.focus();
			return;
	}
	if (!confirm("Confirm ADD request")) {
		return;
	}
	var str = jfst("#team-contact-input-form").serialize();
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxAddTeamContact',
	    data: str,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#team-current-contacts-list").html(data);
   			form.contactname.value="";
   			form.contactemail.value="";
   			form.contactphone.value="";
   		},
   		complete: function() {
   		}	    		
	});		
}



/**
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */
// Declaring valid date character, minimum year and maximum year
var dtCh= "/";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strMonth=dtStr.substring(0,pos1)
	var strDay=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : mm/dd/yyyy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	}
return true
}
