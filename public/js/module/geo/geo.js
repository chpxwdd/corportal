$(function () {
    var url = window.location.href;
    console.log(url);
// получаем выбранный ID и отправляемся за данными по url
    $("select[name=country]").bind("change", function () {
	$.getJSON(url + "region/" + $(this).val(), function (data) {
	    var options = '';
	    $.each(data, function (value, text) {
		options += '<option value="' + value + '">' + text + '</option>';
	    });
	    $("select[name=region]").html(options);
	});
	$("select[name=region]").bind("change", function () {
	    $.getJSON(url + "city/" + $(this).val(), function (data) {
		var options = '';
		$.each(data, function (value, text) {
		    options += '<option value="' + value + '">' + text + '</option>';
		});
		$("select[name=city]").html(options);
	    });
	});
    });
    
    zf2DoctrineAutocomplete.init('input[name=countryAc]');
    
});
