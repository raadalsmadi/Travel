
<?php require_once "inc/header.php";

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true)
{
    header("location:index.php");
    exit();
}
?>

<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['trip']) && isset($_GET['idtrip'])){
                $numberPhone = $_POST['numberPhone'];
                $number_person = $_POST['number_person'];
                $idtravel      = $_GET['idtrip'];

                $userID = $_SESSION['userID'];

                if (empty($numberPhone) ||empty($number_person) ) {
                    echo "<div class='msg error'>الرجاء ملء جميع الحقول </div>";
                }elseif (!is_numeric($number_person) || !is_numeric($numberPhone)){
                    echo "<div class='msg error'>يجب كتابة عدد الاشخاص ورقم الهاتف بطريقة صحيحه</div>";
                }else{
                    $stmt = $con->prepare("INSERT INTO reservedtrip (`travel_id`,`user_id`,`number_person`,`phone`)VALUES(?,?,?,?)");
                    $result = $stmt->execute([$idtravel,$userID,$number_person,$numberPhone]);
                    if ($result){
                        echo "<div class='msg success'>سيتم اتصال بكم في اقل من 12 ساعه تم حجز رحلات بنجاح</div>";
                    }else{
                        echo "<div class='msg error'>حدث خطء اثناء حجز رحلات </div>";
                    }
                }
        }
    }
?>
<div class="container">
    <h2 class="text-center" ><?php echo isset($_GET['name']) ? " رحلات " . $_GET['name']: "" ?></h2>
    <div class="col-sm-12 col-md-6 col-md-offset-3">
        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <input  class="form-control" type="text" name="numberPhone" placeholder="رقم الهاتف"   />
            <input style="margin-top: 10px;" class="form-control" type="text" name="number_person"  placeholder="عدد الاشخاص"  />
            <button style="margin-top: 10px;" type="submit" class="btn btn-primary" name="trip">حجز رحلات</button>
        </form>
    </div>
</div>
<?php require_once "inc/footer.php";?>
