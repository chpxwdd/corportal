jQuery(function () {

    var btnParse = jQuery('button[name="operation[parse]"]');
    var buttonReset = jQuery('button[name="operation[reset]"]');

    var dateStart = jQuery('input[name="daterange[start]"]');
    var dateEnd = jQuery('input[name="daterange[end]"]');

    var tids = jQuery('#tids input[type=checkbox]');
    var checkAllTids = jQuery('#tids input[name="tids[checkall]"]');
    var fids = jQuery('#fids input[type=hidden]');

    jQuery('.datepicker').datepicker({
	weekStart: 6,
	format: 'dd.mm.yyyy'
    });
//    dateStart.datepicker({
//	weekStart: 6,
//	format: 'dd.mm.yyyy'
//    });
//    dateEnd.datepicker({
//	weekStart: 6,
//	format: 'dd.mm.yyyy'
//    });



    /**
     * PARSE RATES 
     */
    btnParse.on('click', function () {


	var desc = ' from ' + dateStart.val() + ' to ' + dateEnd.val();
	var result = jQuery("#parse_result_accordion");

	jQuery('#parse_result h3 small').html(desc);
	jQuery("#parse_result_accordion").html(null);

	var arrTids = [];
	jQuery.each(tids, function (i, elem) {
	    if (elem.checked == true && elem.name != 'tids[checkall]')
	    {
		arrTids.push(elem.value);
	    }
	});

	var arrFids = [];
	jQuery.each(fids, function (i, elem) {
	    arrFids.push(elem.value);
	});

	if (arrTids.length > 0) {

	    jQuery.each(arrTids, function (idx, tid) {
		jQuery.ajax({async: false, url: 'parse', type: 'POST', dataType: 'html',
		    data: {
			dos: dateStart.val(),
			doe: dateEnd.val(),
			fids: arrFids.join('|'),
			tid: tid
		    },
		    beforeSend: function () {
		    },
		    always: function () {
		    },
		    error: function () {
		    },
		    success: function (data) {
			result.append(data);
		    }
		}).done(function (data) {
		    var panel = jQuery("#grid_rate_" + tid);

		    // build data for save
		    var gridData = [];
		    jQuery.each(panel.find("table tbody tr"), function (i, row) {
			var rates = [];
			jQuery.each(arrFids, function (i, fid) {
			    rates.push({
				abbr: fid,
				value: jQuery(row).find('td.rate-val-' + fid).text()
			    });
			});
			gridData.push({
			    date: jQuery(row).find('td.rate-date').text(),
			    abbr: tid,
			    rates: rates
			});
		    });

		    jQuery("button#save_rate_" + tid).on("click", function () {
			jQuery.ajax({
			    async: true,
			    url: "save",
			    type: 'POST',
			    beforeSend: function () {
				$(this).attr("disabled", "disabled");
			    },
			    data: {grid: JSON.stringify(gridData)},
			}).done(function (data) {
//			    panel.removeClass("panel-default");
//			    panel.addClass("panel-info");
//			    panel.find('tr').addClass("success");
			});
		    });
		});
	    });
	}
	return false;
    });
    /**
     * CHECK ALL
     */
    checkAllTids.change(function () {
	tids.prop('checked', $(this).prop('checked'));
    });

    tids.change(function () {
	if (jQuery(this).prop('checked') == false)
	{
	    checkAllTids.prop('checked', false);
	}
    });

});