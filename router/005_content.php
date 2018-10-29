<?php
/**
 * Create routes using $app programming style.
 */


/**
 * Show all movies.
 */
$app->router->any(["GET", "POST"], "content", function () use ($app) {

    $app->db->connect();
    $filter = new \H4MSK1\Filter\TextFilter();
    $route = $app->request->getGet("route", "");
    $title = " | My Content Database";
    $view = [];
    $resultset = null;
    $databaseConfig = $app->get("configuration")->load("database");

    $contentModel = new \H4MSK1\Content\Content();
    $contentModel->setApp($app);

    $blogModel = new \H4MSK1\Content\Blog();
    $blogModel->setApp($app);

    $pageModel = new \H4MSK1\Content\Page();
    $pageModel->setApp($app);

    switch ($route) {
        case "":
            $title = "Show all content";
            $view[] = "view/show-all.php";
            $resultset = $contentModel->fetchAll();
            break;

        case "reset":
            $title = "Resetting the database";
            $view[] = "view/reset.php";
            break;

        case "admin":
            $title = "Admin content";
            $view[] = "view/admin.php";
            $resultset = $contentModel->fetchAll();
            break;

        case "edit":
            $title = "Edit content";
            $view[] = "view/edit.php";
            $contentId = $app->request->getPost("contentId") ?: $app->request->getGet("id");
            if (!is_numeric($contentId)) {
                die("Not valid for content id.");
            }

            if (hasKeyPost("doDelete")) {
                header("Location: ?route=delete&id=$contentId");
                exit;
            } elseif (hasKeyPost("doSave")) {
                $params = getPost([
                    "contentTitle",
                    "contentPath",
                    "contentSlug",
                    "contentData",
                    "contentType",
                    "contentFilter",
                    "contentPublish",
                    "contentId"
                ]);

                if (!$params["contentSlug"]) {
                    $params["contentSlug"] = slugify($params["contentTitle"]);
                }

                if (!$params["contentPath"]) {
                    $params["contentPath"] = null;
                }

                if ($blogModel->fetchOne($params["contentSlug"])) {
                    $params["contentSlug"] = $params["contentSlug"] . "-" . rand(1, 1000);
                }

                $contentModel->update($params);
                header("Location: ?route=edit&id=$contentId");
                exit;
            }

            $content =  $contentModel->findById($contentId);
            break;

        case "create":
            $title = "Create content";
            $view[] = "view/create.php";

            if (hasKeyPost("doCreate")) {
                $title = $app->request->getPost("contentTitle");
                $contentModel->insert($title);
                $id = $app->db->lastInsertId();

                header("Location: ?route=edit&id=$id");
                exit;
            }
            break;

        case "delete":
            $title = "Delete content";
            $view[] = "view/delete.php";
            $contentId = $app->request->getPost("contentId") ?: $app->request->getGet("id");
            if (!is_numeric($contentId)) {
                die("Not valid for content id.");
            }

            if (hasKeyPost("doDelete")) {
                $contentId = $app->request->getPost("contentId");
                $contentModel->delete($contentId);
                header("Location: ?route=admin");
                exit;
            }

            $content = $contentModel->findById($contentId);
            break;

        case "pages":
            $title = "View pages";
            $view[] = "view/pages.php";
            $resultset = $pageModel->fetchAll();
            break;

        case "blog":
            $title = "View blog";
            $view[] = "view/blog.php";
            $resultset = $blogModel->fetchAll();
            break;

        default:
            if (substr($route, 0, 5) === "blog/") {
                //  Matches blog/slug, display content by slug and type post
                $slug = substr($route, 5);
                $content =  $blogModel->fetchOne($slug);

                if (!$content) {
                    header("HTTP/1.0 404 Not Found");
                    $title = "404";
                    $view[] = "view/404.php";
                    break;
                }

                $title = $content->title;
                $content->data = $filter->parse($content->data, $content->filter);
                $view[] = "view/blogpost.php";
            } else {
                // Try matching content for type page and its path
                $content = $pageModel->fetchOne($route);

                if (!$content) {
                    header("HTTP/1.0 404 Not Found");
                    $title = "404";
                    $view[] = "view/404.php";
                    break;
                }

                $title = $content->title;
                $content->data = $filter->parse($content->data, $content->filter);
                $view[] = "view/page.php";
            }
    }

    $app->page->add("anax/content/index", [
        "resultset" => $resultset,
        "content" => $content ?? null,
        "view" => $view,
        "route" => $route,
        "filter" => $filter,
        "databaseConfig" => $databaseConfig,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
