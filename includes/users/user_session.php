<?php
function is_account_exists($db, $login, $password) {
    $accounts_query = mysqli_query($db, "SELECT * from `users`");
    $accounts_data = get_assoc_rows($accounts_query);
    $exists = false;

    for($i = 0; $i < count($accounts_data); $i++) {
        $curr_acc = $accounts_data[$i];
    
        if($curr_acc['login'] === $login && $curr_acc['password'] === $password) $exists = $curr_acc['id'];
    }

    return $exists;
}

function start_user_session($db, $user_id) {
    session_start();
    
    $user_query = mysqli_query($db, "SELECT * FROM `users` WHERE `id` = $user_id");
    $user_data = mysqli_fetch_assoc($user_query);

    $status_id = $user_data['status'];
    $user_status_query = mysqli_query($db, "SELECT * FROM `statuses` WHERE `id` = '$status_id'");
    $user_permisions_data = mysqli_fetch_assoc($user_status_query);
    $admin_panel_access = $user_permisions_data['admin_panel_access'];
    $edit_access = $user_permisions_data['edit_access'];

    $_SESSION['id'] = $user_id;
    $_SESSION['login'] = $user_data['login'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['admin_panel_access'] = $admin_panel_access;
    $_SESSION['edit_access'] = $edit_access;
}

function is_logged_in() {
    return $_SESSION['id'] ? true : false;
}

function has_admin_panel_access() {
    return $_SESSION['admin_panel_access'] == 1 ? true : false;
}

function has_edit_access() {
    return $_SESSION['edit_access'] == 1 ? true : false;
}