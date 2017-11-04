jQuery(document).ready(function () {

    $('canvas').drawVector({
	strokeStyle: '#000',
	strokeWidth: 1,
	x: 10, y: 10,
	a1: 90, l1: 20
    });
    jQuery('#add-rect-box').on('click', function () {
	var rect = {
	    fillStyle: '#36c',
	    x: 150, y: 100,
	    width: 200,
	    height: 100,
	    cornerRadius: 10,
	    draggable: true
	};
	$('canvas').drawRect(rect);
	console.log("sda");
    });
});