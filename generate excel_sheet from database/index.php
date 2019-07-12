<?php
include 'DBController.php';
$db_handle = new DBController();
$productResult = $db_handle->runQuery("select * from exel");

if (isset($_POST["export"])) {
    $filename = "Export_excel.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
?>
<html>
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="table-container">
        <div class="btn">
            <form action="" method="post">
                <button type="submit" id="btnExport" name='export' value="Export to Excel" class="btn btn-info">Export to Excel</button>
            </form>
        </div>
        <table id="tab">
            <thead>
                <tr>
                    <th width="35%">Name</th>
                    <th width="20%">Code</th>
                    <th width="25%">Mobile</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (! empty($productResult)) {
                foreach ($productResult as $key => $value) {
                    ?>
                 
                     <tr>
                    <td><?php echo $productResult[$key]["name"]; ?></td>
                    <td><?php echo $productResult[$key]["code"]; ?></td>
                    <td><?php echo $productResult[$key]["mobile"]; ?></td>
                </tr>
             <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>