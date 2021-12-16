<html>
	<head>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #000000;
			  text-align: center;
			  height: 20px;
			  margin: 8px;
			}

		</style>
	</head>
	<body>
		<div style="font-size:64px; color:'#dddddd'"><i>RAPORT SUZURAN HIGH SCHOOL</i></div>
		<p>
		<i>SUZURAN HIGH SCHOOL</i><br>
		Jakarta, Indonesia
		</p>
		<hr>
		<hr>
		<p></p>
		<p>
			Nama Siswa : <?=   $dataRaport['nama_lengkap'] ?><br>
			NIS        : <?=   $dataRaport['nis'] ?><br>
			Kelas : 	 <?=   $dataRaport['nama_kelas'] ?><br>
			Tahun Ajaran : <?=   $dataRaport['tahun_ajaran'] ?><br> 
		</p>
		<table cellpadding="6" >
			<thead>
			<tr>
				<th><strong>Nomer</strong></th> 
				<th><strong>Nama Mata Pelajaran</strong></th> 
				<th><strong>Rata Rata</strong></th>		
			</tr>
			</thead>
			<tbody>
			
                <?php $i = 1; ?>
                <?php  foreach ($raportDetail as $k) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $k['nama_mapel']; ?></td>
                        <td><?= $k['rata_rata']; ?></td>
                    </tr>
                <?php endforeach ?>
			
			</tbody>
		</table>
	</body>
</html>