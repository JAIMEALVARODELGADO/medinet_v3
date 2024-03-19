                            <div class="form-group row">
                                <label for="numero_recant" class="col-sm-2 col-form-label">Número de Reclamación Anterior:</label>
                                <div class="col-sm-2">
                                    <input type="text" size="20" maxlenght="20" class="form-control" id="numero_recant" name="numero_recant">
                                </div>

                                <label for="respglo_recla" class="col-sm-2 col-form-label">Respuesta a Glosa:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="respglo_recla" name="respglo_recla">
                                        <option value="">Nueva Reclamación</option>
                                        <option value="0">Glosa Total</option>
                                        <option value="1">Pago Parcial</option>
                                    </select>
                                </div>
                                <label for="id_factura" class="col-sm-2 col-form-label">Número de Factura</label>
                                <div class="col-sm-2">
                                    <input type="text" size="10" maxlength="10" class="form-control" id="numero_fac" name="numero_fac">
                                    <input type='hidden' id='id_factura' name='id_factura'>
                                </div>
                                <label for="condi_victima" class="col-sm-2 col-form-label">Condición de la Víctima:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="condi_victima" name="condi_victima">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_condicion_victima ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="naturaleza_even" class="col-sm-2 col-form-label">Naturaleza del Evento:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="naturaleza_even" name="naturaleza_even">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_naturaleza_evento ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="descripcion_even" class="col-sm-1 col-form-label">Otro:</label>
                                <div class="col-sm-3">
                                    <input type="text" size="25" maxlength="25" class="form-control" id=" descripcion_even" name="descripcion_even">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="direccion_even" class="col-sm-2 col-form-label">Dirección del Evento:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="direccion_even" name="direccion_even" size="40" maxlength="40">
                                </div>
                                <label for="fecha_even" class="col-sm-2 col-form-label">Fecha y Hora del Evento:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="fecha_even" name="fecha_even" placeholder="aaaa-mm-dd hh:mm">
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <label for="descripcion_even" class="col-sm-2 col-form-label">Descripción del Evento:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="descripcion_even" name="descripcion_even" size="120" maxlength="120" placeholder="Descripción corta (maximo 25 caracteres)">
                                </div>                              
                            </div>
                            <div class="form-group row">
                                <label for="municipio" class="col-sm-2 col-form-label">Municipio del Evento:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="municipio" name=municipio" size="40" maxlength="40">
                                    <input type='hidden' id='municipio_even' name='municipio_even'>
                                </div>

                                <label for="zona_even" class="col-sm-1 col-form-label">Zona:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="zona_even" name="zona_even">
                                        <option value=""></option>
                                        <option value="R">Rural</option>
                                        <option value="U">Urbana</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <span class="btn btn-primary" title="Guardar" onclick="validar()" id="btn_nuevo">
                                    Guardar <span class="fas fa-save"></span></span>
                                    </span>
                                </div>
                            </div>
                            
                            