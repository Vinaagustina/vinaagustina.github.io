<?php 
error_reporting(0);
$id = $_GET['id'];
$queryRowProduct = $connect->query("SELECT barang.id, barang.kdbrg, barang.nmbrg, barang.harga, barang.stock, category.category_id, category.category_name, satuan.id_satuan, satuan.nmsatuan
                             FROM barang 
                             JOIN category ON barang.category_id = category.category_id
                             JOIN satuan ON barang.id_satuan = satuan.id_satuan 
                             where id = '".$id."'");
$rowProduct = mysqli_fetch_array($queryRowProduct);
    /*
    if (isset($_POST['ubah']) {  
    
      if (!empty($_FILES) && $_FILES['product_images']['size'] >0 && $_FILES['user_foto']['error'] == 0){  
            //$random = substr(number_format(time() * rand(),0,'',''),0,10);
            $images = $_FILES['product_images']['name'];
            $move = move_uploaded_file($_FILES['product_images']['tmp_name'],'assets/images/product/'.$images);  

            if ($move) {  
              $queryUpdate  = mysql_query("UPDATE product SET 
                                    product_name      = '".$_POST['product_name']."',
                                    product_price     = '".str_replace(".", "", $_POST['product_price'])."',
                                    product_desc      = '".$_POST['product_desc']."',
                                    product_images    = '".$images."',
                                    product_stock     = '".str_replace(".", "", $_POST['product_stock'])."',
                                    category_id       = '".$_POST['product_category']."'
                                    WHERE product_id     = '".$id."'
                                     ");
                $file = "assets/images/product/".$rowProduct['product_images'];
                unlink($file);
                                             
            }

      }else{  
        */
       

          if(isset($_POST['ubah'])){  
                $queryUpdate=$connect->query("UPDATE barang SET
                                                    kdbrg = '".$_POST['kode_barang']."',
                                                    nmbrg = '".$_POST['product_name']."',
                                                    harga = '".str_replace(".", "", $_POST['product_price'])."',
                                                    stock = '".str_replace(".", "", $_POST['product_stock'])."',
                                                    category_id       = '".$_POST['product_category']."' ,
                                                    id_satuan = '".$_POST['satuan']."'  
                                                    WHERE id    = '".$id."' "); 
         if($queryUpdate === TRUE){
         
echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=master/barang/list' </script>";exit;
           }else{
            echo "ERROR UBAH DATA =" .$sql->connect_error;
           }
            }                        
       
     // if ($queryUpdate) {
       //  echo "<script> alert('Data Berhasil Diubah'); location.href='index.php?hal=master/barang/list' </script>";exit;
      //}
    //}
 ?>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           EDIT DATA BARANG
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" enctype="multipart/form-data"  action="">
                                    <div class="form-group ">
                                        <label for="kode_barang" class="control-label col-lg-2" style="text-align: left;">Kode Barang</label>
                                        <div class="col-lg-5">
                                            <input class=" form-control" id="kode_barang" name="kode_barang" minlength="2" type="text" value="<?php echo $rowProduct['kdbrg']  ?>" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2" style="text-align: left;">Nama</label>
                                        <div class="col-lg-5">
                                            <input class=" form-control" id="cname" name="product_name" minlength="2" type="text" value="<?php echo $rowProduct['nmbrg']  ?>" required/>
                                        </div>
                                    </div>

<!--
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-2" style="text-align: left;">Foto</label>
                                        <div class="col-lg-5">
                                            <img src="assets/images/product/<?php echo $rowProduct['product_images']; ?>" width="50%">
                                            <input class=" form-control" id="cname" name="product_images" minlength="2" type="file"/>
                                        </div>
                                    </div>
-->
                                     <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2" style="text-align: left;">Kategori</label>
                                        <div class="col-lg-3">
                                            <select name="product_category" class="form-control " required>
                                                <option value="<?=$rowProduct['category_id']?>"><?=$rowProduct['category_name']?></option>
                                            <?php 
                                              $no = 0;
                                              $queryCategory = $connect->query("SELECT * FROM category WHERE category_status = 'Y' ORDER BY  category_id DESC");
                                              while ($rowCategory  = mysqli_fetch_array($queryCategory)) {
                                                ?>
                                                 <option value="<?php echo $rowCategory['category_id']; ?>"><?php echo $rowCategory['category_name'] ?></option>
                                            <?php 
                                            } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2" style="text-align: left;">Harga </label>
                                        <div class="col-lg-5">
                                            <input class="form-control " id="tanpa-rupiah" type="text" name="product_price" value="<?php echo number_format($rowProduct['harga'], 0, ',', '.');  ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="curl" class="control-label col-lg-2" style="text-align: left;">Stock</label>
                                        <div class="col-lg-2">
                                            <input class="form-control " id="tanpa-rupiah" type="text" name="product_stock" value="<?php echo $rowProduct['stock']; ?>" />
                                        </div>
                                    </div>
                                    <!--
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-2" style="text-align: left;">Deskripsi</label>
                                        <div class="col-lg-5">
                                            <textarea class="form-control " id="ccomment" name="product_desc" required><?php echo $rowProduct['product_desc']; ?></textarea>
                                        </div>
                                    </div>
                                -->

                                   
                                     <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-2" style="text-align: left;">Satuan</label>
                                        <div class="col-lg-3">
                                            <select name="satuan" class="form-control " >
                                                <option value="<?=$rowProduct['id_satuan']?>"><?=$rowProduct['nmsatuan']?></option>
                                            <?php 
                                              $no = 0;
                                              $queryCategory = $connect->query("SELECT * FROM satuan ORDER BY id_satuan DESC");
                                              while ($rowCategory  = mysqli_fetch_array($queryCategory)) {
                                                
                                            ?>
                                                <option value="<?php echo $rowCategory['id_satuan']; ?>"><?php echo $rowCategory['nmsatuan'] ?></option>
                                            <?php

                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-5">
                                            <button class="btn btn-primary" type="submit" name="ubah">UPDATE</button>
                                            <a href="?hal=master/barang/list">
                                            <button class="btn btn-default" type="button">Cancel</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

