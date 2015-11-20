<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: thehouseoflaws.org
 * Date:    10/27/2015
 * Time:    10:46 AM
 */

$requestContext = \System\Request\RequestContext::instance();
require_once("header.php");
?>
    <h1>404 - Page Not Found!</h1>
    <h6>This page could not be found.</h6>
    <p>The page may have moved, the URL may have changed, or it is being accessed by the wrong URL.</p>

    <?php if(is_development())
    {
        ?>
        <p>
            <?php echo $requestContext->getResponseData(); ?>
        </p>
        <?php
    }
    ?>
<?php
require_once("footer.php");
?>