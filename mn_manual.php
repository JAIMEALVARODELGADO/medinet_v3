<?php
require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Manual de Usuario - Medinet</h4>
                    </div>
					<div class="accordion" id="accordionManual">
					  <div class="card">
					    <div class="card-header" id="headingGeneralidades">
					      <h5 class="mb-0">
					        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Generalidades
					        </button>
					      </h5>
					    </div>

					    <div id="collapseOne" class="collapse" aria-labelledby="headingGeneralidades" data-parent="#accordionManual">
					      <div class="card-body">
					      	En la parte superior, casi siempre esta visibe el menú por el cual puede navegar (de acuerdo al perfil del usuario). El botón Inicio lo lleva siempre a la pantalla inicial, el Botón Ayuda, le permite visualizar las características de la aplicación, y este manual. El botón Salir, cierra la sesion para terminar el trabajo o para que se pueda registrar otro usuario.
					      	<br><br>Durante la ejecución de la aplicación se muestran ventanas de confirmación de las acciones a realizar y mensajes emergentes del estado de la acción, en color verde, cuando la accion se ejecuta con éxito o de color rojo, cuando no se pudo ejecutar.
					      	<br>La aplicación contiene varios tipos de botones así:
					      	<br><button type="button" class="btn btn-primary">Primario <span class="fas fa-angle-double-left"></span></button>Botón primario: De color azul, Generalmente utilizado para guardar información.
					      	<br><button type="button" class="btn btn-success">Suceso <span class="fas fa-angle-double-left"></span></button>Botón suceso: De color verde, Generalmente utilizado para ejecutar acciones importantes.
					      	<br><button type="button" class="btn btn-warning">Cuidado <span class="fas fa-angle-double-left"></span></button>Botón cuidado: De color amarillo, Generalmente utilizado para ejecutar acciones importantes, que puden alterar la información.
					      	<br><button type="button" class="btn btn-danger">Peligro <span class="fas fa-angle-double-left"></span></button>Botón peligro: De color rojo, Generalmente utilizado para ejecutar acciones irreversibles (como borrar información, etc).
					      	<br><button type="button" class="btn btn-secondary">Secundario <span class="fas fa-angle-double-left"></span></button>Botón secundario: De color gris, el accionar de este botón no implica acciones importantes. En algunos casos indica que la acción no está permitida y no realiza ninguna acción.

					      	<br><br>En toda la aplicación se muestran tablas con la información acorde con la opción seleccionada. Varias de estas tablas (por la cantidad de información), contienen un cuadro de texto llamado Search: que le permite filtrar información más puntual. Tambien tiene un cuadro de selección Show entries, que le permite seleccionar el numero de registros a visualizar por página. Finalmente, en el título de cada columna se muestran una flecha hacia arriba y otra hacia abajo, que le indican que se puede ordenar la información por esta columna.

					      	<br><br>Existen campos autocomplete (donde se solicita información de paciente, ocupacion, cups, cie10, etc.), donde a medida que se digita la información se despliega un listado de la información que cumple con las condiciones digitadas. Para seleccionar al opcion correcta, debe ubicarse con el puntero del mouse u hacer click en la opcion deseada.
					      	<br>En el caso de pacientes, si no existe la persona correcta se debe crear, asegurandose antes que el numero de identificación sea el correcto.
					      	<br>En el caso de CUPS, CIE10 u Ocupaciones, si no existe asegurese de que la descripción o el código buscado sea el correcto, ya que esta informacón es normativa. Si definitivamente no existe la puede crear por la opcion de <b>Administración</b>

					      	<br><br>Los campos de fecha, se pueden seleccionar del calendario o digitar directamente en el formato <b>dd/mm/aaaa</b>

					      	<br><br>En las consultas y los informes donde se solicita rangos de fechas, estos campos se presentan llenos con la fecha actual.

					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" id="headingProceso">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          Proceso
					        </button>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse show" aria-labelledby="headingProceso" data-parent="#accordionManual">
					      <div class="card-body">
					      	El proceso normal para el funcionamiento de la aplicación implica:
					        <br>1.- Crear personas: Datos personales y datos como paciente(Requeridos por resolucion 3374, resolucion 4505, resolucion 812)
					        <br>2.- Crear Horarios
					        <br>3.- Asignar Cita
					        <br>4.- Realizar Historia
					        <br>5.- Crear Factura
					        <br>6.- Generar Cuenta de Cobro
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingAdmision">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          Admisiones
					        </button>
					      </h5>
					    </div>
					    <div id="collapseThree" class="collapse" aria-labelledby="headingAdmision" data-parent="#accordionManual">
					      <div class="card-body">
					      	<b>Pesonas</b>
					        <br>Le permite realizar la administracion de la informacion de todas las personas que interactuan con la aplicación. (Pacientes, usuarios del sistema, personal asistencial).
					        <br>Esta opción está dividida en dos segmentos:
					        <br>1.- Información básica de la persona (para todas las personas)
					        <br>2.- Información del paciente (Cuando la persona es un paciente: se solicita información para rips, 4504, etc.)
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingAdmision">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
					          Agenda
					        </button>
					      </h5>
					    </div>
					    <div id="collapseFour" class="collapse" aria-labelledby="headingAdmision" data-parent="#accordionManual">
					      <div class="card-body">
					      	Le permite gestionar la agenda de los profesionales. Por comodidad del operador están dispuestos en el siguiente orden:
					      	<br>Asginar Cita
					      	<br>Horarios
					      	<br>Asginar Cita sin Agenda
					      	<br><br><h5><b>Horarios</b></h5>
					        <br>Le permite crear los horarios de los profesionales. Utiliza dos pestañas así:
					        <br><b>Generar Horarios:</b>
					        <br>Le solicita la siguiente información:
					        <br><br>Profesional: Este debe ser creado con anterioridad, como persona y luego como <b>Usuario del Sistema</b>, con la opcion agendar chequeada, además debe estar activo.
					        <br><br>Fecha Inicial, Hora Inicial, Fecha Final, Hora Final: Es el rango de fechas y horas entre las cuales se le abrirá agenda al profesional. Ejemplo: Si el profesional va a atender la semana del 5 al 9 de noviembre de 2018, entre las 08 am y las 12 am, entonces la fecha inicial será 05/11/2018 y la fecha final será 09/11/2018 y la hora inicial será 08:00 am y la hora final será 12:00 am.
					        <br><br>Minutos por turno: Es la cantidad de tiempo que tendrá el profesional para hacer la atención de un paciente.
					        <br><br>Turnos por horario: Es la cantidad de pacientes que el profesional puede atender en un turno. (Generalmente un solo paciente por turno a excepcion de terapias que puede ser mas de un paciente por turno).
					        <br><br>Días: Le permite seleccionar los días de la semana que el profesional va a atender. Volviendo al ejemplo anterior, si el profesional va a atender (en el rango de fechas planteado), los días lunes, martes, jueves y viernes, unicamente se selecciona estos días.
					        <br><br>El botón Generar Horarios, crea la agenda para el profesional de acuerdo al los parámetros antes seleccionados.
					        <br><br><b>Horarios Disponibles</b>
					        <br>Esta pestaña le permite visualizar todos los horarios disponibles, a su vez contiene el botón Borrar Registro, que borra el horario.

					        <br><br><b>Horarios Disponibles</b>
					        <br>Esta pestaña le permite visualizar todos los horarios disponibles, a su vez contiene el botón Borrar Registro, que borra el horario.

					        <br><br><h5><b>Citas</b></h5>
					        <br>Le permite asignar cita a los pacientes, teniendo en cuenta la disposición de horarios del profesional. Utiliza tres pestañas así:
					        
					        <br><br><b>Asignar Cita:</b>
					        <br>Presenta dos secciones, en la parte izquirda la seccion de la informacion de la cita y en la parte derecha los horarios disponibles. En la seccion de información de la cita solicita la siguiente información:
					        <br><br>Paciente: Puede digitar el numero de identificación o el nombre del paciente. A medida que digita la información, el programa le presenta un listado de pacientes registrados con la información que digita. Este debe ser creado con anterioridad, como persona y luego como <b>Paciente</b>.
					        <br><br>EPS: Debe seleccionar la EPS a la que pertenece el paciente
					        <br><br>Profesional: Debe seleccionar el profesional con quien se desea asignar la cita. En el momento de salir de este campo, se refresca la seccion de horarios disponibles con la informacion del profesional.
					        <br><br>Fecha: Al seleccionar la fecha y salir del campo, se refresca la seccion de horarios disponibles, con la fecha seleccionada.
					        <br><br>Observación: Puede colocar una observación que el profesional de la salud va a visualizar cuando revise la agenda.
					        <br><br>Con esta información puede seleccionar el horario deseado en la seccion horarios disponibles y posteriormente guardar la cita.
					        <br><br>Existe un botón <b>Mostrar Citas del Paciente</b> que le muestra un listado con las citas que ha tenido y tendrá el paciente

					        <br><br><b>Cancelar Cita:</b>
					        <br>Permite hacer la cancelación de citas y liberacion del horario. Presenta dos secciones, en la parte izquirda la seccion de la informacion de la cita y en la parte derecha las citas asignadas. En la seccion de información de la cita solicita la siguiente información:
					        <br><br>Paciente: Puede digitar el numero de identificación o el nombre del paciente. En el momento de salir de este campo, se refresca la seccion de citas asignadas con la informacion correspondiente.
					        <br><br>EPS: le permite seleccionar la EPS a la que pertenece el paciente a cancelar la cita. En el momento de salir de este campo, se refresca la seccion de citas asignadas con la informacion correspondiente.
					        <br><br>Profesional: Puede seleccionar el profesional a quien se desea cancelar la cita. En el momento de salir de este campo, se refresca la seccion de horarios disponibles con la informacion correspondiente.
					        <br><br>Fecha: Puede seleccionar la fecha de la cual se va a realizar la cancelacion de la cita. En el momento de salir de este campo, se refresca la seccion de citas asignadas con la informacion correspondiente.
					        <br><br>Con esta información puede seleccionar la cita asignada en la seccion citas asignadas y posteriormente cancelarla con el botón correspondiente.

					        <br><br><b>Trasladar Agenda:</b>
					        <br>Permite hacer el traslado de los pacientes agendados de un profesional a otro. Presenta dos secciones, en la parte izquirda la seccion Horario del Profesional Agendado y en la parte derecha la seccion Agenda del Profesional que Atenderá. En la seccion Horario del Profesional Agendado, solicita el profesional y la fecha. En la parte inferior se muestra una tabla con los horarios utilizados. y le presenta el botón Trasladar, que le permite realizar el traslado correspondiente.
					        <br><br>En la seccion Agenda del Profesional que Atenderá, le permite seleccionar el profesional que realizará la atención, a su vez muestra una tabla con la información de la su agenda.

					        <br><br><h5><b>Asignar Cita sin Agenda</b></h5>
					        <br>Le permite asignar cita directas, sin necesidad de generar horarios. Solicita la siguiente información:
					        <br><br>Paciente: Puede digitar el numero de identificación o el nombre del paciente. A medida que digita la información, el programa le presenta un listado de pacientes registrados con la información que digita. Este debe ser creado con anterioridad, como persona y luego como <b>Paciente</b>.
					        <br><br>EPS: Debe seleccionar la EPS a la que pertenece el paciente
					        <br><br>Profesional: Debe seleccionar el profesional con quien se desea asignar la cita.
					      	<br><br>Fecha: Debe seleccionar la fecha y la hora de la cita.
					        <br><br>Observación: Puede colocar una observación que el profesional de la salud va a visualizar cuando revise la agenda.
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingHistoria">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
					          Historia
					        </button>
					      </h5>
					    </div>
					    <div id="collapseFive" class="collapse" aria-labelledby="headingHistoria" data-parent="#accordionManual">
					      <div class="card-body">
					      	<h5><b>Pacientes Agendados</b></h5>
					        <br>Muesta el listado de pacientes agendados para el profesional, en la fecha actual. Contiene los siguientes botones:
					        <br>1.- Registrar Atención: Le permite realizar la historia de consulta
					        <br>2.- Registrar Inasistencia: Le permite marcar la cita como inasistencia cuando el paciente no cumple con su cita.
					        <br>3.- Imprimir Historia: Le permite realizar la impresion de la historia cuando el profesional haya terminado la atención.
					        <br>4.- Imprimir Formula: Le permite realizar la impresion de la formula médica cuando el profesional haya terminado la atención.
					        <br>5.- Imprimir Ordenes: Le permite realizar la impresion de las diferentes ordenes que haya realizado el profesional.
					        <br><br><b>Registrar Atención</b>
					        Permite la realización de la historia de consulta del paciente, esta contiene 5 pestañas así:
					        <br><br><b>Historia</b>
					        <br>Se divide en varias secciones así:
					        <br>Informacón del Paciente: El profesional debe registrar la información básica del paciente en el momento de la consulta, para agilizar el registro se presenta la información registrada con anterioridad, pero el profesional la pude actualizar si el lo considera necesario.
					        <br><br>Informacón del Acudiente: El profesional pude registrar la información básica del acompañante del paciente en el momento de la consulta, si el profesional lo considera necesario.
							<br><br>Anamnesis: El profesional debe registrar el motivo de consulta, la enfermedad actual y la revision por sistemas.
							<br><br>Antecedentes: El profesional debe registrar los antecedentes personales y familiares del paciente.
							<br><br>Impresión Diagnóstica: El profesional debe seleccionar el código CUPS que corresponda a la consulta (para dar cumplimiento a RIPS), estos deben ser asignados anteriormente al profesional, en la opcion <b>CUPS por Profesional</b> del menú <b>Administración</b>. Finalidad de la consulta, Causa Externa, Análisis, Diagnóstico Principal, Tipo de Diagnóstico Principal, tres (3) diagnósticos relacionados (opcionales) y una observación de la consulta.
							<br><b>Nota:</b> Debe guardar la información antes de pasar a las otras pestañas, si no lo hace perderá la información ingresada.

					        <br><br><b>Formula</b>
					        <br>Le permite registrar los medicamentos formulados al paciente. Le solicita la descripción del medicamento (principio activo), dosis, frecuencia, vía de administración, tiempo de tratamiento (en días), cantidad formulada y una observación.
					        <br>Después de haber guardado el registro, puede editarlo para hacer correcciones, o puede eliminarlo si el profesional lo considera.

					        <br><br><b>Ordenes</b>
					        Le permite el registro de las órdenes que el profesional considere (laboratorio, imagenes diagnósticas, remisiones, etc.). Para esto solicita la siguiente información:
					        <br>Tipo de Orden: Debe seleccionar el tipo de orden que va a registrar. Estas debe estar registradas con anterioridad en la opción <b>Conceptos</b> en el menú <b>Administración</b>
							<br>Descripción: Debe digitar el código CUPS o la descripción CUPS de la actividad a ordenar.
							<br>Observación: Puede realizar una descripción adicional o aclaratoria de la solicitud.

					        <br><br><b>Finalizar Consulta</b>
					        <br>Le permite cerrar la historia. El cerrar la historia implica que el profesional no podrá hacer ninguna corrección de la misma, por lo que el profesional debe estar seguro de haber terminado completamente su historia. (Esto de acuerdo a lo dispuesto en la resolucion 1995)

					        <br><br><b>Pacientes Agendados</b>
							<br>Le permite regresar al listado de pacientes agendados. Si no se cierra la historia, podrá ingresar nuevamente a terminarla.

							<br><br><h5><b>Consultar Historias</b></h5>
							<br>Permite la consulta de historias cerradas de pacientes, bajo diferentes criterios.
					        
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingFacturacion">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
					          Facturación
					        </button>
					      </h5>
					    </div>
					    <div id="collapseSix" class="collapse" aria-labelledby="headingFacturacion" data-parent="#accordionManual">
					      <div class="card-body">
					      	Le permite gestionar la facturación y los convenios realizados con las diferentes EPS.

					      	<h5><b>Convenios</b></h5>
					        <br>Muesta el listado de los convenios realizados con las diferentes entidades contratantes y le permite registrar nuevos convenios.
					        <br>Al registrar un nuevo convenio le solicita la siguiente información: Eps, Número del convenio, Fecha de realización del convenio y una observación.
					        <br><br>Contiene un campo para activar o inactivar el convenio. Si el convenio no está activo, no le permitirá realizar facturas.
					        <br><br>Botón Editar Portafolio: Le permite la gestión de las actividades contratadas, con su descripción (Generalmente descripción CUPS), Archivo a reportar (Archivo para el reporte en RIPS), Código con el cual se va a reportar la actividad en RIPS, Valor convenido, y el estado de la actividad. Si está activa la permite facturar, de lo contrario no.

					        <br><br><h5><b>Factura</b></h5>
					        <br>Permite la gestión de las facturas, para esto cuenta con tres pestañas así:
					        <br>Crear Nueva Factura
					        <br>Facturas Abiertas
					        <br>Facturas Cerradas/Anuladas

					        <br><br><b>Crear Nueva Factura</b>
					        <br>Permite la creación de una nueva factura, puede ser de una consulta realizada con anterioridad o de una nueva actividad. Contiene dos secciones, en la parte izquierda la sección  Información para la Factura (Encabezado de la misma) y en la parte derecha la sección Consultas sin Facturar, donde se muestra un listado de las consultas que no se han facturado al paciente. Para esto solcita la siguiente información:

					        <br>Paciente: Identificacion o nombre del paciente, al salir de este campo, la sección Consultas sin Facturar se refresca y muestra las consultas que tiene el paciente sin facturar.
					        <br>Convenio con la EPS: Debe seleccionar el convenio al cual va a facturar.
					        <br>Fecha: Debe seleccionar la fecha con la cual va a facturar.
					        <br>Periodo: Es el rango de fechas entre el cual se va a presentar la facturación (para efectos de presentar RIPS, generalmente el periodo está comprendido entre el primer dia y el último de cada mes).
					        <br><br>Si existe una consulta sin facturar, se la debe seleccionar, de lo contrario se creará una nueva factura en la cual hay que adicionarle los detalles.
					        <br><br><b>Nota: El Código ATC del catálogo debe coincidir con el codigo_cups, con el codigo de la actividad que realiza el profesional y con la actividad contratada</b>

					        <br><br><b>Facturas Abiertas</b>
					        <br>Muestra un listado de todas las facturas abiertas, a las cuales podrá adicionarles o eliminarles detalles.
					        <br><b>Botón Editar detalles de la facutra:</b> Le permite adicionar o quitar detalles de la misma, cambiar los valores de copago y descuento.
					        <br><b>Botón Editar la facutra:</b> Le permite modificar los datos del encabezado de la factura.
					        <br><b>Botón Anular la facutra:</b> Le permite anular la factura, esto se debe hacer unicamente cuando la misma se ha cerrado y contiene errores, en cuyo caso se debe crear una nueva.
					        <br><b>Botón Cerrar la facutra:</b> Cuando se cierra la factura, esta ya no se puede modificar, en este momento se le asigna el consecutivo.

					        <br><br><b>Facturas Cerradas/Anuladas</b>
					        <br>Muestra un listado de todas las facturas cerradas y anuladas, de acuerdo a los parámetros solicitados: Fecha desde, Hasta (Rango de fechas entre las cuales se desea generar el listado), Identificación: Número de identificación del paciente, que se desea realizar la consulta, EPS: EPS de la cual se desa consultar las facturas.
					        <br><b>Botón Imprimir:</b> Le permite imprimir la factura.
					        <br><b>Botón Anular:</b> Le permite anular la factura, esto se debe hacer unicamente cuando la misma se ha cerrado y contiene errores, en cuyo caso se debe crear una nueva. Cuando este botón es color gris, significa que la misma ya está anulada

					        <br><br><h5><b>Cuenta de Cobro</b></h5>
					        <br>Permite la creación y gestión de las cuentas de cobro. Inicialmente muesta el listado de cuentas de cobro realizadas.
					        <br>Al registrar una nueva cuenta de cobro, solicita la siguiente información:
					        <br>Número: Es el numero de la cuenta de cobro con el que va a realizar el documento(es un texto abierto sin validación ya que los diferentes contratantes pueden tener sus propios requerimientos)					        
					        <br>Eps, Fecha de la cuenta de cobro, Fecha inicial del periodo, Fecha final del periodo,Concepto (En el cual puede realizar aclaraciónes adicionales del cobro).
					        <br>Despues de guardarlo, se muestra en el listado anterior, con los siguientes botones:
					        <br><br><b>Botón Relacionar Facturas:</b> Le permite la adicionar o quitar facturas a la cuenta de cobro.
					        <br>Al seleccionar esta opción, le muestra dos listados, uno en la parte izquierda, donde se muestran las facturas que pertenecen a la EPS seleccionada y que no han sido relacionadas anteriormente, y el botón <b>Adicionar a la Cuenta de Cobro</b>, y el la parte derecha, muestra el listado de facturas que se van a cobrar, con el botón <b>Quitar de esta Lista</b>
					        <br><br><b>Botón Editar el Registro:</b> Permite la edición de la información de la cuenta de cobro, a excepción de la EPS.
					        <br><br><b>Botón Cerrar la Cuenta:</b> Permite cerrar la cueta de cobro. Esta opción se la debe ejecutar cuando la cuenta de cobro esté lista para ser enviada, ya que posterior a esto no se podrán realizar modificaciones.
					        <br><b>Botón Imprimir:</b> Le permite imprimir la cuenta de cobro.
					        <br><b>Botón RIPS:</b> Le permite generar los archivos planos de los RIPS. Esta opción se activa unicamente cuando la cuenta de cobro se ha cerrrado.
					        <br>Al ingresar a esta opción se encuentra con las siguientes pestañas:
					        <br>Generar Rips
					        <br>Rips de Consulta - AC
					        <br>Rips de Procedimientos - AP
					        <br>Generar Archivos Planos
					        <br>Salir
					        <br><br><b>Generar Rips: </b>Permite la generación de la informacion para los RIPS, a partir de las facturas relacionadas en la cuenta de cobro. Esta opcion se la debe ejecutar una sola vez después de cerrar la cuenta de cobro, o se la debe ejecutar nuevamente cuando por cualquier motivo se borran registros de los rips de consulta o de procedimietos.
					        <br><b>Rips de Consulta - AC: </b>Permite la gestion de los RIPS de consulta (AC). El botón <b>Editar el Registro</b> le permite modificar la información del RIPS, el boón <b>Eliminar el Registro</b> borra el registro del RIPS de consulta.
					        <br><b>Rips de Procedimientos - AP: </b>Permite la gestion de los RIPS de procedimientos (AP). El botón <b>Editar el Registro</b> le permite modificar la información del RIPS, el boón <b>Eliminar el Registro</b> borra el registro del RIPS de procedimiento.
					        <br><b>Generar Archivos Planos: </b>Permite la generación y descargue de los archivos planos con los RIPS de la cuenta de cobro, para esto muestra un botón con el nombre de cada uno de los archivos a descargar. Por razones técnicas el archivo es descargado como documento <b>.CSV</b>, por lo que hay que abrirlo con un editor de notas y guardarlo con la extención <b>.TXT</b>
					        <br><b>Salir: </b>Retorna al formulario anterior.
					        <br><br><h5><b>Furips</b></h5>
					        <br>Permite la creación y gestión del formulario FURIPS. .
					        <br><b>Notas:</b>
					        <br>Para poder crear un formulario nuevo, la factura debe estar cerrada.
					        <br>Primero de debe verificar si el conductor y el propietario existan, si no existen se los debe crear antes de crear el formulario.
					        <br>Contiene las siguientes pestañas:
					        <br>Formulario FURIPS
					        <br>Propietarios/Conductores
					        <br>Listado de Furips
					        <br><br><b>Formulario FURIPS: </b>Aqui se debe registrar la información del formulario, para esto cuenta con dos secciones, una superior con el encabezado del formulario y una inferior con diferentes pestañas que contienen información de cada seccion del formulario. Las pestañas son:
					        <br>Datos del Vehículo
					        <br>Datos de la Remisión
					        <br>Datos de la Atención
					        <br>Datos del Amparo
					        <br><b>Nota: </b>Cada seccion contiene un botón guardar.
					        <br><br><b>Propietarios/Conductores</b>
					        <br>Permite gestión de la informacion de las personas(propietarios o cunductores), para esto muestra un listado con la información de las personas registradas. Si el propietario y el conductor del vehículo es la misma persona, se lo debe crear una sola vez, igualmente si el propietario o el conductor están involucrados en dos accidentes diferentes, y ya están registrados, no es necesario ingresarlos nuevamente. En resumen cada persona es única.
					        <br><br>Esta pestaña permite realizar la búsqueda de las personas registradas, para lo cual solicita la identificación de la persona o el nombre. En el caso del nombre puede digitar el nombre completo o parte del mismo, al salir de cualquiera de los campos, se genera el listado de personas.
					        <br><b>Botón Nuevo: </b>Permite el registro de una nueva persona.
					        <br><b>Botón Editar el Registro: </b>Permite editar la información de la persona.
					        <br><br><b>Listado de FURIPS: </b>Esta pestaña permite realizar la búsqueda de los formularios FURIPS registrados, para esto solicita el número de la factura o el nombre de la víctima o la identificacion. En el caso del nombre puede digitar el nombre completo o parte del mismo, al salir de cualquiera de los campos, se genera el listado de formularios.
					        <br><b>Botón Editar Formulario FURIPS: </b>Permite editar la información del formulario FURIPS.
					        <br><b>Botón Cerrar el FURIPS: </b>Cierra el formulario. Después de cerrado, no se podrán realizar modificaciones.
					        <br><b>Botón Imprimir: </b>Imprime el formulario en un formato PDF

					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingGlosas">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
					          Glosas
					        </button>
					      </h5>
					    </div>
					    <div id="collapseSeven" class="collapse" aria-labelledby="headingGlosas" data-parent="#accordionManual">
					      <div class="card-body">
					      	Permite la gestión de glosas, conciliaciones y abonos.
					      	<br><br><h5><b>Registro de Glosas</b></h5>
					      	<br>Contiene dos pestañas:
					      	<br>Glosas Abiertas
					      	<br>Glosas Cerradas
					      	<br><br><b>Glosas Abiertas</b>
					        <br>Muesta el listado de las glosas registradas y abiertas.
					        <br><b>Botón Nuevo: </b>Le permite registrar una nueva glosa, para esto le solicita la siguiente información: Fecha de recepción de la glosa, Eps, Número de Factura: -puede digitar el numero o parte del mismo, se despliega una lista de facturas de la cual debe seleccionar la que corresponda-, valor de la glosa, motivo de la glosa, Fecha de entrega, Responsable de Responder la Glosa, Fecha de Envío de la Respuesta a la EPS, Guia con la que se Remite la Contestación.
					        <br><b>Botón Editar el Registro:</b> Permite la edición de la información de la glosa.
					        <br><b>Botón Seguimiento: </b> Permite gestionar el seguimiento y respuestas a la glosa:
					        <br>Al ingresar a esta opción, le muestra un listado con las respuestas registradas y a su vez le permite registrar nuevas respuestas, editar y anular las anteriores.
					        <br><b>Botón Cerrar la Glosa:</b> Cuando se cierra la glosa, esta ya no se puede modificar.
					        <br><br><b>Glosas Cerradas</b>
					        <br>Muesta el listado de las glosas registradas y cerradas. Para realizar la búsqueda de los registros solicita uno o varios de los siguientes parámetros: Fecha Desde, Hasta, Factura, EPS.
					        <br><b>Botón Imprimir: </b>Le permite imprimir la información de la glosa con sus respectivos seguimientos.
					        <br><br><h5><b>Conciliación</b></h5>
					      	<br>Muesta el listado de las conciliaciones registradas y abiertas.
					        <br><b>Botón Nuevo: </b>Le permite registrar una nueva conciliación, para esto le solicita la siguiente información: Eps, Número de Factura: -puede digitar el numero o parte del mismo, se despliega una lista de facturas de la cual debe seleccionar la que corresponda-, Fecha de Conciliación, Fecha de Firma de Conciliación, Valor a Conciliar, Valor a Favor de la Entidad, Valor a Favor de la EPS, Valor Ratificado, Observación.
					        <br><b>Botón Editar el Registro:</b> Permite la edición de la información de la conciliación.					        
					        <br><b>Botón Cerrar la Conciliación:</b> Cuando se cierra la conciliación, esta ya no se puede modificar.
					        <br><b>Botón Borrar el Registro:</b> Este botón borra el registro, sin posibilidad de recuperación.
					        <br><br><h5><b>Abonos</b></h5>
					      	<br>Permite el registro de abonos o pagos realizados a las facturas, para esto muesta el listado de los abonos registrados y abiertos.
					        <br><b>Botón Nuevo: </b>Le permite registrar un nuevo abono o pago, para esto le solicita la siguiente información: Eps, Número de Factura: -puede digitar el numero o parte del mismo, se despliega una lista de facturas de la cual debe seleccionar la que corresponda-, Fecha de Abono, Documento:-Opcional, puede digitar el tipo y numero del documento con el cual se registra el pago-, Valor del Abono, Días en Mora, Observación.
					        <br><b>Botón Editar el Registro:</b> Permite la edición de la información del abono.
					        <br><b>Botón Cerrar el Abono:</b> Cuando se cierra el abono, este ya no se puede modificar.
					        <br><b>Botón Borrar el Registro:</b> Este botón borra el registro, sin posibilidad de recuperación.
					        <br><b>Nota: </b>En el momento de guardar el abono, se actualiza automáticamente el saldo registrado en la conciliación.

					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingAdministracion">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
					          Administración
					        </button>
					      </h5>
					    </div>
					    <div id="collapseEight" class="collapse" aria-labelledby="headingAdministracion" data-parent="#accordionManual">
					      <div class="card-body">
					      	Permite la gestión de diferentes conceptos y parametrizaciones requeridos por la aplicación. Su actualización es de menor frecuencia.
					      	<br><br><h5><b>Eps</b></h5>
					      	<br>Permite la gestión de EPS
					      	<br><br><h5><b>CIE</b></h5>
					      	<br>(Código Internacional de Enfermedades) Permite la gestión de los diagnósticos.
					      	<br><br><h5><b>CUPS</b></h5>
					      	<br>Permite la gestión de los códigos CUPS.
					      	<br><br><h5><b>CUPS por Profesional</b></h5>
					      	<br>Permite la parametrización de los códigos CUPS a los cuales puede tener acceso el profesional tanto en el registro de la consulta como en el de procedimientos, esto con el fin del correcto registro de RIPS.
					      	<br><br><h5><b>Catálogo</b></h5>
					      	<br>Permite el registro de medicamentos, dispositivos, servicios y paquetes que ofrece la institución, con fines de parametrizar la facturación. Para esto solicita la siguiente información:
					      	<br>Código: Es el código con el que se va a registrar el item, si es un servicio se debe registrar el código CUPS (deben estar registradas las actividades anteriormente parametrizadas en la opcion <b>CUPS por Profesional</b> para que se puedan facturar automáticamente), si es un medicamento se sugiere registrar el código CUMS.
					      	<br>Nombre
					      	<br>Tipo
					      	<br>En el caso de registrar paquetes, se le debe registrar los elementos que contiene cada paquete, que a su vez deben estar registrados con anterioridad en esta misma opción.
					      	<br><br><h5><b>Conceptos</b></h5>
					      	Permite la parametrización de diferentes conceptos que se utilizan en la aplicación:
					      	<br>AMBITO: Para RIPS.
					      	<br>CAUSA EXTERNA: Para RIPS.
					      	<br>CONDICION DE LA VICTIMA: Para FURIPS.
					      	<br>ESTADO CIVIL: Para informacion de las personas (Res 4505).
					      	<br>ESTADO DE ASEGURAMIENTO: Para FURIPS.
					      	<br>ESTADO DE LAS CITAS: Para clasificar las citas.
					      	<br>ETNIA: Para informacion de los pacientes (Res 4505).
					      	<br>FINALIDAD DE LA CONSULTA: Para RIPS.
					      	<br>FINALIDAD DE PROCEDIMIENTOS: Para RIPS.
					      	<br>FORMA DE REALZACION DEL ACTO QX: Para RIPS.
					      	<br>GRUPO POBLACIONAL: Para la consulta.
					      	<br>NATURALEZA DEL EVENTO: Para FURIPS.
					      	<br>NIVEL EDUCATIVO: Para informacion de los pacientes (Res 4505).
					      	<br>ORDENES: Para la consulta (Ordenes que puede generar el profesional).
					      	<br>SEXO: Para informacion de las personas (Res 4505, Res 3374, Res 812).
					      	<br>TIPO DE AFILIADO: Para informacion de los pacientes.
					      	<br>TIPO DE DIAGNOSTICO: Para RIPS.
					      	<br>TIPO DE IDENTIFICACION: Para informacion de las personas(Res 4505, Res 3374, Res 812).
					      	<br>TIPO DE VEHICULO: Para informacion de FURIPS.
					      	<br>VIAS DE ADMINISTRACION DE MEDICAMENTOS: Para formulacion de medicamentos.
					      	<br>ZONA DE RESIDENCIA: Para informacion RIPS.
					      	<br><br><h5><b>Ocupaciones</b></h5>
					      	<br>Permite la gestión de las ocupaciones de acuerdo al CIUO(Código Internacional Uniforme de Ocupaciones) -Res 4505-.
					      	<br><br><h5><b>Usuarios del Sistema</b></h5>
					      	<br>Permite la gestión de las personas que tienen acceso a la aplicación (Usuarios del Sistema). Estas personas deben estar registradas anteriormente en <b>Admisiones / Personas</b>.
					      	<br><b>Botón Nuevo: </b>Crea a un nuevo usuario del sistema, solicita la siguiente información:
					      	<br>Persona: debe digitar la identificación o el nombre de la persona, se despliega una lista de la cual se debe seleccionar a la persona indicada.
					      	<br>Nombre de Usuario: Nombre con el cual va a ingresar a la aplicación(Ejemplo: primernombre.primerapellido).
					      	<br>Password: Palabra clave que se utiliza como contraseña de ingreso.
					      	<br>Profesion, Cargo
					      	<br>Información del Profesional de la Salud: Se debe chequear si:
					      	<br><li>Agendar: Cuando el usuario es un profesional de la salud a quien se le va a generar agenda.</li>
					      	<br><li>Tomar Signos Vitales: Cuando el usuario es un profesional de la salud y dentro de su consulta va a tomar signos vitales.</li>
					      	<br><li>Realiza Examen Físico: Cuando el usuario es un profesional de la salud y dentro de su consulta va a realizar examen físico.</li>
					      	<br><b>Botón Editar el Registro:</b> Permite la edición de la información anterior.
					      	<br><b>Botón Autorizaciones del Menú:</b> Para gestionar a que opciones de la aplicación va a tener acceso el usuario.
					      	<br><b>Botón Asignar Examen Físico a Realizar:</b> Este se habilita cuando el profesional de la salud tiene chequeada la opción <b>Realiza Examen Físico</b> y le permite asignar el examen físico que va a realizar el profesional. En la parte inferior de este, se muestra otro botón que le permite visualizar el examen físico asignado.
					      	<br><br><h5><b>Configuración</b></h5>
					      	<br>Permite la edición de la información de la entidad: Nombre, Dirección, Teléfonos, Texto para el encabezado de la factura, Tipo de identificación, Número de identificación, Código de Habilitación, Nombre del gerente.
					      	<br><br><h5><b>Examen Físico</b></h5>
					      	<br>Esta opción le permite definir los diferntes examenes físicos que se van a registrar en las historias.
					      	<br><b>Botón Nuevo: </b>Crea a un nuevo grupo para el examen físico.
							<br><b>Botón Editar Detalles: </b>Permite la gestión de los detalles del examen físico.
							<br><b>Botón Borrar el Registro:</b> Este botón borra el grupo correspondiente al examen físico, sin posibilidad de recuperación.
							<br><b>Nota: </b>Después de creados, se deben asignar a cada profesional de acuerdo a la consulta que lo reaquiera, en la opcion <b>Usuarios del Sistema / Asignar Examen Físico a Realizar</b>
							<br><br><h5><b>Conceptos de Glosas</b></h5>
					      	<br>Esta opción permite la gestión de los conceptos de glosas. Se encuentran registrados los definidos por el anexo técnico Nro 6 de la resolucion 3047 de 2008.
					      	<br><b>Botón Nuevo: </b>Crea a un nuevo concepto de glosa.
							<br><b>Botón Editar: </b>Permite la modificación de un concepto de glosa.
							<br>Adicionalmente puede activar e inactivar el concepto.
							<br><br><h5><b>Glosas por Usuario</b></h5>
					      	<br>Esta opción permite la gestión de los conceptos de glosas a los que tendrá acceso cada usuario, para su contestacón, de esta forma cada usuario puede hacer el registro de la contestación unicamente a los conceptos que le corresponda.
					      	<br><b>Botón Nuevo: </b>Asigna un nuevo concepto de glosa a un usuario.
							<br><b>Botón Editar: </b>Permite la modificación del concepto de glosa asignado a un usuario.
							<br><b>Botón Borrar el Registro:</b> Este botón borra el concepto asignado a un usuario, sin posibilidad de recuperación.

					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingInformes">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
					          Informes
					        </button>
					      </h5>
					    </div>
					    <div id="collapseNine" class="collapse" aria-labelledby="headingInformes" data-parent="#accordionManual">
					      <div class="card-body">
					      	Permite la generación de diferentes infomes, de acuerdo a la información registrada:
					      	<br>Consultas
					      	<br>Procedimientos
					      	<br>Citas
					      	<br>Facturas
					      	<br>Glosas
					      	<br>Conciliaciones
					      	<br>Abonos
					      	<br><br>Todos los informes solicitan unos parámetros(filtros) para la generación de los mismos, los parámetros de fechas, son el rango entre los cuales desea generar el informe.
					      	<br><br>El informe de <b>Consultas</b>, <b>Procedimientos</b>, <b>Citas</b> y <b>Facturas</b>, muestra los campos que se van a mostrar en el informe y le permite seleccionar otros adicionales.

					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" id="headingHerramientas">
					      <h5 class="mb-0">
					        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
					          Herramientas
					        </button>
					      </h5>
					    </div>
					    <div id="collapseTen" class="collapse" aria-labelledby="headingHerramientas" data-parent="#accordionManual">
					      <div class="card-body">
					      	Esta opción está disponible unicamente para el administrador del sistema, donde le permite generar las consultas que requiere el aplicativo para su funcionamento.

					      </div>
					    </div>
					  </div>

					</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
