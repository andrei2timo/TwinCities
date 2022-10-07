<?php
/**
 * User: Jacob
 * Date: 07/02/2018
 * github.com/coobie
 */

 //echo($base_url.'aboutus'.$url_ending);
?>

</div>
<footer class="panel-footer">

    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">
            <div><a href="<?php echo($base_url.'aboutus'.$url_ending);?>"><i class="fa fa-info" id="info"></i></a>&nbsp;&nbsp;
                <a href="<?php echo($base_url.'rss'.$url_ending);?>"><i class="fa fa-rss" id="rss"></i></a>
            </div>
        </div>
    </div>
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            <span class="glyphicon glyphicon-copyright-mark"></span> <?php echo date("Y"); ?> Copyright
        </div>
    </div>
    <!--/.Copyright-->

</footer>
</html>
