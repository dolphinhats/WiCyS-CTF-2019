<html>
<head><title>Chat Server v1.0</title></head>
Welcome to my chat server - hopefully it will not give you a Heartattack!!</br/>
<body onload="window.id=setInterval(heartbeat,1000);">
<textarea style="width:500; height:500;" disabled>
Admin: Hey guys, I just updated the chat to include a status when the server goes offline or you lose connection.

smiley: nice, thank you

H@ck3r_mAn: great! is it secure?

smiley: ?

Admin: of course...

Admin: dont try anything you guys!

H@ck3r_mAn: ummm... just found a huge bug! im emailing you the details..

Admin: hang on im checking something... 

System: Chat functions temporarily suspended

</textarea>
<br/>
<form action="chat.php" method="post">
<table>
<tr><td>
Username:</td><td><input type="text" name="user" value="Anonymous" disabled/></td>
<td>Password:</td><td><input type="password" name="pass" disabled/></td></tr>
</td></tr>
</table>
<textarea style="width:500; height:50;" name="chat" disabled></textarea><br/>
<button type=submit disabled>Send</button>
</form>


<table border="1"><tr><td>Server Status:</td><td id="status">Unknown</td></tr></table>
<textarea style="width:800px; height:1000px; display:none;" disabled id="debug"></textarea>
<div id="word" style="display:none"></div>
</body>
<script>
	

function heartbeat(){
	
	word=generate_word();
	w_len=word.length
	
	document.getElementById("word").innerText=word;
	
	var data= new FormData();
	data.append("word",word);
	data.append("length",w_len);
	
	var obj = new XMLHttpRequest();
	obj.addEventListener("load", reqListener);
	obj.addEventListener("abort", red);
	obj.addEventListener("error", red);
	obj.open("POST", "heartbeat.php",true);
	obj.send(data);
	
}
function reqListener(){
	
	document.getElementById("debug").innerText=this.responseText;
	
	var our_word=document.getElementById("word").innerText;
	var server_word=this.responseText;
	
	if(our_word==server_word.trim()){green();}else{red();}
	
}
function generate_word(){
	
	length=Math.floor((Math.random()*10%10)+5);
	alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	a_len=alphabet.length;
	word="";
	for(i=0; i<length; i++){
		word+=alphabet.charAt((Math.random()*100)%a_len);
	}
	// console.log(word);
	return word;
	
}
function green(){
document.getElementById("status").innerText="CONNECTED";
document.getElementById("status").style.color="green";

	
	
}
function red(){
document.getElementById("status").innerText="ERROR: Connection lost or invalid/unexpected heartbeat value. Please refresh the page.";	
clearInterval(window.id);	
document.getElementById("status").style.color="red";	

}
</script>
</html>