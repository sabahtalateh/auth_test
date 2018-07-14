<?php
namespace src\view\register;

?>

<form action="/login" method="post">
    <label for="email">email</label>
    <input type="text" name="email" id="email"/>
    <br>
    <label for="password">password</label>
    <input type="password" name="password" id="password"/>
    <br>
    <button type="submit">Done</button>
</form>
<br>
<a href="/">main</a>