



<?php



//add_recv,add_sales,add_inv,add_revr
if ($data['Sale']['transaction_type'] == "add_sales") {
    echo $this->element('print_trans/get_print_sale', array('data' => $data, 'site_info' => $rsite_info));
} else if ($data['Sale']['transaction_type'] == "add_recv") {
    echo $this->element('print_trans/get_print_receivable', array('data' => $data, 'site_info' => $rsite_info));
} else if ($data['Sale']['transaction_type'] == "add_inv") {
    echo $this->element('print_trans/get_print_invoice', array('data' => $data, 'site_info' => $rsite_info));
} else if ($data['Sale']['transaction_type'] == "add_revr") {
    echo $this->element('print_trans/get_print_reversal', array('data' => $data, 'site_info' => $rsite_info));
}
?>