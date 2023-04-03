<?php
function checkPrivilege()
{
    $privileges = array(
        "categoryListing\.php$",
        "productListing\.php$",
    );

    $privileges = implode("|", $privileges);
    preg_match('/' . $privileges . '/', 'modules/quanlydanhmucsp/categoryListing.php', $matches);
    return !empty($matches);
}

$regexResult = checkPrivilege();
var_dump($regexResult);
exit;