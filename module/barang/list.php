<div id="frame-tambah">
   <a href="<?= BASE_URL.'index.php?page=my_profile&module=barang&action=form';?>" class="tombol-action">
      + Tambah Barang
   </a>
</div>

<?php
    $pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
    $data_per_halaman = 3;
    $mulai_dari = ($pagination-1)*$data_per_halaman;
   // jika sudah ada data maka ini bakal ditampilkan
   $queryBarang = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id LIMIT $mulai_dari, $data_per_halaman");

   if(mysqli_num_rows($queryBarang) == TRUE ){
      echo "
         <table class='table-list'>
            <tr class='baris-title'>
               <th class='no'>No</th>
               <th class='kiri'>Barang</th>
               <th class='kiri'>Kategori</th>
               <th class='kiri'>Harga</th>
               <th class='tengah'>Status</th>
               <th class='tengah'>Action</th>
            </tr>";

         $no=1 + $mulai_dari;
         while($row= mysqli_fetch_assoc($queryBarang)){
            echo
            "<tr>
               <td class='no'>$no</td>
               <td class='kiri'>$row[nama_barang]</td>
               <td class='kiri'>$row[kategori]</td>
               <td class='kiri'>".rupiah($row['harga'])."</td>
               <td class='tengah'>$row[status]</td>
               <td class='tengah'>
               <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&id=$row[barang_id]'>Edit</a>
               </td>
            </tr>";
            $no++;
         }
         echo"</table>";
         $queryHitungBarang= mysqli_query($koneksi,"SELECT * FROM barang");
         pagination($queryHitungBarang,$data_per_halaman,$pagination,"index.php?page=my_profile&module=barang&action=list");
   }else{
      echo"TAbel KOSONG";
   }


