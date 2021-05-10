<?php require_once __DIR__ . "/../core/_header.php"; ?>
    <form action="index.php?rt=login/login" method="POST">
        <label for="username"> Username</label>
        <input type="text" id="username">
        <br>
        <label for="password">Password</label>
        <input type="password" id="password">
        <br>
        <button type="submit">Login</button>
    </form>