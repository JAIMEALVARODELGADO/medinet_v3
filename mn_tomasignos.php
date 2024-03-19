					<div class="card" id="divsignos">
						<div class="card-header">
							Signos Vitales
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Tensión Arterial</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="tensionart_sv" name="tensionart_sv" maxlength="7" size="7">							
							</div>
							<label class="col-sm-2 col-form-label">Frecuencia Respiratoria</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="frecresp_sv" name="frecresp_sv" maxlength="3" size="3">								
							</div>
							<label class="col-sm-2 col-form-label">Frecuencia Cardiaca</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="freccard_sv" name="freccard_sv" maxlength="3" size="3">								
							</div>
							<label class="col-sm-2 col-form-label">Temperatura</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="temperat_sv" name="temperat_sv" maxlength="4" size="4">								
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Perimietro Cefálico</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="perimetrocef_sv" name="perimetrocef_sv" maxlength="2" size="2">								
							</div>
							<label class="col-sm-2 col-form-label">Peso</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="peso_sv" name="peso_sv" maxlength="3" size="3" placeholder="En kg" onblur="calculaimc()">	
							</div>
							<label class="col-sm-2 col-form-label">Talla</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="talla_sv" name="talla_sv" maxlength="3" size="3" placeholder="En cm" onblur="calculaimc()">								
							</div>
							<label class="col-sm-2 col-form-label">IMC</label>
							<div class="col-sm-1">
								<input type="text" class="form-control" id="indicemc_sv" name="indicemc_sv" maxlength="3" size="3">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Indice Cintura Cadera</label>
							<div class="col-sm-1">								
								<input type="text" class="form-control" id="indicecc_sv" name="indicecc_sv" maxlength="3" size="3">								
							</div>							
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Observación</label>
							<div class="col-sm-10">
								<textarea rows="3" class="form-control" id="observacion_sv" name="observacion_sv" maxlength='250' placeholder="Observacion" required></textarea>
							</div>  							
						</div>
					</div>
