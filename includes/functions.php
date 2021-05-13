<?php
function is_account_exists($login, $password, $db) {
    $accounts_query = mysqli_query($db, "SELECT * from accounts");
    $accounts_data = get_assoc_rows($accounts_query);
    $exists = false;

    for($i = 0; $i < count($accounts_data); $i++) {
        $curr_acc = $accounts_data[$i];
    
        if($curr_acc['login'] === $login && $curr_acc['password'] === $password) $exists= true;
    }

    return $exists;
}

function get_assoc_rows($query) {
    $res = [];

    while($el = mysqli_fetch_assoc($query)) {
        $res[] = $el;
    }

    return $res;
}