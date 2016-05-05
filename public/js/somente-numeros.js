function SomenteNumero(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	return (charCode >= 48 && charCode <= 57 || charCode < 20);
}