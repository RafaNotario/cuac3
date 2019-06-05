<?php
include('conexion.php');

$link = conectarse();

$query = "select * from menu where nivel=0 and id_padre=0";
$rs = mysql_query($query,$link);
while($row = mysql_fetch_array($rs))
{
?>
 <li><a><i class="<?php echo $row['class'];?>"></i> <?php echo $row['nombre'];?> <span class="fa fa-chevron-down"></span></a>
	  <ul class="nav child_menu" style="display: none">
<?php 
	$submenu = "select * from menu where id_padre='".$row['id_menu']."' and nivel=0"; 
	$rs_s = mysql_query($submenu, $link);
	while($row_s = mysql_fetch_array($rs_s))
	{
?>
         <li><a href="<?php echo $row_s['liga'];?>"><?php echo $row_s['nombre']?></a></li>
<?php
	}
?>
      </ul>
 </li>

<?php } ?>