<?php require_once 'header.php';
require_once 'sidebar.php';
$db=new curd();
session_start();
?>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Borderless table start -->
                <div class="row" id="">
                    <?php
                    if(isset($_GET["slidersyönetici"])) { ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Slider Ekle </h4>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['sliders_insert'])){
                                    $sonuc=$db->insert("sliders",$_POST,[
                                        "buton_key"=>"sliders_insert",
                                        "dir"=>"sliders",
                                        "file_name"=>"sliders_file"
                                    ]);
                                    if ($sonuc['status']){ ?>
                                        <div class="alert alert-success ">
                                            kayıt başarılı
                                        </div>
                                    <?php  } else if ($sonuc['eror']){ ?>
                                        <div class="alert alert-danger">
                                            <?php print_r($sonuc['eror'])?>
                                        </div>
                                    <?php }
                                }?>
                                <div class="container" style="width:70%; height: 90%; margin-left: auto;margin-right: auto; margin: auto; border-radius: 15px; background-color:#fcfcfc">
                                    <form method="post" enctype="multipart/form-data" style="width: 70%; height: 70%; margin-left: auto;margin-right: auto; padding: 3%">
                                        <div class="form-group" style=" width: 70%">
                                            <label> Fotoğraf Seç</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="file" name="sliders_file" required="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style=" width: 70%">
                                            <label> Sliders Title</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" name="sliders_title" required="" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div align="end" class="box-footer">
                                            <button type="submit" class="btn btn-primary" name="sliders_insert">Ekle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  }  else if(isset($_GET["slidersUpdate"])) { ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Slider Düzenle</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['sliders_update'])){
                                    $sonuc=$db->update("sliders",$_POST,[
                                        "buton_key"=>"sliders_update",
                                        "columns"=>"sliders_id",
                                        "dir"=>"sliders",
                                        "file_name"=>"sliders_file",
                                        "file_delete"=>"delete_file",
                                    ]);

                                    if ($sonuc['status']){ ?>
                                        <div class="alert alert-success ">
                                            kayıt başarılı
                                        </div>
                                    <?php  } else if ($sonuc['eror']){ ?>
                                        <div class="alert alert-danger">
                                            <?php print_r($sonuc['eror'])?>
                                        </div>
                                    <?php }
                                }
                                $sql=$db->wread('sliders','sliders_id',$_GET["sliders_id"]);
                                $row=$sql->fetch(PDO::FETCH_ASSOC); ?>



                                <div class="container" style="width:70%; height: 90%; margin-left: auto;margin-right: auto; margin: auto; border-radius: 15px; background-color:#fcfcfc">

                                    <form method="post" enctype="multipart/form-data"  style="width: 70%; height: 70%; margin-left: auto;margin-right: auto; padding: 3%">

                                        <div class="form-group" style=" width: 70%">
                                            <label> Mevcut Fotoğraf </label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <img height="100px" src="dimg/sliders/<?php echo $row['sliders_file'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style=" width: 70%">
                                            <label> Fotoğraf Seç</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="file" name="sliders_file" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style=" width: 70%">
                                            <label> Sliders Title</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" name="sliders_title"  value="<?php echo $row['sliders_title'] ;?>" required="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div align="end" class="box-footer">
                                            <input type="hidden" name="sliders_id" value=" <?php echo $row['sliders_id']; ?> ">
                                            <input type="hidden" name="delete_file" value=" <?php echo $row['sliders_file']; ?> ">
                                            <button type="submit" class="btn btn-primary" name="sliders_update">Düzenle</button>
                                        </div>
                                    </form>
                                </div> </div>
                        </div>
                    </div>
                <?php  } ?>
                <script>
                    CKEDITOR.replace( 'editor1' );
                </script>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Slider Listele</h4>
                            <div align="end">
                                <a href="?slidersyönetici=true"> <button class=" btn btn-primary">Yeni Ekle</button></a>
                                <br><br>
                            </div>

                            <?php
                            if(isset($_GET["slidersDelete"])) {
                                $sonuc=$db->delete("sliders","sliders_id",$_GET["sliders_id"],$_GET["file_delete"]);

                                if ($sonuc['status']){ ?>
                                    <div class="alert alert-success ">
                                        Silme Başarılı
                                    </div>
                                <?php  } else { ?>
                                    <div class="alert alert-danger">
                                        Silme Başarısız ! <?php echo $sonuc['eror']?>
                                    </div>
                                <?php }
                            }  ?>

                        </div>
                        <div class="card-body">
                            <p class="card-text">
                            </p>
                        </div>
                        <div class= "table-responsive">

                            <table id="example1" class=" table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Slider</th>
                                    <th>Slider Title</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = $db->read("sliders");
                                $sayac=1;
                                while ($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                    ?>
                                    <tr>
                                        <td> <?php  echo $sayac++ ?> </td>
                                        <td> <img style="width:100px" src="dimg/sliders/<?php echo $row['sliders_file'] ; ?>"> </td>
                                        <td> <?php echo $row['sliders_title'] ; ?> </td>

                                        <td align="center" width="5">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <a>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </a>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="?slidersUpdate=True&sliders_id=<?php echo $row['sliders_id']?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a class="dropdown-item" href="?slidersDelete=True&sliders_id=<?php echo $row['sliders_id']?>&file_delete=<?php echo $row['sliders_file'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borderless table end -->
        </div>
    </div>

    <!-- Main Footer -->
<?php require_once 'footer.php'; ?>