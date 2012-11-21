function IsNumeric(input)
{
   return (input - 0) == input && input.length > 0;
}
function load_words(){
var sub = document.getElementById('subject').value;
var par = document.getElementById('wordpart').value;
setInnerHTML("words","retrieve_word_list=1&s="+sub+"&p="+par);
}

