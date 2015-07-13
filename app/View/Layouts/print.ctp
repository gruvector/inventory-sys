<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->css('print/base.css');
        echo $this->Html->css('print/horizon.css');
        echo $this->Html->css('print/horizon_print.css');
        ?>
        
        <style >
           
            body{
                  background: grey;
            }
         
            
        </style>
     
    </head>

    <body>
        <?php echo $content_for_layout; ?>
    </body>

    <?php echo $this->Html->script('jquery.min.1.8.js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
          window.print();
            
          setTimeout(function() {window.close()}, 1000);
        });
    </script>
</html>



