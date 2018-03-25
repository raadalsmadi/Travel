<?php
$pageTitle = "رحلات";
require_once("./inc/header.php");

if(!isset($_SESSION['roles']) && $_SESSION['roles'] != 1)
{
    header("location:index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $clo_name        = $_POST['clo_name'];
    $clo_description = $_POST['clo_description'];
    $clo_price       = $_POST['clo_price'];
    $cat_id          = $_POST['cat_id'];
    $img             = $_FILES['clo_file'];


    // Check If Request Add Category
    if(isset($_POST['addItem'])){
        if(!empty($clo_name) && !empty($clo_description) && !empty($clo_price) && !empty($cat_id) && is_numeric($cat_id) && !empty($img['name']))
        {

            if(addItem($clo_name,$clo_description,$clo_price,$cat_id,$img,$_POST['date']))
            {
                $success = 'تم اضافة رحلات بنجاح';
                header("refresh:3;url=addTravel.php");
            }else
            {
                $error = "حدث خطء الرجاء المحاولة في وقت اخر";
            }
        }else
        {
            $error = 'الرجاء ملء جميع الحقول';
        }

    }

    // Check If Request Edit Category
    if(isset($_POST['editItem'])){
        if(!empty($clo_name) && !empty($clo_description) && !empty($clo_price) && !empty($cat_id) && is_numeric($cat_id))
        {

            if(editItem($_POST['clo_id'],$clo_name,$clo_description,$clo_price,$cat_id,$_POST['clo_img'],$img,$_POST['date']))
            {
                header("refresh:3;url=addTravel.php");
                $success = 'تم التعديل بنجاح';
            }else
            {
                $error = "حدث خطء الرجاء المحاولة في وقت اخر";
            }

        }else
        {
            $error = 'الرجاء ملء جميع الحقول';
        }
    }

}

/*&& isset($_GET['userID']) && is_numeric($_GET['userID'])*/
if(isset($_GET['view']) && $_GET['view'] === "add")
{ ?>
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="login-form"><!--Add Categoey form-->
                        <h2 class="text-center">اضافه رحلات</h2>
                        <?php
                        if(isset($error))
                        {
                            echo "<div class='msg error'>$error</div>";
                        }elseif(isset($success))
                        {

                            echo "<div class='msg success'>$success</div>";
                        }
                        ?>
                        <form  enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                            <input class="form-control" maxlength="200" type="text" name="clo_name"  placeholder="عنوان الرحلة" />
                            <input maxlength="200" class="form-control" type="text" name="clo_price"  placeholder="الثمن" />
                            <textarea class="form-control" name="clo_description" placeholder="معلومات رحلات"></textarea>
                            <select class="form-control"  style="margin: 10px 0;" name="cat_id" >
                                <option>الاصناف</option>
                                <?php getAllCategoriesToClo() ?>
                            </select>

                            <input style="padding: 10px" class="form-control" type="file" name="clo_file"/>
                            <input style="padding: 10px" class="form-control" type="datetime-local" name="date"/>
                            <button type="submit" class="btn btn-primary" name="addItem">اضافه</button>
                            <br>
                        </form>
                    </div><!--/Add Category form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
    <br><br>
<?php }elseif (isset($_GET['view']) && $_GET['view'] === "edit" &&
    isset($_GET['clo_id']) &&
    is_numeric($_GET['clo_id']) &&
    isset( $_GET['clo_name']) &&
    isset( $_GET['clo_description']) &&
    isset( $_GET['cat_name']) &&
    isset( $_GET['clo_price']) &&
    isset( $_GET['clo_img'])
){ ?>
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="login-form"><!--Add Categoey form-->
                        <h2 class="text-center"> اضافه رحلات</h2>
                        <?php
                        if(isset($error))
                        {
                            echo "<div class='msg error'>$error</div>";
                        }elseif(isset($success))
                        {

                            echo "<div class='msg success'>$success</div>";
                        }
                        ?>
                        <form  enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                            <input class="form-control" maxlength="200" type="text" name="clo_name"  value="<?php echo $_GET['clo_name']?>" />
                            <input class="form-control" maxlength="200" type="text" name="clo_price"  value="<?php echo $_GET['clo_price']?>" />
                            <input type="hidden" name="clo_id"  value="<?php echo $_GET['clo_id']?>" />
                            <input type="hidden" name="clo_img"  value="<?php echo $_GET['clo_img']?>" />
                            <textarea class="form-control"  name="clo_description" placeholder="الوصف رحلات"><?php echo $_GET['clo_description']?></textarea>
                            <select class="form-control" style="margin: 10px 0;" name="cat_id" >
                                <option>الاصناف</option>
                                <?php getAllCategoriesToClo( $_GET['cat_name']) ?>
                            </select>

                            <input class="form-control" style="padding: 10px" type="file" name="clo_file"/>
                            <input style="padding: 10px" class="form-control" type="datetime-local" name="date" value="<?php echo $_GET['date']?>"/>
                            <button type="submit" class="btn btn-primary" name="editItem">تعديل</button>
                        </form>
                    </div><!--/Add Category form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
    <br>
    <br>
<?php }

if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['clo_id']) && is_numeric($_GET['clo_id']))
{
    if(deleteItemsById($_GET['clo_id']))
    {
        $success = "تم حذف رحلات بنجاح";
    }else
    {
        $error = "حدث خطء الرجاء المحاولة في وقت اخر";
    }
}
?>

    <section id="cart_items">
        <div class="container">
            <?php
            if(isset($error))
            {
                echo "<div class='msg error'>$error</div>";
            }elseif(isset($success))
            {
                header("refresh:3;url=addTravel.php");
                echo "<div class='msg success'>$success</div>";
            }
            ?>
            <br>
            <div class="table-responsive cart_info text-center">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td >#</td>
                        <td >العنوان</td>
                        <td >الوصف</td>
                        <td >القسم</td>
                        <td >الثمن</td>
                        <td >تاريخ رحلات</td>
                        <td>تعديل</td>
                        <td>حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php getTravel() ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
<?php require_once("./inc/footer.php"); ?>