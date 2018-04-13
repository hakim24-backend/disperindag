function countChar(textarea,selector)
{
	var len = textarea.value.length;
	$(selector).text(len);
}

var statusHeadlineNow = $(".radios input:checked").val();

if(statusHeadlineNow == 'Y'){
	$("#headline-ok .box-headline").fadeIn();
	$('#imageHeadline').attr('required', 'required');
	$('#deskripsiHeadline').attr('required', 'required');
}else{
	$("#headline-ok .box-headline").fadeOut();
	$('#imageHeadline').removeAttr('required');
	$('#deskripsiHeadline').removeAttr('required');
}

$(".radios input:radio").change(function () {
	if ($(this).is(':checked') && $(this).val() == 'Y') {
		$("#headline-ok .box-headline").fadeIn();
		$('#imageHeadline').attr('required', 'required');
		$('#deskripsiHeadline').attr('required', 'required');
	}else if ($(this).is(':checked') && $(this).val() == 'N') {
		$("#headline-ok .box-headline").fadeOut();
		$('#imageHeadline').removeAttr('required');
		$('#deskripsiHeadline').removeAttr('required');
	}
});