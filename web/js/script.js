$(document).ready(function() {
    $('#add-subject').click(function(e) {
        var modal = $('#new-item-modal');
        modal.find('#modal-title').text("Disciplina");
        var name = modal.find('#field-name');
        name.find('label').text("Nome da disciplina");
        name.find('input').attr('placeholder', "Disciplina");

        modal.find('#field-professor').show();
        modal.modal();
    });

    $('#add-professor').click(function(e) {
        var modal = $('#new-item-modal');
        modal.find('#modal-title').text("Professor");
        var name = modal.find('#field-name');
        name.find('label').text("Nome do professor");
        name.find('input').attr('placeholder', "Professor");

        modal.find('#field-professor').hide();
        modal.modal();
    });

    $('#refresh-schedule').click(function(e) {
        window.alert("OI");
    });
});
