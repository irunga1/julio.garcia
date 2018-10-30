<?php 
session_start();
ob_start();
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php include ("db.php") ?>
<?php include ("header.php") ?>
<div id="loading" style="display:none"><img src="assets/images/loading.gif"></div>
<?php $conn = database_connect(HOST, USER, PASS, DB, PORT); ?>
<h1>Notas de Examenes</h1>
<div class="panel panel-info">
  <div class="panel-heading">
	<h3 class="panel-title">
	<span class="glyphicon glyphicon-pencil"></span> Ingreso de notas
	</h3>
  </div>
<table class="table table-striped table-hover">
	<thead>
	<tr>
		<th style="width:250px;">Examen</th>
		<th>Alumno</th>
		<th style="width:150px;">Nota</th>
		<th style="width:100px;">&nbsp;</th>
	</tr>
	</thead>
	<tbody>
<?php
    $examen_id = trim(@$_GET["examen_id"]);
    $custom_filter = sprintf(" AND examen.examen_id = %d ", $examen_id);

    $sSqlWrk = sprintf("SELECT nota.nota_id, 
							examen.descripcion,
							alumno.nom_alumno,
							nota.puntaje
                        FROM examen
							INNER JOIN nota ON (nota.examen_id = examen.examen_id)
							INNER JOIN asignacion ON (asignacion.asignacion_id = nota.asignacion_id)
							INNER JOIN alumno ON (alumno.carnet = asignacion.carnet)
                        WHERE 1=1
                        %s
                  ", $custom_filter);
    $rswrk = database_query($sSqlWrk,$conn)
        or die("Fallo al ejecutarse la linea " . __LINE__ . ": " . database_error($conn) . '<br>SQL:' . $sSqlWrk);
    if (database_num_rows($rswrk) > 0)
    {
        while ($rowwrk = @database_fetch_array($rswrk))
        {
          $nota_id = $rowwrk["nota_id"];
          $descripcion = $rowwrk["descripcion"];
          $nom_alumno = $rowwrk["nom_alumno"];
		  $puntaje = $rowwrk["puntaje"];
?>
	<tr>
		<td><?php echo $descripcion; ?></td>
		<td><?php echo $nom_alumno; ?></td>
		<td>
		<input id="n<?php echo $nota_id; ?>" class="form-control" onblur="GuardarNota(<?php echo $nota_id; ?>)" value="<?php echo $puntaje; ?>" />
		</td>
		<td><div id="t<?php echo $nota_id; ?>"></div></td>
	</tr>
<?php
        }
    } else {
?>
	<tr>
		<td colspan=3>sin datos</td>
	</tr>
<?php
    }
    @database_free_result($rswrk);
?>
	</tbody>
	</table>
</div>
<?php database_close($conn); ?>
<?php include ("footer.php") ?>
<script>
    function GuardarNota(nota_id)
    {
      $("#t" + nota_id).html($("#loading").html());
      jQuery.post(
        "ajax_json_requests.php",
        {
            action_name: "GUARDAR_NOTA",
			nota_id: nota_id,
			puntaje: $("#n" + nota_id).val()
        },
        function (response)
        {
	        $("#t" + response.nota_id).html("");
			$("#n" + response.nota_id).val(response.puntaje);
        }, 'json');
    }
</script>