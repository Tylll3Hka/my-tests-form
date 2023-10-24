<?php

session_start();

function notification(?string $text = null): void
{
    if ($text)
        $_SESSION["notification"] = $text;
    else {
        if (!empty($_SESSION["notification"]))
            echo '<p class="notification">
                    ' . $_SESSION["notification"] . '
                  </p>';
        unset($_SESSION["notification"]);
    }
}

function auth(): bool
{
    $id = isset($_SESSION['id']);
    if (!$id) {
        header("Location: /auth/login.php");
        return false;
    }
    return true;
}


