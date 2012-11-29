function calculeSemaine() {
	var strDate=(document.getElementById('RecolteDate').value);
	document.getElementById('RecolteLib').value='Semaine du '+strDate;
/*		day = strDate.substring(0,2);
		year = strDate.substring(6,10);
		month = strDate.substring(3,5);
		d = new Date();
		d.setDate(day);
		d.setMonth(month);
		d.setFullYear(year); 
		//alert(d);
		alert(d.getWeek);*/
}
