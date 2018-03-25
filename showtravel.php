<?php require_once "inc/header.php"?>

<section id="cart_items">
    <div class="container">
        <br>
        <div class="table-responsive cart_info text-center">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td >#</td>
                    <td >اسم الشخص</td>
                    <td >عنوان رحلات</td>
                    <td >رقم الهاتف</td>
                    <td >عدد الاشخاص</td>
                    <td >تاريخ رحلات</td>
                </tr>
                </thead>
                <tbody>
                <?php gettrip() ?>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<?php require_once("./inc/footer.php"); ?>
