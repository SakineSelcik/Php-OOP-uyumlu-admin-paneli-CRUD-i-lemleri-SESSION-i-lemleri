<?php require_once 'header.php';
require_once 'sidebar.php';
$db=new curd();
session_start();
?><div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Borderless table start -->
            <div class="row" id="">
                <?php  if(isset($_GET["adminsyönetici"])) { ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Yönetici Ekle </h4>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['admins_insert'])){
                                    $sonuc=$db->insert("admins",$_POST,[
                                        "buton_key"=>"admins_insert",
                                        "pass"=>"admins_pass",
                                        "dir"=>"admins",
                                        "file_name"=>"admins_file"
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
                                    <div class="form-group">
                                        <label> Fotoğraf Seç</label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="file" name="admins_file" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"style=" padding-bottom: 2%;">
                                        <label> </label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="text" name="admins_namesurname" required="" class="form-control" placeholder="Ad Soyad">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" padding-bottom: 2%;">
                                        <label></label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="text" name="admins_username" required="" class="form-control" placeholder=" Kullanıcı Adı">
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group" style=" padding-bottom: 2%;">
                                            <label></label>
                                            <div class="row">
                                                <div class="col col-xxl-12">
                                                    <input type="password" name="admins_pass" required="" class="form-control" placeholder="Kullanıcı Şifre">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style=" padding-bottom: 2%;">
                                            <label>Kullanıcı Durumu</label>
                                            <div class="row">
                                                <div class="col col-xxl-12">
                                                    <select name="admins_status" class="form-control">
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Pasif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div align="end" class="box-footer">
                                            <button type="submit" class="btn btn-primary" name="admins_insert">Ekle</button>
                                        </div>

                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php  }  else if(isset($_GET["adminsUpdate"])) { ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Yönetici Düzenle</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['admins_update'])){
                                    $sonuc=$db->update("admins",$_POST,[
                                        "buton_key"=>"admins_update",
                                        "columns"=>"admins_id",
                                        "dir"=>"admins",
                                        "file_name"=>"admins_file",
                                        "file_delete"=>"delete_file",
                                        "pass"=>"admins_pass",
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
                                $sql=$db->wread('admins','admins_id',$_GET["admins_id"]);
                                $row=$sql->fetch(PDO::FETCH_ASSOC); ?>



                                <div class="container" style="width:70%; height: 90%; margin-left: auto;margin-right: auto; margin: auto; border-radius: 15px; background-color:#fcfcfc">
                                    <form method="post" enctype="multipart/form-data" style="width: 70%; height: 70%; margin-left: auto;margin-right: auto; padding: 3%">
                                        <div class="form-group"style=" width: 70%">
                                            <label> Mevcut Fotoğraf </label>
                                            <div class="row">
                                                <div class="col col-xs-12">
                                                    <img height="100px" src="dimg/admins/<?php echo $row['admins_file'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group" style=" padding-bottom: 2%; width: 70%">
                                        <label> Fotoğraf Seç</label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="file" name="admins_file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" padding-bottom: 2%; width: 70%">
                                        <label> Ad Soyad</label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="text" name="admins_namesurname"  value="<?php echo $row['admins_namesurname'] ;?>" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" padding-bottom: 2%; width: 70%">
                                        <label> Kullanıcı Adı</label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="text" name="admins_username"  value="<?php echo $row['admins_username'] ;?>" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" padding-bottom: 2%; width: 70%">
                                        <label>Kullanıcı Şifre</label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <input type="password" name="admins_pass" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" padding-bottom: 2%; width: 70%">
                                        <label>Kullanıcı Durumu</label>
                                        <div class="row">
                                            <div class="col col-xxl-12">
                                                <select name="admins_status" class="form-control">
                                                    <option <?php echo $row['admins_status']==1 ? 'selected':"" ?> value="1">Aktif</option>
                                                    <option <?php echo $row['admins_status']==0 ? 'selected':"" ?> value="0">Pasif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div align="end" class="box-footer" style=" padding-bottom: 2%; width: 70%">
                                        <input type="hidden" name="admins_id" value=" <?php echo $row['admins_id']; ?> ">
                                        <input type="hidden" name="delete_file" value=" <?php echo $row['admins_file']; ?> ">
                                        <button type="submit" class="btn btn-primary" name="admins_update">Düzenle</button>
                                    </div>
                                </form>
                            </div> </div>
                        </div>
                    </div>
                <?php  } ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Yöneticiler Tablosu</h4>
                            <div align="end">
                                <a href="?adminsyönetici=true"> <button class=" btn btn-primary">Yeni Ekle</button></a>
                                <br><br>
                            </div>

                            <?php
                            if(isset($_GET["adminsDelete"])) {
                                $sonuc=$db->delete("admins","admins_id",$_GET["admins_id"],$_GET["file_delete"]);

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
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kullanıcı Adı</th>
                                    <th>Ad Soyad</th>
                                    <th>Durum </th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = $db->read("admins");
                                $sayac=1;
                                while ($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                    ?>
                                    <tr>
                                        <td> <?php  echo $sayac++ ?> </td>
                                        <td> <?php echo $row['admins_username'] ; ?> </td>
                                        <td> <?php echo $row['admins_namesurname'] ; ?> </td>
                                        <td> <?php
                                            if($row['admins_status']==1){
                                                echo "Aktif";
                                            }
                                            else if($row['admins_status']==0) echo"Pasif";
                                            ?> </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                    <a>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </a>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="?adminsUpdate=True&admins_id=<?php echo $row['admins_id']?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                        <span>Edit</span>
                                                    </a>
                                                    <a class="dropdown-item"href="?adminsDelete=True&admins_id=<?php echo $row['admins_id']?>&file_delete=<?php echo $row['admins_file'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                        <span>Delete</span>
                                                    </a>
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
    </div>
    <!-- END: Content-->

<?php require_once 'footer.php'; ?>