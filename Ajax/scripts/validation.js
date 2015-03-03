window.onload = initPage;
function initPage(){
	document.getElementById("username").onblur = checkUsername;
}
function checkUsername() {
// get a request object and send
// it to the server
	var request = createRequest();
	
	
}
function showUsernameStatus() {
// update the page to show whether
// the user name is okay
}


function createRequest(){
	try{
		request = new XMLHttpRequest();
	}catch(tryMS){
		try{
			request = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(otherMS){
			try{
				request = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(failed){
				request = null;
			}
		}
	}
	return request;
}

function getDetails(itemName){
	request = createRequest();
	
	if(request == null){
		alert("Unable to create request");
		return;
	}
	
	var url = "getDetails.php?ImageID=" + escape(encodeURIComponent(itemName)); //Whenever using user data and Ajax make sure the data is encoded safely by using encodeURIComponent
	request.open("GET", url, true);
	
	request.onreadystatechange = displayDetails; //Callback function when server responds to our request
	
	request.send(null);
	//need to protect against SQL injection and other security issues in the PHP page as you always must when processing user data.
}

function displayDetails(){
	var state=request.readyState;
	//alert("state: "+ state);
	var text=request.responseText;
	//alert("response text: " + text);
	if(request.readyState == 4){
		if(request.status == 200){
			detailDiv = document.getElementById("description");
			detailDiv.innerHTML = request.responseText;
		}
	}
}








