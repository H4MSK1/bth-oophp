<?php
/**
 * Create routes using $app programming style.
 */


/**
 * Show all movies.
 */
$app->router->any(["GET", "POST"], "movie", function () use ($app) {

    $app->db->connect();
    $route = $app->request->getGet("route", "");
    $title = " | My Movie Database";
    $view = [];
    $sql = null;
    $resultset = null;

    // Simple router
    switch ($route) {
        case "":
            $title = "Show all movies";
            $view[] = "view/show-all.php";
            $sql = "SELECT * FROM movie;";
            $resultset = $app->db->executeFetchAll($sql);
            break;

        case "show-all-sort":
            $title = "Show and sort all movies";
            $view[] = "view/show-all-sort.php";

            // Only these values are valid
            $columns = ["id", "title", "year", "image"];
            $orders = ["asc", "desc"];

            // Get settings from GET or use defaults
            $orderBy = $app->request->getGet("orderby") ?: "id";
            $order = $app->request->getGet("order") ?: "asc";

            // Incoming matches valid value sets
            if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
                die("Not valid input for sorting.");
            }

            $sql = "SELECT * FROM movie ORDER BY $orderBy $order;";
            $resultset = $app->db->executeFetchAll($sql);
            break;

        case "show-all-paginate":
            $title = "Show, paginate movies";
            $view[] = "view/show-all-paginate.php";

            // Get number of hits per page
            $hits = $app->request->getGet("hits", 4);
            if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
                die("Not valid for hits.");
            }

            // Get max number of pages
            $sql = "SELECT COUNT(id) AS max FROM movie;";
            $max = $app->db->executeFetchAll($sql);
            $max = ceil($max[0]->max / $hits);

            // Get current page
            $page = $app->request->getGet("page", 1);
            if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
                die("Not valid for page.");
            }
            $offset = $hits * ($page - 1);

            // Only these values are valid
            $columns = ["id", "title", "year", "image"];
            $orders = ["asc", "desc"];

            // Get settings from GET or use defaults
            $orderBy = $app->request->getGet("orderby") ?: "id";
            $order = $app->request->getGet("order") ?: "asc";

            // Incoming matches valid value sets
            if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
                die("Not valid input for sorting.");
            }

            $sql = "SELECT * FROM movie ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
            $resultset = $app->db->executeFetchAll($sql);
            break;

        case "reset":
            $title = "Resetting the database";
            $view[] = "view/reset.php";
            break;

        case "select":
            $title = "SELECT *";
            $view[] = "view/select.php";
            $sql = "SELECT * FROM movie;";
            $resultset = $app->db->executeFetchAll($sql);
            break;

        case "search-title":
            $title = "SELECT * WHERE title";
            $view[] = "view/search-title.php";
            $view[] = "view/show-all.php";
            $searchTitle = $app->request->getGet("searchTitle");
            if ($searchTitle) {
                $sql = "SELECT * FROM movie WHERE title LIKE ?;";
                $resultset = $app->db->executeFetchAll($sql, [$searchTitle]);
            }
            break;

        case "search-year":
            $title = "SELECT * WHERE year";
            $view[] = "view/search-year.php";
            $view[] = "view/show-all.php";
            $year1 = $app->request->getGet("year1");
            $year2 = $app->request->getGet("year2");
            if ($year1 && $year2) {
                $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
                $resultset = $app->db->executeFetchAll($sql, [$year1, $year2]);
            } elseif ($year1) {
                $sql = "SELECT * FROM movie WHERE year >= ?;";
                $resultset = $app->db->executeFetchAll($sql, [$year1]);
            } elseif ($year2) {
                $sql = "SELECT * FROM movie WHERE year <= ?;";
                $resultset = $app->db->executeFetchAll($sql, [$year2]);
            }
            break;

        case "movie-select":
            $movieId = $app->request->getPost("movieId");

            if ($app->request->getPost("doDelete")) {
                $sql = "DELETE FROM movie WHERE id = ?;";
                $app->db->execute($sql, [$movieId]);
                header("Location: ?route=movie-select");
                exit;
            } elseif ($app->request->getPost("doAdd")) {
                $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
                $app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
                $movieId = $app->db->lastInsertId();
                header("Location: ?route=movie-edit&movieId=$movieId");
                exit;
            } elseif ($app->request->getPost("doEdit") && is_numeric($movieId)) {
                header("Location: ?route=movie-edit&movieId=$movieId");
                exit;
            }

            $title = "Select a movie";
            $view[] = "view/movie-select.php";
            $sql = "SELECT id, title FROM movie;";
            $movies = $app->db->executeFetchAll($sql);
            break;

        case "movie-edit":
            $title = "UPDATE movie";
            $view[] = "view/movie-edit.php";

            $movieId    = $app->request->getPost("movieId") ?: $app->request->getGet("movieId");
            $movieTitle = $app->request->getPost("movieTitle");
            $movieYear  = $app->request->getPost("movieYear");
            $movieImage = $app->request->getPost("movieImage");

            if ($app->request->getPost("doSave")) {
                $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
                $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
                header("Location: ?route=movie-edit&movieId=$movieId");
                exit;
            }

            $sql = "SELECT * FROM movie WHERE id = ?;";
            $movie = $app->db->executeFetchAll($sql, [$movieId]);
            $movie = $movie[0];
            break;

        default:
            ;
    };

    $app->page->add("anax/v2/movie/index", [
        "resultset" => $resultset,
        "movie" => $movie ?? null,
        "movies" => $movies ?? null,
        "view" => $view,
        "route" => $route,
        "sql" => $sql,
        "max" => $max ?? null,
        "searchTitle" => $searchTitle ?? null,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
