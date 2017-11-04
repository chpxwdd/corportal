$(function () {

    /**
     * GRID TOOLBAR
     */
    $('.tmpl-grid-toolbar').find('ul.grid-tbar-actions li').on('click', function () {
	var button = $(this).find('a:eq(0)');
	var placeholder = button.attr('placeholder');

	// get select rowId
	var selectRow = $('.tmpl-grid').find('tbody tr.selectRow');

	/**/console.log(selectRow.attr('id'));
	var href = location.href + '/' + placeholder;
	
	switch (placeholder) {
	    default:
		break;
	    case 'add':
		break;
	    case 'edit':
	    case 'drop':
	    case 'view':
		href += '/' + selectRow.attr('id');
		break;
	}
	
	/**/console.log(href);
	$(this).attr('href',href);
	
	window.location = href;
//	var content;
//	$.ajax({
//	    async: false,
//	    url: href,
//	    type: 'POST',
//	    dataType: 'html',
//	    beforeSend: function () {
//		$(this).attr("disabled", "disabled");
//	    }
//	}).done(function (data) {
//	    content = data;
//	});
//
//	var modalForm = getModalWindow(button.attr('alt'), content, 'form');
//	modalForm.modal('show');
	
    });

    // select row click
    $(".tmpl-grid").find('tbody tr').on('click', function () {
	$(this).parent('tbody').find('tr').removeClass('selectRow text-primary');
	$(this).addClass('selectRow text-primary');
    });

    function getModalWindow(title, content, type) {
	var modal = $('<div/>', {
	    class: 'modal slide'});
	var modalDialog = $('<div/>', {
	    class: 'modal-dialog'});
	var modalContent = $('<div/>', {
	    class: 'modal-content'});
	var modalBody = $('<div/>', {
	    class: 'modal-body'});
	var modalFooter = $('<div/>', {
	    class: 'modal-footer'});
	var modalFooterClose = $('<button/>', {
	    class: 'btn btn-default',
	    type: 'button',
	    text: 'Закрыть'})
		.attr('data-dismiss', 'modal');
	var modalFooterAction = $('<button/>', {
	    class: 'btn btn-primary',
	    type: 'button',
	    text: 'Сохранить'});
	modalContent.append(modalBody.append(content));
	modal.append(modalDialog.append(modalContent));
	// если тип форма или...
	// то выводим без header и footer
	if (type == 'form') {
	    return modal;
	}
	modalContent.append(modalFooter
		.append(modalFooterClose)
		.append(modalFooterAction));
	if (title) {
	    var modalHeaderTitle = $('<h4/>', {
		class: 'modal-title',
		text: title
	    });
	    var modalHeader = $('<div/>', {
		class: 'modal-header'
	    });
	    modalContent.append(modalHeader.append(modalHeaderTitle));
	}
	return modal;
    }
});