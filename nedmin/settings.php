<?php require_once 'header.php';
require_once 'sidebar.php';
$db=new curd();
session_start();
?>
<!-- Content Wrapper. Contains page content -->

<!-- /.content-wrapper -->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Borderless table start -->
            <div class="row" id="">
                <?php
                if(isset($_GET["settingsyönetici"])) { ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ayarlara Ekle </h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['settings_insert'])){
                                $sonuc=$db->insert("settings",$_POST,[
                                    "buton_key"=>"settings_insert",
                                    "pass"=>"settings_pass",
                                    "dir"=>"settings",
                                    "file_name"=>"settings_file"
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

                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  }  else if(isset($_GET["settingsUpdate"])) { ?>
                <div class= "col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ayarlar Düzenle</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['settings_update'])){
                                $sonuc=$db->update("settings",$_POST,[
                                    "buton_key"=>"settings_update",
                                    "columns"=>"settings_id",
                                    "dir"=>"settings",
                                    "file_name"=>"settings_value",
                                    "file_delete"=>"delete_file"
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
                            $sql=$db->wread('settings','settings_id',$_GET["settings_id"]);
                            $row=$sql->fetch(PDO::FETCH_ASSOC); ?>


                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label> Açıklama</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <input type="text" name="settings_description" readonly=""  value="<?php echo $row['settings_description'] ;?>" required="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <?php if($row['settings_type']==="file"){ ?>

                                    <div class="form-group">
                                        <label> Resim Seç</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="file" name="settings_value"  class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label> İçerik</label>
                                    <div class="row">
                                        <div class="col-xs-12">

                                            <?php  if ($row['settings_type']==="text"){ ?>
                                                <input type="text" name="settings_value"
                                                       value="<?php echo $row['settings_value'] ;?>"  class="form-control">
                                            <?php  } else if ($row['settings_type']==="textarea"){ ?>
                                                <textarea name="settings_value" class="form-control"><?php echo $row['settings_value'] ; ?></textarea>
                                            <?php  } else if ($row['settings_type']==="ckeditor"){ ?>
                                                <textarea id="editor1" name="settings_value" class="form-control"><?php echo $row['settings_value'] ; ?></textarea>
                                            <?php  } else if ($row['settings_type']==="file"){ ?>
                                                <a target="_blank" href="<?php echo $row['settings_value'] ; ?>"><img style="height: 100px" src="dimg/settings/<?php echo $row['settings_value'];?>"></a>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    CKEDITOR.replace( 'editor1' );
                                </script>
                                <input type="hidden" name="settings_id" value=" <?php echo $row['settings_id']; ?> ">
                                <input type="hidden" name="delete_file" value=" <?php echo $row['settings_value']; ?> ">
                                <div align="end" class="box-footer">
                                    <button type="submit" class="btn btn-primary" name="settings_update">Düzenle</button>
                                </div>
                            </form>
                             </div>
                    </div>
                </div>
            <?php  } ?>
            <div class="col-12">
                <div class="card">
                    <div class= "card-header">
                        <h4 class="card-title">Ayarlar</h4>
                        <div align="end" >
                            <a href="?settingsyönetici=true" > <button class=" btn btn-primary"> Yeni Ekle </button> </a>
                            <br><br>
                        </div>

                        <?php
                        if(isset($_GET["settingsDelete"])) {
                            $sonuc=$db->delete("settings","settings_id",$_GET["settings_id"],$_GET["file_delete"]);

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
                    <div class="table-responsive">
                        <table id="example1" class=" table table-borderles">
                            <thead>
                            <tr>
                                <th>Adı</th>
                                <th>İçerik</th>
                                <th>Key</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = $db->read("settings");
                            $sayac=1;
                            while ($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                ?>
                                <tr>
                                    <td> <?php echo $row['settings_description'] ; ?> </td>
                                    <td>
                                        <?php if ($row['settings_type']=='file'){?>
                                            <img width="100" src="dimg/settings/<?php echo $row['settings_value'] ?>"> <?php
                                        }
                                        else{
                                            echo $row['settings_value'];
                                        }
                                        ?>

                                    </td>
                                    <td> <?php echo $row['settings_key'] ; ?> </td>
                                    <td style="align=center; width: 5px"> <a href="?settingsUpdate=True&settings_id=<?php echo $row['settings_id']?>">
                                            <i class="fa fa-pencil-square"></i></a>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                <a>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </a>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="?settingsUpdate=True&settings_id=<?php echo $row['settings_id']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                    <span>Edit</span></a>
                                            </div>
                                        </div>


                                    </td>

                                </tr>
                            <?php } ?>

                            </tbody>
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
