<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Aplikasi Pemesanan Tiket Bioskop</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Tayo Travel, Idola">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <!-- //fonts -->

<style type="text/css">
    
  body{
    font-family: arial;
    font-size: 14px;
    background-color: #70b77e;
  }
  #utama{
    width: 300px;
    margin: 0 auto;
    margin-top: 12%;
  }
  #judul{
    padding: 15px;
    text-align: center;
    color: #fff;
    font-size: 20px;
    background-color: #129490;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    border-bottom: 3px solid #FFF8DC;

  }
  #inputan {
    background-color: #4d7ea8;
    padding: 20px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
  }
  input {
    padding: 20px;
    border:0;

  }
  .tb{
  width: 220px;

  }
  .btn{
    background-color: #129490;
    border-radius: 10px;
    color: #fff;
    width: 130px;
  }
  .btn:hover{
    background-color: #5F9EAD;
    cursor: pointer; 
  }
  </style>

</head>

<body onload="onLoaderFunc()">
    <h1>Aplikasi Pemesanan Tiket Bioskop</h1>
    <div class="container">

        <div class="sel-reg">
            <!-- input fields -->

            <div class="inputForm">
                <h2>Isikan data dan lakukan pilih kursi</h2>
                <div class="mr_movmain">
                    <div class="movits-left">
                            <label> Pilih Film
                                <span>*</span>
                            </label>
                            <select name="judul_film" id="judulfilm" style="width: 191px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;" required/>
						<?php
						include('db.php');
						$result = mysqli_query($bd, "SELECT * FROM film");
						while($row = mysqli_fetch_array($result))
							{
                                echo '<option value="'.$row['judul_film'].'">';
								echo $row['judul_film'];
								echo '</option>';
							}
						?>
						</select>
                            
                    </div>

                    
                </div>

                <div class="mr_movmain">
                    <div class="movits-right">
                        <label>
                            Tanggal 
                            <span>*</span>
                        </label>
                        <input name="tanggal" type="date" id="TanggalHari" required/>
						
                    
                    </div>
                </div>

                <div class="mr_movmain">
                    <div class="movits-left">
                        <label> Studio
                            <span>*</span>
                        </label>
                        <select name="studio" id="namastudio">
						<option value="Studio 1">Studio 1</option>
						<option value="Studio 2">Studio 2</option>
						<option value="Studio 3">Studio 3</option>
						<option value="Studio 4">Studio 4</option>
						</select>
                    </div>
					<div class="movits-left">
					<label> Jam Tayang
                            <span>*</span>
                        </label>
						 <select name="jam_tayang" id="jamtayang">
						<option value="10.00 - 12.00">10.00 - 12.00</option>
						<option value="13.00 - 14.00">13.00 - 14.00</option>
						<option value="19.00 - 20.00">19.00 - 20.00</option>
						</select>
						</div>
                    <div class="movits-right">
                        <label> Jumlah Tiket Yang Dipesan
                            <span>*</span>
                        </label>
                        <input name="jml_kursi" type="number" id="Numseats" required min="1">
                    </div>
                </div>
                <button onclick="takeData()">Pesan Tiket</button>
            </div>
            <!-- //input fields -->
            <!-- seat availabilty list -->
			
			<label> Jumlah Kursi Tersedia
                            <span>*</span>
                        </label>
            <ul class="seat_sel">
                <li class="smallBox greenBox">Kursi yang Dipilih</li>

                <li class="smallBox redBox">Kursi yang Telah Dipesan</li>

                <li class="smallBox emptyBox">Kursi Tersedia</li>
            </ul>
            <!-- seat availabilty list -->
            <!-- seat layout -->
            
            <div class="seatStructure txt-center" style="overflow-x:auto;">
                
                <table id="seatsBlock">
                    <p id="notification"></p>
                    <tr>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td></td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                    </tr>

                    <?php
                        for ($i='A';$i<='E'; $i++)
                        {
                        
                            if ($i=='C'){
                                echo "<td class='seatVGap'></td>"; } ?>
                            
                            <tr>
                                <td><?php echo $i; ?></td>
                            
                            <?php
                            for($j=1; $j<=6; $j++)
                            { ?>

                                <td>
                                    <input name="pilihKursi[]" type="checkbox" class="seats" value="<?php echo $i.$j; ?>"/>
                                </td>
                                
                                <?php 
                                if ($j%3==0){
                                    echo "<td class='seatGap'></td>";
                                }
                                ?>
                                
                                <?php } 
                                } ?>

                    

                    
                </table>

                <br>
                <button name="submit" value="Submit" onclick="updateTextArea()">Konfirmasi</button>
            </div>
            <!-- //seat layout -->
            <!-- details after booking displayed here -->
            <form method="post" action="cetak_tiket.php"> 
            <div class="displayerBoxes txt-center" style="overflow-x:auto;">
                <table class="Displaytable sel-table" width="100%">
                    <tr>
                        <th>Tanggal</th>
                        <th>Studio</th>
                        <th>Nama FiIm</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea id="tanggalDisplay" name="tanggalDisplay"></textarea>
                        </td>
                        <td>
                            <textarea id="ruteDisplay" name="ruteDisplay"></textarea>
                        </td>
                        <td>
                            <textarea id="nameDisplay" name="nameDisplay"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Tiket</th>
                        <th>Jam Tayang</th>
                        <th>Kursi</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea id="NumberDisplay" name="NumberDisplay"></textarea>
                        </td>
                        <td>
                            <textarea id="jam_tayang_display" name="jam_tayang_display"></textarea>
                        </td>
                        <td>
                            <textarea id="seatsDisplay" name="seatsDisplay"></textarea>
                        </td>
                    </tr>
                </table>
                <button type="submit">Cetak</button>
            <!-- <input type="submit" value="Print"> -->
            </form>
            </div>
            <!-- //details after booking displayed here -->
        </div>
                        
    </div>
                        <!-- </form> -->
    <div class="copy-mss">
        <p>© PT CINEMA INDONESIA.</p>
    </div>
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- script for seat selection -->
    <script>
        /* ******************************************** */
        /* Koding di sini */
        /* ******************************************** */
        function onLoaderFunc() {
            $(".seatStructure *").prop("disabled", true);
        }

        function takeData() {
            if (($("#judulfilm").val().length == 0) || ($("#Numseats").val().length == 0)) {
                alert("Silahkan Masukkan Tanggal Pemesanan");
            } 
            else if  (($("#Numseats").val() > 20)){
                alert("Jumlah pemesanan kursi lebih dari kuota yang tersisa");
            }
            else {
                $(".inputForm *").prop("disabled", true);
                $(".seatStructure *").prop("disabled", false);
                document.getElementById("notification").innerHTML =
                    "<b style='margin-bottom:0px;background:#ff9800;letter-spacing:1px;'>Pilih Kursi Dapat Dilakukan!</b>";
            }
        }


        function updateTextArea() {
            if ($("input:checked").length == ($("#Numseats").val())) {
                $(".seatStructure *").prop("disabled", true);

                var allTanggalVals = [];
                var allNameVals = [];
                var allNumberVals = [];
                var allJamsVals = [];
                var allSeatsVals = [];
                var date = new Date($('#TanggalHari').val());
                    day = date.getDate();
                    month = date.getMonth() + 1;
                    year = date.getFullYear();
 
                $('#namastudio').click(function() {
                    var value = $("#select_option option:selected").val();
                    //To display the selected value we used <p id="result"> tag in HTML file
                    $('#result').append(value);
                });
                var allRuteVals = $("#namastudio option:selected").val();
                allNameVals.push($("#judulfilm").val());
                allNumberVals.push($("#Numseats").val());
                allJamsVals.push($("#jamtayang").val());
                 $('#seatsBlock :checked').each(function () {
                    allSeatsVals.push($(this).val());
                });

                //Menampilkan data
                $('#tanggalDisplay').val([day, month, year].join('-'));
                $('#ruteDisplay').val(allRuteVals);
                $('#nameDisplay').val(allNameVals);
                $('#NumberDisplay').val(allNumberVals);
                $('#jam_tayang_display').val(allJamsVals);
                $('#seatsDisplay').val(allSeatsVals);
                
            } else {
                alert("Please select " + ($("#Numseats").val()) + " seats");
            }
        }


        function myFunction() {
            alert($("input:checked").length);
        }

        $(":checkbox").click(function () {
            if ($("input:checked").length == ($("#Numseats").val())) {
                $(":checkbox").prop('disabled', true);
                $(':checked').prop('disabled', false);
            } else {
                $(":checkbox").prop('disabled', false);
            }
        });
    </script>
    <!-- //script for seat selection -->

</body>

</html>