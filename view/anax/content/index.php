<?php
namespace Anax\View;

?>
<script src="https://use.fontawesome.com/e5579368c4.js"></script>

<navbar class="navbar">
    <a href="?">Show all content</a> |
    <a href="?route=admin">Admin</a> |
    <a href="?route=create">Create</a> |
    <a href="?route=reset">Reset database</a> |
    <a href="?route=pages">View pages</a> |
    <a href="?route=blog">View blog</a> |
</navbar>

<h1>My Content Database</h1>

<?php

if ($view) {
    foreach ($view as $section) {
        require $section;
    }
}
