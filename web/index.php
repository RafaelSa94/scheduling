<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Agendamento de aulas</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" media="screen">
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
                <h4>Disciplinas:
                    <small><button id="add-subject" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-plus"></span>
                        Adicionar
                    </button></small>
                </h4>
                <table class="table table-hover table-stripped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Disciplina</th>
                        <th>Professor</th>
                        <th>Restrições</th>
                    </tr>
                    <tr>
                        <td>0</td>
                        <td>Fasoejgl</td>
                        <td>Opsrhju Alkeuf</td>
                        <td>Seg/Qua 08:00 - 12:00</td>
                    </tr>
                </table>

                <h4>Professores:
                    <small><button id="add-professor" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-plus"></span>
                        Adicionar
                    </button></small>
                </h4>
                <table class="table table-hover table-stripped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Professor</th>
                        <th>Restrições</th>
                    </tr>
                    <tr>
                        <td>0</td>
                        <td>Opsrhju Alkeuf</td>
                        <td>Sex 08:00 - 18:00</td>
                    </tr>
                </table>

                <h4>Horário:
                    <small><button id="refresh-schedule" class="btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-refresh"></span>
                        Atualizar horário
                    </button></small>
                </h4>
                <table class="table table-hover table-stripped table-bordered">
                    <tr>
                        <th></th>
                        <th>Segunda</th>
                        <th>Terça</th>
                        <th>Quarta</th>
                        <th>Quinta</th>
                        <th>Sexta</th>
                    </tr>
                    <tr>
                        <td>8:00 - 10:00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10:00 - 12:00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>14:00 - 16:00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>16:00 - 18:00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="new-item-modal">
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
                        <div id="field-professor" class="form-group">
                            <label for="professor">Professor</label>
                            <select class="form-control">
                                <option>Professor 1</option>
                                <option>Professor 2</option>
                                <option>Professor 3</option>
                                <option>Professor 4</option>
                                <option>Professor 5</option>
                            </select>
                        </div>
                        <div class="form-group">
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
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                </tr>
                                <tr>
                                    <td>10:00-12:00</td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                </tr>
                                <tr>
                                    <td>14:00-16:00</td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                </tr>
                                <tr>
                                    <td>16:00-18:00</td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox"></label></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" disabled>Salvar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script src="/js/jquery-3.1.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/script.js"></script>
    </body>
</html>
