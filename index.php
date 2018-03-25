<?php require_once "inc/header.php"?>
<?php require_once "inc/slider.php"?>




<div class="container">
    <h2 class="text-center" style="color:#777;    margin-bottom: -23px;">اهلا وسهلا بموقعنا ارجو ان ينال اعجابكم</h2>
<div class="row">
    <br>
    <br>
<?php
    $clos = getClothingByNameCategory();
    foreach ($clos as $clo) {

    ?>
    <div class="travelCategory">
        <div class="col-md-4 col-sm-12">
            <div class="item"style='height:390px'>
                <h4><?php echo $clo['title']?></h4>
                <img class="img-responsive" src="images/uploadImages/<?php echo $clo['imgPath']; ?>" >
                <p> <strong>   وقت رحلات</strong> : <?php echo strftime("%Y-%m-%d %H:%M",strtotime($clo['date']))?></p>
                <p><?php echo substr($clo['body'],0,100)?>
                <button class="btn btn-success" data-toggle="modal" data-target="#ID_<?php echo $clo['id']?>" >قرائة المزيد</button>

                </p>
                <!-- Start Popup  -->
                <!-- Modal -->
                <div id="ID_<?php echo $clo['id']?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><?php echo $clo['title'] ?></h3>
                    </div>
                    <div class="modal-body">
                        <p> <?php echo $clo['body'] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
                </div>
                <!-- End Popup  -->
                <?php
                if(isset($_SESSION['login']) && isset($_SESSION['login']) == true){
                    echo "<a style='position: absolute;
    bottom: 0;'  href='Bookyourtrip.php?idtrip=".$clo['id']."&name=".$clo['title']."' class='btn btn-block btn-primary' >حجز الرحلة</a>";
                }else{
                    echo "<p style='position: absolute;
    bottom: -10px;
    width: 100%;
    color: #FFF;' class='label-danger text-center'>يجب التسجيل بلموقع لحجز رحلات</p>";
                }
                ?>
            </div>
        </div>
    </div>
<?php }?>
</div>
</div>
<?php require_once "inc/footer.php"?>
