//Datemask dd/mm/yyyy
//$(".datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
var date = new Date();

$('.datemask').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
	startDate: date,
});

$('.datemaskFull').datepicker({
	format: 'yyyy-mm-dd',
	autoclose: true,
});

$(".timepicker").inputmask("h:s",{ "placeholder": "hh/mm" });