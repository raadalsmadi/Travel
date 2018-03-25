<?php
$pageTitle = "تسجيل";
require_once("./inc/header.php");
if(isset($_SESSION['login']) && $_SESSION['login'] === true)
{
    header("location:index.php");
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // Variable Register User
    $username     = trim($_POST['username']);
    $email        = trim($_POST['email']);
    $password     = $_POST['password'];
    $dof     = $_POST['dof'];
    $age     = $_POST['age'];
    $phone     = $_POST['phone'];
    $passwordHash = md5($password); // Password Encreption in hash md5

    $user = $con->prepare("SELECT * FROM users WHERE `username`=?");
    $user->execute(array($username));
    $user = $user->rowCount();

    $emailT = $con->prepare("SELECT * FROM users WHERE `email`=?");
    $emailT->execute(array($email));
    $emailT = $emailT->rowCount();


    if(empty($username) || empty($email) || empty($password))
    {
        $error = "الرجاء ملء جميع الحقول";
    }elseif ($user > 0) {
        $error = "اسم المستخدم موجود";
    }
    elseif ($emailT > 0) {
        $error = "البريد الاكتروني موجود";
    }
    else
    {
        $stmt = $con->prepare("INSERT INTO users (`username`,`email`,`password`,`dof`,`age`,`phone`) VALUES (?,?,?,?,?,?)");
        $reg  = $stmt->execute(array($username,$email,$passwordHash,$dof,$age,$phone));
        if($reg)
        {
            $success = '  سيتم تفعيل الحساب خلال 12 ساعه تم عمل حساب بنجاح';
            header("refresh:3;url=login.php");
        }
    }
}
?>

    <section id="form"><!--form-->
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2 class="text-center" >انشاء حساب جديد</h2>
                        <?php
                        if(isset($error))
                        {
                            echo "<div class='msg error'>$error</div>";
                        }elseif(isset($success))
                        {

                            echo "<div class='msg success'>$success</div>";
                        }
                        ?>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                            <input class="form-control" type="text" name="username" placeholder="اسم المستخدم"/>
                            <input class="form-control" style="margin-top: 10px;" type="text" name="email" placeholder=" البريد الالكتروني" />
                            <input style="margin-top: 10px;" class="form-control" type="password" name="password"  autocomplete="new-password" placeholder="كلمة المرور" />
                           <input class="form-control" type="date" name="dof" placeholder="تاريخ الميلاد"/>
                           <input class="form-control" type="number" name="age" placeholder="العمر"/>
                           <input class="form-control" type="text" name="phone" placeholder="رقم التلفون"/>
                            <button style="margin-top: 10px;" type="submit" class="btn btn-primary" name="register">تسجيل</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->


<?php require_once("./inc/footer.php"); ?>