<section id="content">
    <div class="main-content">
        <div class="title">
            BC Record Database
        </div>
        <div class="main">
            <div class="widget">
                <div class="title">

                    <button id="buttonDelete" class="btn btn-danger btn-sm float-right d-none" type="button"
                        data-toggle="button">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button id="buttonEdit" class="btn btn-outline-dark btn-sm float-right mr-1 d-none" type="button"
                        data-toggle="button" aria-pressed="false" autocomplete="off">
                        <i class="fa fa-edit"></i>
                    </button>


                    <button id="buttonSave" class="btn btn-success btn-sm float-right mr-1 d-none" type="button" form="formProcesso">
                        GUARDAR &nbsp;<i class="fa fa-floppy-o"></i>
                    </button>

                    <button id="buttonInsert" class="btn btn-success btn-sm float-right mr-1 d-none" type="button" form="formProcesso">
                        INSERIR &nbsp;<i class="fa fa-floppy-o"></i>
                    </button>


                    <!-- Button trigger modal -->
                    <button class="btn btn-info btn-sm  mr-1" type="button" data-toggle="modal" data-target="#openRegistoModal">
                        Abrir Registo &nbsp;
                        <i class="fa fa-search"></i>
                    </button>

                    <button id="buttonNew" class="btn btn-outline-info btn-sm mr-1" type="button" >
                        Novo Registo &nbsp;<i class="fa fa-plus"></i>
                    </button>


                </div>
                <div class="box" style="background-color: white;">
                    <div style="overflow-x:auto;">
                        <form id="formProcesso" name="formProcesso">
                            <?php include_once('bcrecord/header.html') ?>

                            <hr>

                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="menu1-tab" data-toggle="tab" href="#menu1" role="tab"
                                    aria-controls="menu1" aria-selected="true">Rastreio</a>
                                <a class="nav-item nav-link" id="menu10-tab" data-toggle="tab" href="#menu10" role="tab"
                                    aria-controls="menu10" aria-selected="false">Exame Físico</a>
                                <a class="nav-item nav-link" id="menu2-tab" data-toggle="tab" href="#menu2" role="tab"
                                    aria-controls="menu2" aria-selected="false">Localização</a>
                                <a class="nav-item nav-link" id="menu3-tab" data-toggle="tab" href="#menu3" role="tab"
                                    aria-controls="menu3" aria-selected="false">Imagem</a>
                                <a class="nav-item nav-link" id="menu4-tab" data-toggle="tab" href="#menu4" role="tab"
                                    aria-controls="menu4" aria-selected="false">Biopsias</a>
                                <a class="nav-item nav-link" id="menu5-tab" data-toggle="tab" href="#menu5" role="tab"
                                    aria-controls="menu5" aria-selected="false">Estadiamento</a>
                                <a class="nav-item nav-link" id="menu6-tab" data-toggle="tab" href="#menu6" role="tab"
                                    aria-controls="menu6" aria-selected="false">Cirurgia</a>
                                <a class="nav-item nav-link" id="menu7-tab" data-toggle="tab" href="#menu7" role="tab"
                                    aria-controls="menu7" aria-selected="false">Histologia</a>
                                <a class="nav-item nav-link" id="menu8-tab" data-toggle="tab" href="#menu8" role="tab"
                                    aria-controls="menu8" aria-selected="false">T.Sistémico</a>
                                <a class="nav-item nav-link" id="menu9-tab" data-toggle="tab" href="#menu9" role="tab"
                                    aria-controls="menu9" aria-selected="false">Follow-up</a>
                                
                            </div>

                            <div class="tab-content border border-top-0 p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="menu1-tab">
                                    <?php include_once('bcrecord/tab1_rastreio.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="menu2-tab">
                                    <?php include_once('bcrecord/tab2_localizacao.html') ?>
                                </div>
                                <div class="tab-pane fade" name="menu3" id="menu3" role="tabpanel" aria-labelledby="menu3-tab">
                                    <?php include_once('bcrecord/tab3_imagem.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu4" role="tabpanel" aria-labelledby="menu4-tab">
                                    <?php include_once('bcrecord/tab4_biopsia.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu5" role="tabpanel" aria-labelledby="menu5-tab">
                                    <?php include_once('bcrecord/tab5_estadiamento.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu6" role="tabpanel" aria-labelledby="menu6-tab">
                                    <?php include_once('bcrecord/tab6_cirurgia.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu7" role="tabpanel" aria-labelledby="menu7-tab">
                                    <?php include_once('bcrecord/tab7_histologia.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu8" role="tabpanel" aria-labelledby="menu8-tab">
                                    <?php include_once('bcrecord/tab8_tsistemico.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu9" role="tabpanel" aria-labelledby="menu9-tab">
                                    <?php include_once('bcrecord/tab9_followup.html') ?>
                                </div>
                                <div class="tab-pane fade" id="menu10" role="tabpanel" aria-labelledby="menu10-tab">
                                    <?php include_once('bcrecord/tab10_examefisico.html') ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="openRegistoModal" tabindex="-1" role="dialog" aria-labelledby="openRegistoModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Procurar Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="filter-bar"></div>
                    <table id="searchTableModal" data-url="php/ajax_list_patients.php" data-toggle="table" data-show-columns="true"
                        data-show-filter="true" data-toolbar=".toolbar" data-pagination="true" data-page-size="5"
                        data-show-pagination-switch="false" data-search="true" data-trim-on-search="false">
                        <thead>
                            <tr>
                                <th data-field="id_processo" data-sortable="true" data-visible='true'>ID</th>
                                <th data-field="n_proc" data-sortable="true" data-visible='true'>P</th>
                                <th data-field="nome" data-sortable="true" data-visible='true'>Nome</th>
                                <th data-field="data_nasc" data-sortable="true" data-visible='true'>Data Nasc.</th>
                                <th data-field="sns" data-sortable="true" data-visible='true'>SNS</th>
                                <th data-field="contacto" data-sortable="true" data-visible='true'>Contacto</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="buttonOpenRecord" type="button" class="btn btn-primary">Procurar</button>
                </div>
            </div>
        </div>
    </div>

</section>