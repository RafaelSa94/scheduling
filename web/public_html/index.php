<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Agendamento de aulas</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="/css/style.css" media="screen">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-brand">Agendamento de aulas</div>
                </div>
            </div>
        </nav>
        <div class="container" style="margin-top: 60px;">
            <div class="row">
                <h4>Turmas:
                    <small><button id="add-subject" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-plus"></span>
                        Adicionar
                    </button></small>
                </h4>
                <div class="table-overflow">
                    <table id="subject-table" class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Disciplina</th>
                                <th>Professor</th>
                                <th>Período</th>
                                <th>Restrições</th>
                                <th width="60"><span class="glyphicon glyphicon-trash"></span></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>

                <h4>Professores:
                    <small><button id="add-professor" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-plus"></span>
                        Adicionar
                    </button></small>
                </h4>
                <div class="table-overflow">
                    <table id="professor-table" class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Professor</th>
                                <th>Restrições</th>
                                <th width="60"><span class="glyphicon glyphicon-trash"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <h4>Horário:
                    <small><button id="refresh-schedule" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-refresh"></span>
                        Atualizar horário
                    </button></small>
                </h4>
                <table id="timetable" class="table table-hover table-stripped table-bordered">
                    <tr>
                        <th style="background: #fff;
                            border-top: 1px solid #fff;
                            border-left: 1px solid #fff;"></th>
                        <th>Segunda</th>
                        <th>Terça</th>
                        <th>Quarta</th>
                        <th>Quinta</th>
                        <th>Sexta</th>
                    </tr>
                    <tr>
                        <td>8:00 - 10:00</td>
                        <td data-time="1"></td>
                        <td data-time="5"></td>
                        <td data-time="1"></td>
                        <td data-time="5"></td>
                        <td data-time="9"></td>
                    </tr>
                    <tr>
                        <td>10:00 - 12:00</td>
                        <td data-time="2"></td>
                        <td data-time="6"></td>
                        <td data-time="2"></td>
                        <td data-time="6"></td>
                        <td data-time="9"></td>
                    </tr>
                    <tr>
                        <td>14:00 - 16:00</td>
                        <td data-time="3"></td>
                        <td data-time="7"></td>
                        <td data-time="3"></td>
                        <td data-time="7"></td>
                        <td data-time="10"></td>
                    </tr>
                    <tr>
                        <td>16:00 - 18:00</td>
                        <td data-time="4"></td>
                        <td data-time="8"></td>
                        <td data-time="4"></td>
                        <td data-time="8"></td>
                        <td data-time="10"></td>
                    </tr>
                </table>
                <div class="bottom-spacing"></div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="new-item-modal" data-type="subject">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 id="modal-title" class="modal-title">Disciplina</h4>
                    </div>
                    <div class="modal-body">
                        <div id="field-name" class="form-group">
                            <label for="name">Nome da disciplina</label>
                            <input type="text" class="form-control" id="name" placeholder="Disciplina">
                        </div>
                        <div id="field-semester" class="form-group">
                            <label for="semester">Período do curso:</label>
                            <input type="number" class="form-control" id="semester" placeholder="Semestre">
                        </div>
                        <div id="field-professor" class="form-group">
                            <label for="professor">Professor</label>
                            <select id="professor" class="form-control">

                            </select>
                        </div>
                        <div id="constraints-group" class="form-group">
                            <label>Restrições</label>
                            <table class="table table-bordered">
                                <tr>
                                    <th></th>
                                    <th>Seg/Qua</th>
                                    <th>Ter/Qui</th>
                                    <th>Sex</th>
                                </tr>
                                <tr>
                                    <td>08:00-10:00</td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="01" checked> 1
                                    </label></td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="05" checked> 5
                                    </label></td>
                                    <td rowspan="2"><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="09" checked> 9
                                    </label></td>
                                </tr>
                                <tr>
                                    <td>10:00-12:00</td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="02" checked> 2
                                    </label></td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="06" checked> 6
                                    </label></td>
                                </tr>
                                <tr>
                                    <td>14:00-16:00</td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="03" checked> 3
                                    </label></td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="07" checked> 7
                                    </label></td>
                                    <td rowspan="2"><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="10" checked> 10
                                    </label></td>
                                </tr>
                                <tr>
                                    <td>16:00-18:00</td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="04" checked> 4
                                    </label></td>
                                    <td><label class="checkbox-inline">
                                        <input name="constraints" type="checkbox" value="08" checked> 8
                                    </label></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button id="save-item" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src="/js/jquery-3.1.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/script.js"></script>
    </body>
</html>
