$(function () {
    // datepicker
//    var datepickerAddon = $('<span/>', {
//	class: 'input-group-addon'
//    }).append(buildGlyph('calendar'));

    $('.datepicker').datetimepicker({
	weekStart: 6,
	format: 'dd.mm.yyyy',
    });

//    $('.date').append(datepickerAddon);

    function buildGlyph(icon) {
	return $('<span/>', {
	    class: 'glyphicon glyphicon-' + icon
	});
    };
});

