<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $title_for_layout; ?></title>

        <style >
            body, td {font-family: Tahoma, Verdana; font-size: 10.5pt !important; line-height: 13pt; font-weight: normal;}
            #print_wrapper {width: 100%; margin-left: auto; margin-right: auto; padding: 0px 10px; box-sizing: border-box; }
            #print_wrapper > header {
                margin-bottom: 10px; padding: 5px; border-bottom: dotted #ccc 2px;
            }
            #print_wrapper table{
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div id="print_wrapper">
            <header>
                <?php echo $html->image('core/sbman-letterhead.png'); ?>
            </header>

            <?php echo $content_for_layout; ?>
        </div>
    </body>

    <?php echo $html->script('jquery.min.1.8.js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
            
            setTimeout(function() {window.close()}, 5000);
        });
    </script>
</html>



