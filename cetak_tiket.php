<?php
		session_start();
		if(empty($_SESSION['login'])){ header("location:login.php"); }
?>
<?php include "header.php"; ?>
<?php if(empty($_GET['id'])){ header('location:index.php'); } ?>
	<?php
	$tiket = mysqli_query($bd, "select * from tiket where id_tiket='$_GET[id]'")or die(mysqli_error());
	$tiket = mysqli_fetch_array($tiket);
	$jadwal = mysqli_query($bd, "select * from jadwal where id_jadwal='$tiket[id_jadwal]'")or die(mysqli_error());
	$jadwal = mysqli_fetch_array($jadwal);
	$film = mysqli_query($bd, "select * from film where id_film='$jadwal[id_film]'")or die(mysqli_error());
	$film = mysqli_fetch_array($film);
	?>
	 
    <div class="container" style="max-width:400px;"><?php 
$s = mysqli_fetch_array(mysqli_query($bd, "select * from user where id='$_SESSION[login]'"));
?>
    <h4 class="text-center">Login sebagai : <?= $s['nama'] ?> [<a href="logout.php">Logout</a>]</h4>
	<div class="panel panel-default">
	  <div class="panel-heading text-right"><b>Tiket ID: #<?php echo $_GET['id']; ?></b></div>
	  <div class="panel-body">
	  <h4><u>STUDIO:<?= $jadwal['id_studio'] ?></u></h4>
	   
		<table class="table table-borderless"> 
			 
			<tbody> 
			 
				<tr> 
					<td><?= $film['judul_film'] ?></td>  
					<td>:</td>  
					<td><?= $jadwal['id_jam_tayang'] ?></td>  
				</tr>   
				<tr> 
					<td>Jumlah Tiket</td>  
					<td>:</td>  
					<td><?= $tiket['jml_kursi'] ?></td>  
				</tr>   
				<tr> 
					<td>Jam Tayang</td>  
					<td>:</td>  
					<td><?= $tiket['tanggal'] ?></td>  
				</tr>    
				<tr> 
					 
					<td colspan="3" class="text-center">
					<a href="index.php" class="btn btn-warning">&laquo; BACK</a> 
					</td>  
					 
				</tr>				
			</tbody> 
		</table> 
	  </div>
	</div> 
    </div> 
	
	<?php include "footer.php"; ?>