<section id="content">
		<div class="main-content">
			<div class="title">
				BC Record Database
			</div>
			<div class="main">
				<div class="widget">
					<div class="title">
						
						<button disabled id="buttonDelete" class="btn btn-danger btn-sm float-right " type="button"  data-toggle="button">
							<i class="fa fa-trash"></i> 
						</button>
						<button disabled id="buttonEdit" class="btn btn-outline-dark btn-sm float-right mr-1" type="button"  data-toggle="button" aria-pressed="false" autocomplete="off" >
							<i class="fa fa-edit"></i> 
						</button>
						<button id="buttonNew" class="btn btn-outline-success btn-sm float-right mr-1" type="button"  data-toggle="button" aria-pressed="false" autocomplete="off"  >
							<i class="fa fa-plus"></i> 
						</button>
						<!-- Button trigger modal -->
						<button class="btn btn-info btn-sm  " type="button"  data-toggle="modal" data-target="#exampleModalCenter">
							Abrir ficha de paciente &nbsp;<i class="fa fa-search"></i> 
						</button>					
					</div>
					<div class="box" style="background-color: white;">
						<div style="overflow-x:auto;">
								<form method="post" action="action_makeappointment.php">
									<div class="form-inline">
										<label for="patientInputName">Paciente:</label>
										<!--<input type="text" class="form-control ml-2 mr-2" id="patientInputName" placeholder="Nome do Paciente">-->
										<div class="input-group w-25 mt-1 ml-1 mr-2">
											<input disabled type="text" class="form-control px-2" id="patientInputName" placeholder="Nome do Paciente">
											<!--<div class="input-group-append">
												<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>												
											</div>-->
										</div>

										<label for="data_nasc">Data Nasc: </label>
										<div class="input-group w-12 mt-1 ml-1 mr-2">
											<input disabled type="date" class="form-control px-2" id="data_nasc" size="2" >
											
										</div>

										<label for="sns">SNS: </label>
										<div class="input-group w-8  mt-1 ml-1 mr-2">
											<input disabled type="number" class="form-control px-2" id="sns" placeholder="171577056">
											
										</div>

										<label for="data_1c">Data 1ºC: </label>
										<div class="input-group w-12  mt-1 ml-1 mr-2">
											<input disabled type="date" class="form-control px-2" id="data_1c">
											
										</div>

										<label for="processo">Nº Processo: </label>
										<div class="input-group w-12 mt-1 ml-1 ">
											<input disabled type="number" class="form-control px-2 w-40 mr-1" id="processo" placeholder="11000">
											<input disabled type="number" class="form-control px-2 w-15" id="n_process" placeholder="1">
										</div>
										
									</div>

									<hr>

									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="menu1-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="menu1" aria-selected="true">Rastreio</a>
										<a class="nav-item nav-link" id="menu2-tab" data-toggle="tab" href="#menu2" role="tab" aria-controls="menu2" aria-selected="false">Localização</a>
										<a class="nav-item nav-link" id="menu3-tab" data-toggle="tab" href="#menu3" role="tab" aria-controls="menu3" aria-selected="false">Imagem</a>
										<a class="nav-item nav-link" id="menu4-tab" data-toggle="tab" href="#menu4" role="tab" aria-controls="menu4" aria-selected="false">Biopsias</a>
										<a class="nav-item nav-link" id="menu5-tab" data-toggle="tab" href="#menu5" role="tab" aria-controls="menu5" aria-selected="false">Estadiamento</a>
										<a class="nav-item nav-link" id="menu6-tab" data-toggle="tab" href="#menu6" role="tab" aria-controls="menu6" aria-selected="false">Cirurgia</a>
										<a class="nav-item nav-link" id="menu7-tab" data-toggle="tab" href="#menu7" role="tab" aria-controls="menu7" aria-selected="false">Patologia</a>
										<a class="nav-item nav-link" id="menu8-tab" data-toggle="tab" href="#menu8" role="tab" aria-controls="menu8" aria-selected="false">QT/RT/HT</a>
										<a class="nav-item nav-link" id="menu9-tab" data-toggle="tab" href="#menu9" role="tab" aria-controls="menu9" aria-selected="false">Follow-up</a>
									</div>

									<div class="tab-content border border-top-0 p-3" id="nav-tabContent">
										<div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="menu1-tab">
											<div class="container">
												<div class="row">
													<div class="col">
														<div class="form-check">
															<input class="form-check-input" type="radio" name="exampleRadios" id="simRadioRastreio" value="option1" checked>
															<label class="form-check-label" for="simRadioRastreio">Sim</label>
														</div>
														<div class="form-check">
															<input class="form-check-input" type="radio" name="exampleRadios" id="naoRadioRastreio" value="option2">
															<label class="form-check-label" for="naoRadioRastreio">Não</label>
														</div>
														<div class="form-inline">
															<div class="form-group mt-2">
																<label for="idRastreio" class="mr-2">Identificação(Nº/Conc./Volta):</label>
																<input type="text" class="form-control" id="idRastreio" placeholder="Ex:10023/Porto/203">
															</div>
														</div>
													</div>
													<div class="col">
														<div class="form-inline">
															<div class="form-group">
																<label for="dataAfericao" class="mr-2">Data de Aferição:</label>
																<input type="date" class="form-control" id="dataAfericao" >
															</div>
														</div>
														<div class="form-inline">
															<div class="form-group mt-3">
																<label for="dataRastreio" class="mr-2">Data de Rastreio:</label>
																<input type="date" class="form-control" id="dataRastreio" >
															</div>
														</div>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col">
														<div class="form-inline">
															<div class="form-group">
																<label for="morada" class="mr-2">Residência:</label>
																<input type="text" class="form-control" id="morada" placeholder="Ex:Av.Oliveira Martins 69B" >
															</div>
														</div>
														<div class="form-inline">
															<div class="form-group mt-3">
																<label for="idade" class="mr-2">Idade:</label>
																<input disabled type="number" class="form-control" id="idade" placeholder="51">
															</div>
														</div>
														<div class="form-inline">
															<div class="form-group mt-3">
																<label for="dataAfericao" class="mr-2">Estado Civil:</label>
																<input type="date" class="form-control" id="dataAfericao" placeholder="Casado">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="menu2-tab">
											<div class="container">
												<div class="row">
													<div class="col">
														<div class="form-check">
															<input class="form-check-input" type="radio" name="exampleRadios" id="simRadioRastreio" value="option1" checked>
															<label class="form-check-label" for="simRadioRastreio">Sim</label>
														</div>
														<div class="form-check">
															<input class="form-check-input" type="radio" name="exampleRadios" id="naoRadioRastreio" value="option2">
															<label class="form-check-label" for="naoRadioRastreio">Não</label>
														</div>
													</div>
													<div class="col">
														2 of 2
														</div>
												</div>
												<div class="row">
													<div class="col">
														1 of 3
													</div>
													<div class="col">
														2 of 3
													</div>
													<div class="col">
														3 of 3
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="menu3" role="tabpanel" aria-labelledby="menu3-tab">
										<table data-toggle="table">
											<thead>
												<tr>
													<th>Item ID</th>
													<th>Item Name</th>
													<th>Item Price</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Item 1</td>
													<td>$1</td>
												</tr>
												<tr>
													<td>2</td>
													<td>Item 2</td>
													<td>$2</td>
												</tr>
											</tbody>
										</table>
										</div>
										<div class="tab-pane fade" id="menu4" role="tabpanel" aria-labelledby="menu4-tab">...</div>
										<div class="tab-pane fade" id="menu5" role="tabpanel" aria-labelledby="menu5-tab">...</div>
										<div class="tab-pane fade" id="menu6" role="tabpanel" aria-labelledby="menu6-tab">...</div>
										<div class="tab-pane fade" id="menu7" role="tabpanel" aria-labelledby="menu7-tab">...</div>
										<div class="tab-pane fade" id="menu8" role="tabpanel" aria-labelledby="menu8-tab">...</div>
										<div class="tab-pane fade" id="menu9" role="tabpanel" aria-labelledby="menu9-tab">...</div>
									</div>							
							</form>		
						</div>
					</div>
				</div>				
			</div>
		</div>
		


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
		<table id="searchTable"
			data-url="php/auxTable.php"
			data-toggle="table"

			data-show-columns="true"			

			data-show-filter="true"
			data-toolbar=".toolbar"	
			
			data-pagination="true"
			data-page-size="5"
			data-show-pagination-switch="false"

			data-search="true"
			data-trim-on-search="false"
			>
			<thead>
				<tr>
					<th data-field="id" data-sortable="true" data-visible='false' >ID</th>
					<th data-field="nome" data-sortable="true" data-visible='true' >Nome</th>
					<th data-field="sns" data-sortable="true" data-visible='true' >SNS</th>
				</tr>
			</thead>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button id="buttonSearchTable" type="button" class="btn btn-primary">Procurar</button>
      </div>
    </div>
  </div>
</div>
</section>
