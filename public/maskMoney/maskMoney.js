$(document).ready(function () {
	
	$(".maskMoney").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	$(".maskPercentual").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
	    
});