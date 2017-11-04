$(function () {
    $.mask.definitions['d'] = '[0-9]';
    $("input[name=birth]").datepicker("option", "yearRange", "1950:2020");
    $("input[name=number]").mask("(999) 999-99-99");
    $("input[name=extention]").mask("999");


});