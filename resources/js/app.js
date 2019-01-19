
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.$ = $;

var form;

$('.delete').click(function (e) {
    e.preventDefault();
    form = $(this).closest('form');
    $('#delete-modal').modal('show')
});

$('#confirm-delete').click(function () {
    form.submit();
});

$('.add-set').click(function (e) {
    if ($('#lang1').val() === $('#lang2').val())
    {
        e.preventDefault();
        $('#error-add-set').modal('show');
    }
});


$('#new-words').click(function () {
    $('#words .last-row').before('<div class="row mt-1"> <div class="col-5"><input type="text" class="form-control" name="lang1[]" value="" required></div><div class="col-1"> < = ></div><div class="col-5"><input type="text" class="form-control" name="lang2[]" value="" required></div><div class="col-1"><div class="btn btn-primary btn-sm font-weight-bold remove-row">-</div></div></div>')
    $('.remove-row').click(function () {
        $(this).closest('.row').remove();
    });
});


$('.remove-row').click(function () {
    $(this).closest('.row').remove();
});
