window.onload = initPage;

function initPage(){
	//find the thumbnails on the page
	thumbs = document.getElementById("thumbnailPane").getElementsByTagName("img");
	
	//set the handler for each list
	for(var i = 0; i < thumbs.length; i++){
		image = thumbs[i];
		//create the onclick function
		image.onclick = function(){
			//find the full-size image name
			detailURL = 'images/PB-' + this.title + '.png';
			document.getElementById("itemDetail").src = detailURL;
			getDetails(this.title);
		}
	}
}

/*
 * Asynchronous apps make requests using a Javascript object, not a form submit
 */

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








