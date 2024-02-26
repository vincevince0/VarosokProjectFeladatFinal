<?php
if (isset($_POST['countyId'])) {
    require_once 'ItemRepositoryVarosok.php';
    $countyId = $_POST['countyId']; 

    $itemRepositoryVarosok = new ItemRepositoryVarosok();
    $city = $itemRepositoryVarosok->getCityByCountyId($countyId);

    echo '
        <form method="post" action="counties.php">
            <input type="text" name="city" value="' . $city['city'] . '">
            <input type="hidden" name="countyId" value="' . $city['countyId'] . '">
            <button type="submit" name="btn-save" method="post">Ment</button>
            <button type="submit" name="btn-cancel" method="post">Mégse</button>
        </form>';
} else {
    echo '
        <form method="post" action="counties.php">
            <input type="text" name="city" value="">
            <button type="submit" name="btn-save" method="post">Ment</button>
            <button type="submit" name="btn-cancel" method="post">Mégse</button>
        </form>';
}

