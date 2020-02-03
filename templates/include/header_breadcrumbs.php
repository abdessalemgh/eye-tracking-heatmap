<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"><?php echo $pageData['page-title'] ?></h4>
                <ul class="breadcrumbs pull-left">
                    <?php
                    foreach ($pageData['breadcrumbs'] as $breadcrumb) {
                        //Creat list element.
                        if (isset($breadcrumb['link']))
                            $element = "<li><a href='" . $breadcrumb['link'] . "'>" . $breadcrumb['title'] . "</a></li>";
                        else
                            $element = "<li><span>" . $breadcrumb['title'] . "</span></li>";

                        echo $element;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->