<?php
namespace Anax\View;

?>
<navbar class="navbar">
    <a href="?">Show all movies</a> |
    <a href="?route=reset">Reset database</a> |
    <a href="?route=search-title">Search title</a> |
    <a href="?route=search-year">Search year</a> |
    <a href="?route=movie-select">Select</a> |
    <a href="?route=show-all-sort">Show all sortable</a> |
    <a href="?route=show-all-paginate">Show all paginate</a> |
</navbar>

<h1>My Movie Database</h1>

<?php

if ($view) {
    foreach ($view as $section) {
        require $section;
    }
}
