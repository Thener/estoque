function replaceAll(string, token, newtoken) {
	while (string.indexOf(token) != -1) {
 		string = string.replace(token, newtoken);
	}
	return string;
}

function moedaFormatar(number) {
    
	number = number.toFixed(2) + '';
    x = number.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function moedaDesformatar(money) {
	
	money = replaceAll(money,' ','');
	money = replaceAll(money,'R$','');
	money = replaceAll(money,'.','');
	money = replaceAll(money,',','.');
	
	if (money == '') {
		money = 0;
	}

	return parseFloat(money);
}