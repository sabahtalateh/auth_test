<?php

namespace src\view\register;

?>

<form action="/register" method="post" enctype="multipart/form-data">
    <label for="email">email</label>
    <input type="text" name="email" id="email"/>
    <br>
    <label for="password">password</label>
    <input type="password" name="password" id="password"/>
    <br>
    <label for="avatar">avatar</label>
    <input type="file" name="avatar" id="avatar"/>
    <br>
    <button type="submit">Done</button>
</form>
<br>
<a href="/login">login</a>
<a href="/">main</a>
