days = new Array(
"Domingo","Segunda Feira","Ter&ccedil;a Feira","Quarta Feira","Quinta Feira","Sexta Feira","Sabado"
);
months = new Array(
"Janeiro","Fevereiro","Mar&ccedil;o","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"
);

function renderDate(){
	var mydate = new Date();
	var year = mydate.getYear();
	if (year < 2000) {
		if (document.all)
			year = "19" + year;
		else
			year += 1900;
	}
	var day = mydate.getDay();
	var month = mydate.getMonth();
	var daym = mydate.getDate();
	if (daym < 10)
		daym = "0" + daym;
	var hours = mydate.getHours();
	var minutes = mydate.getMinutes();
	var dn = "";
	if (hours >= 24) {
		dn = "";
		hours = hours - 24;
	}
	if (hours == 0)
		hours = 00;
	if (minutes <= 9)
		minutes = "0" + minutes;
	document.writeln("<FONT COLOR=\"#FFFFFF\" FACE=\"Verdana, Arial, Helvetica\" size=\"1\">&nbsp;",days[day],", ",daym," de ",months[month]," de ",year," &nbsp;&nbsp; ",hours,":",minutes," ",dn,"</FONT><BR>");
}

renderDate();