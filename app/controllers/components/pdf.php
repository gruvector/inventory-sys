<?php

App::import('View', 'view');
App::Import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));

class PdfComponent extends Object {

    private $controller = null;
    
    public function initialize(&$controller) {
        $this->controller = $controller;
    }
    
    private function build_pdf($view_path = '', $view_data = array()) {
         $this->controller->layout = "pdf_layout";
        
        $view = new View($this->controller, false);
        $view->set($view_data);
        $html = "";

        if ($view_path == '') {
            $html = $view->render($this->controller->action);
        } else {
            $html = $view->render($view_path);
        }
        
        $html = str_replace("/flight-manager/", "file://" . WWW_ROOT , $html);

        $dompdf = new DOMPDF();
        $dompdf->set_base_path(WWW_ROOT);
        $dompdf->load_html($html);
        $dompdf->render();
        
        return $dompdf->output();
    }

    public function generate($filename, $view_path = '', $view_data = array()) {

        if (strpos($filename, '.pdf') == false) {
            $filename .= ".pdf";
        }

        $filepath = WWW_ROOT . 'files/pdf/' . $filename;

        file_put_contents($filepath, $this->build_pdf($view_path, $view_data) );

        return $filepath;
    }
    
    public function download($filename, $view_path = '', $view_data = array()) {

        if (strpos($filename, '.pdf') == false) {
            $filename .= ".pdf";
        }

        header("Content-type: application/pdf"); // It will be called downloaded.pdf 
        header("Content-Disposition: attachment; filename=\"$filename\"");

        echo $this->build_pdf($view_path, $view_data); 
    }

}

?>