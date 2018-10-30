<?php
function database_connect($HOST, $USER, $PASS, $DB, $PORT)
{
	$conn = mysqli_connect($HOST, $USER, $PASS, $DB);
	if (mysqli_connect_errno())
	{
	    die (sprintf("Connect failed: %s\n", mysqli_connect_error()));
	    exit();
	}
	return $conn;
}
function database_close($conn)
{
	mysqli_close ($conn);
}
function database_query($strsql, $conn)
{
	$rs = mysqli_query($conn, $strsql);
	return $rs;
}
function database_num_rows($rs)
{
	return @mysqli_num_rows($rs);
}
function database_fetch_array($rs)
{
	return mysqli_fetch_array($rs);
}
function database_fetch_row($rs)
{
	return mysqli_fetch_row($rs);
}
function database_free_result($rs)
{
	@mysqli_free_result($rs);
}
function database_data_seek($rs, $offset)
{
	@mysqli_data_seek($rs, $offset);
}
function database_error($conn)
{
	return mysqli_error($conn);
}
function database_insert_id($conn)
{
	return @mysqli_insert_id($conn);
}
function database_affected_rows($conn)
{
	return @mysqli_affected_rows($conn);
}
?>
<?php
define("HOST", "localhost");
define("PORT", 3306);
define("USER", "root");
define("PASS", "");
define("DB", "jjgg");
?>
