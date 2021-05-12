<?php
function get_assoc_rows($query) {
    $res = [];

    while($el = mysqli_fetch_assoc($query)) {
        $res[] = $el;
    }

    return $res;
}