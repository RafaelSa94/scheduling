var loadSubjects = function() {
    var tbody = $('#subject-table tbody');
    $.ajax("/classes.php").done(function(data) {
        if (data.success) {
            tbody.empty();
            for (var i = 0; i < data.data.length; i++) {
                var subject = data.data[i];
                tbody.append(
                    $("<tr>\
                    <td>"+ subject.id +"</td>\
                    <td>"+ subject.name +"</td>\
                    <td>"+ subject.professor.name +"</td>\
                    <td>"+ subject.semester +"</td>\
                    <td>"+ subject.professor.constraints +"</td>\
                    </tr>"));
            }
        }
    });
}

var loadProfessors = function() {
    var tbody = $('#professor-table tbody');
    $.ajax("/professors.php").done(function(data) {
        if (data.success) {
            tbody.empty();
            for (var i = 0; i < data.data.length; i++) {
                var professor = data.data[i];
                tbody.append(
                    $("<tr>\
                    <td>"+ professor.id +"</td>\
                    <td>"+ professor.name +"</td>\
                    <td>"+ professor.constraints +"</td>\
                    </tr>"));
            }
        }
    });
}

var insertProfessor = function(name, restrictions){
    $.post('/professors.php?insert', {'name': name, 'constraints[]': restrictions})
    .done(function(data) {
        if (data.success) {
            loadProfessors();
        }
    });
}

var insertSubject = function(name, professor_id, semester){
    $.post('/classes.php?insert', {'name': name, 'professor_id': professor_id, 'semester': semester})
    .done(function(data) {
        if (data.success) {
            loadSubjects();
        }
    });
}

$(document).ready(function() {
    loadSubjects();
    loadProfessors();

    $('#add-subject').click(function(e) {
        var modal = $('#new-item-modal');
        modal.find('#modal-title').text("Turma");
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

    $('#new-item-modal').on('shown.bs.modal', function () {
        $('#field-name input').focus();
    })

    $('#refresh-schedule').click(function(e) {
        window.alert("Função ainda não implementada");
    });
});
