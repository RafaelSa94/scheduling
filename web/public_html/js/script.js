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
                    <td><button class=\"btn btn-xs btn-danger delete-subject\" data-id=\"" + subject.id +"\"><span class=\"glyphicon glyphicon-trash\"></span></button></td>\
                    </tr>"));
            }
        }
    });
}

var loadProfessors = function() {
    var tbody = $('#professor-table tbody');
    var professorsField = $('#professor');
    $.ajax("/professors.php").done(function(data) {
        if (data.success) {
            tbody.empty();
            professorsField.empty();
            for (var i = 0; i < data.data.length; i++) {
                var professor = data.data[i];
                tbody.append(
                    $("<tr>\
                    <td>"+ professor.id +"</td>\
                    <td>"+ professor.name +"</td>\
                    <td>"+ professor.constraints +"</td>\
                    <td><button class=\"btn btn-xs btn-danger delete-professor\" data-id=\"" + professor.id +"\"><span class=\"glyphicon glyphicon-trash\"></span></button></td>\
                    </tr>"));
                professorsField.append(
                    $('<option value="'+ professor.id +'">'+ professor.name +'</option>')
                );
            }
        }
    });
}

var loadTimetable = function() {
    var table = $('#timetable');
    $.ajax("/timetable.php").done(function(data) {
        if (data.success) {
            for (var i = 1; i <= 10; i++) {
                var cell = table.find("td[data-time=\""+ i +"\"]");
                var subjects = data.data[i];

                if (subjects) {
                    cell.html(subjects.map(function(el, i) {
                        return "<b>"+ el.name +"</b> ("+ el.professor.name +")";
                    }).join("<br>"));
                }
            }
        }
    });
}

var insertProfessor = function(name, constraints, callback){
    $.post('/professors.php?insert', {'name': name, 'constraints[]': constraints})
    .done(function(data) {
        if (data.success) {
            loadProfessors();
            callback();
        }
    });
}

var insertSubject = function(name, professor_id, semester, callback){
    $.post('/classes.php?insert', {'name': name, 'professor_id': professor_id, 'semester': semester})
    .done(function(data) {
        if (data.success) {
            loadSubjects();
            callback();
        }
    });
}

var deleteProfessor = function(id) {
    $.post("/professors.php?delete", {'id': id})
    .done(function(data) {
        if (data.success) {
            loadProfessors();
            loadSubjects();
        }
    });
}

var deleteSubject = function(id) {
    $.post("/classes.php?delete", {'id': id})
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
        modal.data('type', "subject")

        modal.find('#modal-title').text("Turma");
        var name = modal.find('#field-name');
        name.find('label').text("Nome da disciplina");
        name.find('input').attr('placeholder', "Disciplina");

        modal.find('#field-professor').show();
        modal.find('#field-semester').show();
        modal.find('#constraints-group').hide();
        modal.modal();
    });

    $('#add-professor').click(function(e) {
        var modal = $('#new-item-modal');
        modal.data('type', "professor")

        modal.find('#modal-title').text("Professor");
        var name = modal.find('#field-name');
        name.find('label').text("Nome do professor");
        name.find('input').attr('placeholder', "Professor");

        modal.find('#field-professor').hide();
        modal.find('#field-semester').hide();
        modal.find('#constraints-group').show();
        modal.modal();
    });

    $(document).on('click', '.delete-professor', function(e) {
        var id = $(e.currentTarget).data('id');
        deleteProfessor(id);
    });

    $(document).on('click', '.delete-subject', function(e) {
        var id = $(e.currentTarget).data('id');
        deleteSubject(id);
    });

    $('#new-item-modal').on('shown.bs.modal', function () {
        $('#field-name input').focus();
    })

    $('#save-item').click(function(e) {
        var modal = $(e.currentTarget).parents('#new-item-modal');
        var type = modal.data('type');

        var name = modal.find('input#name').val();

        var callback = function() {
            modal.modal('hide');
        };

        switch (type) {
            case "professor":
                var constraints = modal.find('input[name=constraints]:not(:checked)').map(function() {
                    return this.value;
                }).get();

                insertProfessor(name, constraints, callback);
                break;

            case "subject":
                var professor = modal.find('select#professor').val();
                var semester = modal.find('input#semester').val();

                insertSubject(name, professor, semester, callback);
                break;

        }
    });

    $('#refresh-schedule').click(function(e) {
        loadTimetable();
    });
});
