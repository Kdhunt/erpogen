function HandleResponse(response)
{
  document.getElementById('ResponseDiv').innerHTML = response;
}

function setInnerHTML(ElementId, query)
{
  var xmlHttp = getXMLHttp();
  var element = document.getElementById(ElementId);
  var queryString = query;
  
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
       element.innerHTML = (xmlHttp.responseText);
    }
  }

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlHttp.send(query);
}

/*-----------------ADD ELEMENT TO SELECT-----------------*/

function addSelectOption(ElementId, query)
{
  var xmlHttp = getXMLHttp();
  var elementName = ElementId;
  var element = document.getElementById(ElementId);
  var str = query;
  
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
       var val = (xmlHttp.responseText);
	if(IsNumeric(val)){
		appendOptionLast(str, val, element);
	}else{
	
	}
    }
  }

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlHttp.send("add"+elementName+"="+query);
}

/*------ RETURN A VALUE-----------*/
function returnValue(ElementId, query)
{
  var xmlHttp = getXMLHttp();
  var element = document.getElementById(ElementId);
  var queryString = query;
  
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
       return (xmlHttp.responseText);
    }
  }

  xmlHttp.open("POST", "ajax.php", true);
  xmlHttp.send(queryString);
}

/*--------------------------------------*/

function getXMLHttp()
{
  var xmlHttp
1
  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}