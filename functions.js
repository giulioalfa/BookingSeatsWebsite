
function mouseover(seat){
	if(seat.getAttribute("class")=="free"){
		seat.removeAttribute("class");
		seat.setAttribute("class", "over");
	}
	else if(seat.getAttribute("class")=="booked"){
		seat.removeAttribute("class");
		seat.setAttribute("class", "overbooked");
	}
}

function mouseout(seat){
	if(seat.getAttribute("class")=="over"){
		seat.removeAttribute("class");
		seat.setAttribute("class", "free");
	}
	else if(seat.getAttribute("class")=="overbooked"){
		seat.removeAttribute("class");
		seat.setAttribute("class", "booked");
	}
}

function bookSeat(seat, user){
	var old = 0;
	if(seat.getAttribute("class")=="cli"){
		$.post('values.php',
			{ 
				's': seat.getAttribute("id"), 
				'u': user,
				'b': 2
			},
			function(msg){
				if(msg == 1){
					seat.removeAttribute("class");
					seat.setAttribute("class", "over");
					alert("Prenotazione cancellata correttamente");
					old = document.getElementById("bbk").textContent;
					old -= 1;
					document.getElementById("bbk").innerHTML=old;
					old = document.getElementById("frr").textContent;
					old = +old + +1;
					document.getElementById("frr").innerHTML=old;
				}
				else alert("ERRORE!!");
			}
		);
	}
	else{
		$.post('values.php',
			{ 
				's': seat.getAttribute("id"), 
				'u': user,
				'b': 0
			},
			function(msg){
				if(msg == 1){
					seat.removeAttribute("class");
					seat.setAttribute("class", "cli");
					alert("Posto prenotato correttamente");
					var old = document.getElementById("bbk").textContent;
					old = +old + +1;
					document.getElementById("bbk").innerHTML=old;
					old = document.getElementById("frr").textContent;
					old -= 1;
					document.getElementById("frr").innerHTML=old;
				}
				else if(msg == 0){
					alert("Posto già comprato, non è possibile effettuare l'operazione!");
					seat.removeAttribute("class");
					seat.setAttribute("class", "bought");
					old = document.getElementById("frr").textContent;
					old -= 1;
					document.getElementById("frr").innerHTML=old;
					old = document.getElementById("bbg").textContent;
					old = +old + +1;
					document.getElementById("bbg").innerHTML=old;
				}
				else alert("ERRORE!!");
			}
		);
	}
}

function buySeat(useri){
	var list = document.getElementsByClassName("cli");
	if(list.length==0){
			alert("Scegliere almeno un posto!");
			return;
	}
	var arr = "";
	for(var i=0; i<list.length; i++){
		if(i==list.length-1)
			arr += list[i].textContent;
		else
			arr += list[i].textContent + " ";
	}
	$.post('values.php',
		{ 
			's': arr, 
			'u': useri,
			'b': 1
		},
		function(msg){
			if(msg == 1){
				alert("Posti comprati correttamente");
			}
			else if(msg == 0){
				alert("Non è stato possibile comprare i posti!");
			}
			else alert(msg);
			window.location.replace('booking.php');
		}
	);
}

function aggiorna() {
	window.location.replace('booking.php');
}