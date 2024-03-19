
 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"> 
<HTML>
    <HEAD>
        <TITLE>Sistema de Tramites en Linea</TITLE>
        <META http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <LINK href="../images/standard.css" type="text/css" rel="stylesheet">
        <META http-equiv="Expires" content="0"> 
        <META http-equiv="Pragma" content="No-cache"> 
        <META http-equiv="Cache-Control" content="no-cache"> 
        <SCRIPT type="text/javascript">
            var cadena = "12345678910-";
            function validar(form)
            {
                var cad = "";
                if (form.cums.value == "") {
                    alert("Por favor ingresar datos de CUM para revisar");
                    return false;
                }
                cad = form.cums.value;
                longitud = cad.length;
                for (t = 0; t < longitud; t++) {
                    c = cad.substring(t, t + 1);
                    asc = c.charCodeAt(0);
                    if (cadena.indexOf(c, 0) < 0 && asc != 10 && asc != 13) {
                        alert("El caracter: " + c + " no existe en el intervalo 0123456789-");
                        return false;
                    }
                }
                return true;
            }
        </SCRIPT>
    </HEAD>
    <BODY style="background-color: white; background-image: url('../images/repetir.gif')">
        <FORM name="xcum" onsubmit="return validar(this)" action="https://enlinea.invima.gov.co/rs/cum/ins_cum.jsp" method="post"                         
            <TABLE cellSpacing="0" cellPadding="0" width="763" border="0">
                <TR vAlign="top" align="left">
                    <TD width="232"></TD>
                    <TD>
                        <IMG src="../images/page00.jpg" width="232" border="0"> 
                    </TD>
                    <TD>
                        <TABLE style="WIDTH: 528px; HEIGHT: 27px; width: 528px; background-image: url('../images/page11.jpg'); border:0px;" cellspacing="0" cellpadding="0" >
                            <TBODY>
                                <TR style="text-align: center;">
                                    <TD style="width: 400px;">
                                        <FONT face="Verdana, Arial, Helvetica, sans-serif" color="#0000cc" size="2">
                                            Comprobacion de CUM 
                                        </FONT>
                                    </TD>
                                    <TD style="width: 25px;">
                                        &nbsp; 
                                    </TD>
                                    <TD style="width: 25px;">
                                        <A onmouseover="window.status = 'Ayuda';
                                                return true" onclick="ayuda('respuestas.html');
                                                        return true;" onmouseout="window.status = '';
                                                                return true" target="_top" title=" Ayuda "><IMG height="16" alt="Ayuda " hspace="0" src="../images/twgghelp.gif" width="16" border="0" name="GeneralMenu"></A>
                                    </TD>
                                    <TD style="width: 25px;"></TD>
                                    <TD style="width: 25px;">
                                        &nbsp; 
                                    </TD>
                                    <TD style="width: 25px;">
                                        &nbsp; 
                                    </TD>
                                    <TD style="width: 25px;">
                                        &nbsp; 
                                    </TD>
                                </TR>
                            </TBODY>
                        </TABLE>
                    </TD>
                </TR>
            </TABLE>
            <TABLE id="TABLE1" rules="none" width="769" align="left" border="0">
                <TR>
                    <TD colSpan="3">
                        <B>Para que la consulta de los CUM sea exitosa, tenga en
                            cuenta las siguientes recomendaciones:</B><BR> &nbsp;* Ingrese
                        los codigo CUM de la siguiente forma: <BR> &nbsp;12500-01<BR>
                        &nbsp;15000-02<BR> &nbsp;19980101-01<BR> <BR>&nbsp;* No utilice
                        caracteres diferentes a 1234567890- (No utilice espacios,no
                        deje lineas en blanco) <BR> &nbsp;*Cada CUM debe corresponder
                        a 1 fila <BR> 
                    </TD>
                </TR>
                <TR id="TR0">
                    <TH><B>Ingrese lista de codigos CUM para validar</B></TH>
                </TR>
                <TR>
                    <TD>
                        <TEXTAREA name="cums" cols="30" rows="20"></TEXTAREA>
            </TD>
        </TR>
        <TR id="TR1">
            <TD>
                <INPUT id="INPUT2" type="submit" value="Enviar Consulta" name="enviar">&nbsp;
                <INPUT id="INPUT3" type="reset" value="Limpiar" name="limpiar">
            </TD>
        </TR>
    </TABLE>
</FORM>
</BODY>
</HTML>
