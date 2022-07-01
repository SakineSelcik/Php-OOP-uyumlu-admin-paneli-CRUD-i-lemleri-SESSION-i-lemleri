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
                    <?php  if(isset($_GET["usersyönetici"])) { ?>
                   <div class="col-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title">Kullanıcı Ekle </h4>
                           </div>
                           <div style="padding-bottom: 5%;padding-top: 3%" class="card-body">
                               <?php
                               if (isset($_POST['users_insert'])){
                                   $sonuc=$db->insert("users",$_POST,
                                       [
                                           "buton_key"=>"users_insert",
                                           "pass"=>"users_pass",
                                           "file_name"=>"users_file",
                                           "dir"=>"users"
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

                             <div class="container" style="width:70%; height: 90%; margin-left: auto;margin-right: auto; margin: auto; border-radius: 15px; background-color:#fcfcfc"> <form method="post" enctype="multipart/form-data" style="width: 70%; height: 70%; margin-left: auto;margin-right: auto; padding: 3%">
                                   <!--    <div class="form-group">
                                         <label >Fotoğraf Seç</label>
                                         <div >
                                             <input type="file" class="custom-file-input" name="users_file" id="customFile">
                                         </div>
                                     </div>-->
                                     <div class="form-group" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                                         <label> Fotoğraf Seç</label>
                                         <div class="row">
                                             <div class=" col col-xxl-12">
                                                 <input type="file" name="users_file" required="" class="form-control" placeholder="" >
                                             </div>
                                         </div>
                                     </div>
                                   <div class="form-group"  style=" padding-bottom: 2%; width: 70%">
                                       <label> </label>
                                       <div class="row">
                                           <div class=" col col-xxl-12">
                                               <input type="text" name="users_namesurname" required="" class="form-control" placeholder="Ad Soyad">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group"  style=" padding-bottom: 2%; width: 70%">
                                       <label></label>
                                       <div class="row">
                                           <div class="col col-xxl-12">
                                               <input type="email" name="users_mail" required="" class="form-control" placeholder="Kullanıcı Mail">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group"  style=" padding-bottom: 2%; width: 70%">
                                       <label></label>
                                       <div class="row">
                                           <div class=" col col-xxl-12">
                                               <input type="password" name="users_pass" required="" class="form-control" placeholder="Kullanıcı Şifre">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group"  style=" padding-bottom: 2%; width: 70%">
                                       <label>Kullanıcı Durumu</label>
                                       <div class="row">
                                           <div class="col col-xxl-12">
                                               <select name="users_status" class="form-control" >
                                                   <option value="1">Aktif</option>
                                                   <option value="0">Pasif</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                                   <div align="end" class="box-footer"  style=" padding-bottom: 2%; width: 70%">
                                       <button type="submit" class="btn btn-warning" name="users_insert">Ekle</button>
                                   </div>
                               </form></div>
                           </div>

                       </div>
                    </div>
               <?php  }  else if(isset($_GET["usersUpdate"])) { ?>
                   <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kullanıcı Düzenle</h4>
            </div>
            <div style="padding-bottom: 5%;padding-top: 3%" class="card-body">
                <?php
                if (isset($_POST['users_update'])){
                    $sonuc=$db->update("users",$_POST,[
                        "buton_key"=>"users_update",
                        "columns"=>"users_id",
                        "dir"=>"users",
                        "file_name"=>"users_file",
                        "file_delete"=>"delete_file",
                        "pass"=>"users_pass",
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
                $sql=$db->wread('users','users_id',$_GET["users_id"]);
                $row=$sql->fetch(PDO::FETCH_ASSOC);
                ?>

                <div class="container" style="width:70%; height: 90%; margin-left: auto;margin-right: auto; margin: auto; border-radius: 15px; background-color:#fcfcfc">
                    <form method="post" enctype="multipart/form-data" style="width: 70%; height: 70%; margin-left: auto;margin-right: auto; padding: 3%">
                        <div class="form-group" style=" padding-bottom: 2%; width: 70%">
                            <label> Mevcut Fotoğraf </label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <img height="100px" src="dimg/users/<?php echo $row['users_file'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                        <label> Fotoğraf Seç</label>
                        <div class="row">
                            <div class="col col-xxl-12">
                                <input type="file" name="users_file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                        <label> Ad Soyad</label>
                        <div class="row">
                            <div class="col col-xxl-12">
                                <input type="text" name="users_namesurname"  value="<?php echo $row['users_namesurname'] ;?>" required="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                        <label> Kullanıcı Mail</label>
                        <div class="row">
                            <div class="col col-xxl-12">
                                <input  type="email" name="users_mail" value="<?php echo $row['users_mail'] ;?>" required="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                        <label>Kullanıcı Şifre</label>
                        <div class="row">
                            <div class="col col-xxl-12">
                                <input type="password" name="users_pass" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                        <label>Kullanıcı Durumu</label>
                        <div class="row">
                            <div class="col col-xxl-12">
                                <select name="users_status" class="form-control">
                                    <option <?php echo $row['users_status']==1 ? 'selected':"" ?> value="1">Aktif</option>
                                    <option <?php echo $row['users_status']==0 ? 'selected':"" ?> value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div align="end" class="box-footer" style="padding-top: 2%; padding-bottom: 2%; width: 70%">
                        <input type="hidden" name="users_id" value=" <?php echo $row['users_id']; ?> ">
                        <input type="hidden" name="delete_file" value=" <?php echo $row['users_file']; ?> ">
                        <button type="submit" class="btn btn-warning" name="users_update">Düzenle</button>
                    </div>
                </form>
                </div> </div>
        </div>
    </div>
                    <?php  } ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kullanıcılar Tablosu</h4>
                                <div align="end">
                                    <a href="?usersyönetici=true"> <button class=" btn btn-warning">Yeni Ekle</button></a>
                                    <br><br>
                                </div>
                                <?php
                                if(isset($_GET["usersDelete"])) {
                                    $sonuc=$db->delete("users","users_id",$_GET["users_id"],$_GET["file_delete"]);

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
                                        <th>Ad Soyad</th>
                                        <th>Mail</th>
                                        <th>Durum </th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = $db->read("users");
                                    $sayac=1;
                                    while ($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                        ?>
                                        <tr>
                                            <td> <?php  echo $sayac++ ?> </td>
                                            <td> <?php echo $row['users_namesurname'] ; ?> </td>
                                            <td> <?php echo $row['users_mail'] ; ?> </td>
                                            <td> <?php
                                                if($row['users_status']==1){
                                                    echo "Aktif";
                                                }
                                                else if($row['users_status']==0) echo"Pasif";
                                                ?> </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <a>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                        </a>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="?usersUpdate=True&users_id=<?php echo $row['users_id']?>">
                                                           <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item" href="?usersDelete=True&users_id=<?php echo $row['users_id']?>&file_delete=<?php echo $row['users_file'] ?>">
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