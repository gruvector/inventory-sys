

<a href="#" id="A_78"><i id="I_79"></i><span id="SPAN_80"><?php echo (sizeof($stock_data) >= 1) ? sizeof($stock_data) : ""; ?></span></a>
<ul class="notif_div" id="UL_81">
    <li id="LI_82">
        <i id="I_83"></i> You have <?php echo (sizeof($stock_data) >= 1) ? sizeof($stock_data) : "no" ?> notifications
    </li>
    <li id="LI_84">
        <div id="DIV_85">
            <ul id="UL_86">
                <?php foreach ($stock_data as $val) { ?>
                    <li id="LI_87">
                        <a href="#" id="A_88"></a>
                        <h3 id="H3_89">
                            <?php echo ucfirst($val['Product']['product_name']) . " (" . $val['Product']['stock_available'] . ")"; ?><small id="SMALL_90">
                            <?php
                            if ($val['Product']['max_stock_notif'] == 0) {
                                echo "%";
                            } else {
                                $left_perc = ($val['Product']['stock_available'] / $val['Product']['max_stock_notif']) * 100;
                                $out_echo = number_format($left_perc, 2, '.', '');
                                echo $out_echo . "%";
                            }
                            ?></small>
                        </h3>
                        <div id="DIV_91">
                            <div id="DIV_92"
                                 class="<?php
                                 if ($val['Product']['max_stock_notif'] == 0) {
                                     echo "progress-bar-info";
                                 } else {
                                     $left_perc = ($val['Product']['stock_available'] / $val['Product']['max_stock_notif']) * 100;
                                     $out_echo = number_format($left_perc, 2, '.', '');
                                     if ($out_echo > 0.00 && $out_echo <= 25) {
                                         echo "progress-bar-danger";
                                     } else if ($out_echo > 25.00 && $out_echo <= 60.00) {
                                         echo "progress-bar-warning";
                                     } else if ($out_echo > 60.00) {
                                         echo "progress-bar-info";
                                     }
                                 }
                                 ?>"   style ="width:
                                 <?php
                                 if ($val['Product']['max_stock_notif'] == 0) {
                                     echo "0%";
                                 } else {
                                     $left_perc = ($val['Product']['stock_available'] / $val['Product']['max_stock_notif']) * 100;
                                     $out_echo = number_format($left_perc, 2, '.', '');
                                     echo $out_echo . "%";
                                 }
                                 ?>
                                 ">
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <div id="DIV_111">
            </div>
            <div id="DIV_112">
            </div>
        </div>
    </li>
</ul>