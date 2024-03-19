					<div class="card" id="divexamen">
						<div class="card-header">
							Examen Físico
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label"><b>DESCRIPCION</b></label>
							<label class="col-sm-3 col-form-label"><b>ESTADO</b></label>
							<label class="col-sm-4 col-form-label"><b>HALLAZGO</b></label>
						</div>

						<?php
							//$cons_examen_prof="SELECT descripcion_def FROM vw_examenfisico_medico WHERE id_persona='$_SESSION[gusuario_log]'";
							if(!isset($id_con)){								
								$cons_examen_prof="SELECT vw_examenfisico_medico.descripcion_def,'' AS valor_exaf,'' AS hallazgo_exaf
								FROM vw_examenfisico_medico
								WHERE id_persona='$_SESSION[gusuario_log]'";
							}
							else{								
								$cons_examen_prof="SELECT vw_examenfisico_medico.descripcion_def,consulta_examen_fisico.valor_exaf,consulta_examen_fisico.hallazgo_exaf
								FROM vw_examenfisico_medico
								LEFT JOIN consulta_examen_fisico ON consulta_examen_fisico.descripcion_exaf=vw_examenfisico_medico.descripcion_def AND consulta_examen_fisico.id_con='$id_con'
								WHERE id_persona='$_SESSION[gusuario_log]'";
							}
							
							//echo $cons_examen_prof;
							$cons_examen_prof=mysqli_query($conexion,$cons_examen_prof);
							if(mysqli_num_rows($cons_examen_prof)<>0){
								$cef=0;
								while($rowef=mysqli_fetch_array($cons_examen_prof)){
									//echo "<br>".$rowef['descripcion_def'];
									?>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label"><?php echo $rowef['descripcion_def'];?></label>
										<div class="col-sm-3">
											<input type="hidden" id="descripcion_exaf[]" name="descripcion_exaf[]" maxlength="40" size="20" value="<?php echo $rowef['descripcion_def'];?>">
											<input type="text" class="form-control" id="valor_exaf[]" name="valor_exaf[]" maxlength="40" size="20" value="<?php echo $rowef['valor_exaf'];?>">
										</div>
										<div class="col-sm-7">											
											<input type="text" class="form-control" id="hallazgo_exaf[]" name="hallazgo_exaf[]" value="<?php echo $rowef['hallazgo_exaf'];?>">
										</div>
									</div>
									<?php
								}
							}
						?>					
					</div>
