<?php
if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $series_name = $data->u;
}
