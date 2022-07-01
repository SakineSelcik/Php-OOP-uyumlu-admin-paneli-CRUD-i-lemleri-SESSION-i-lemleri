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
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Borderless table start -->
            <div class="row" id="">
                <?php
                if(isset($_GET["blogsyönetici"])) { ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Blog Ekle </h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['blogs_insert'])){
                                $sonuc=$db->insert("blogs",$_POST,[
                                    "buton_key"=>"blogs_insert",
                                    "dir"=>"blogs",
                                    "file_name"=>"blogs_file"
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
                                                <input type="file" name="blogs_file" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" width: 70%">
                                        <label> Blog Title</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" name="blogs_title" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" width: 70%" >
                                        <label> Blog İçerik</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <textarea id="editor1" name="blogs_content" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div align="end" class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="blogs_insert">Ekle</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  }  else if(isset($_GET["blogsUpdate"])) { ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Blog Düzenle</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_POST['blogs_update'])){
                                $sonuc=$db->update("blogs",$_POST,[
                                    "buton_key"=>"blogs_update",
                                    "columns"=>"blogs_id",
                                    "dir"=>"blogs",
                                    "file_name"=>"blogs_file",
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
                            $sql=$db->wread('blogs','blogs_id',$_GET["blogs_id"]);
                            $row=$sql->fetch(PDO::FETCH_ASSOC); ?>



                            <div class="container" style="width:70%; height: 90%; margin-left: auto;margin-right: auto; margin: auto; border-radius: 15px; background-color:#fcfcfc">

                                <form method="post" enctype="multipart/form-data" style="width: 70%; height: 70%; margin-left: auto;margin-right: auto; padding: 3%">
                                    <div class="form-group" style=" width: 70%" >
                                        <label> Mevcut Fotoğraf </label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <img height="100px" src="dimg/blogs/<?php echo $row['blogs_file'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" width: 70%">
                                        <label> Fotoğraf Seç</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="file" name="blogs_file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" width: 70%">
                                        <label> Blog Title</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" name="blogs_title"  value="<?php echo $row['blogs_title'] ;?>" required="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style=" width: 70%">
                                        <label> Blog İçerik</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <textarea id="editor1" name="blogs_content" class="form-control"><?php echo $row['blogs_content'] ; ?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div align="end" class="box-footer">
                                        <input type="hidden" name="blogs_id" value=" <?php echo $row['blogs_id']; ?> ">
                                        <input type="hidden" name="delete_file" value=" <?php echo $row['blogs_file']; ?> ">
                                        <button type="submit" class="btn btn-primary" name="blogs_update">Düzenle</button>
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
                        <h4 class="card-title">Blogs Listele</h4>
                        <div align="end">
                            <a href="?blogsyönetici=true"> <button class=" btn btn-primary">Yeni Ekle</button></a>
                            <br><br>
                        </div>

                        <?php
                        if(isset($_GET["blogsDelete"])) {
                            $sonuc=$db->delete("blogs","blogs_id",$_GET["blogs_id"],$_GET["file_delete"]);

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
                                <th align="center" width="5">#</th>
                                <th>Blog Title</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                            <?php
                            // $sql=$db->qSql("SELECT * FROM blogs  order by blogs_must ASC");

                            $sql=$db->read("blogs");
                            $say=1;
                            while ($row=$sql->fetch(PDO::FETCH_ASSOC)) {  ?>

                                <tr id="item-<?php echo $row['blogs_id'] ?>">
                                    <td><?php echo $say++; ?></td>
                                    <td class="sortable"><?php echo $row['blogs_title'] ?></td>

                                    <td align="center" width="5">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                <a>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </a>
                                            </button>
                                            <div class="dropdown-menu">
                                              <a class="dropdown-item" href="?blogsUpdate=true&blogs_id=<?php echo $row['blogs_id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                    <span>Edit</span>
                                                </a>
                                                <a class="dropdown-item"  href="?blogsDelete=True&blogs_id=<?php echo $row['blogs_id'] ?>&file_delete=<?php echo $row['blogs_file'] ?>">
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
<script type="text/javascript">

    $(function() {
        $("#sortable").sortable({
            revert:true,
            handle:".sortable",
            stop:function(event,ui) {
                var data=$(this).sortable('serialize');
                console.log(data);
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    data:data,
                    url:"netting/order-ajax.php?blogs_must=true",
                    success:function(msg) {
                        if (msg.islemMsj) {
                            alert("Sıralama Başarılı");
                        } else {
                            alert("Hata Var...");
                        }

                    }
                });
            }



        });
        $("#sortable").disableSelection();
    });

</script>

<?php require_once 'footer.php'; ?>