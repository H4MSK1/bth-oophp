<?php

namespace H4MSK1\Content;

class Page extends Content
{
    public function __construct()
    {
        parent::__construct('page');
    }

    public function fetchOne($value)
    {
        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
        FROM content
        WHERE
            path = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
        ;
EOD;

        $db = $this->app->db->connect();
        return $db->executeFetch($sql, [$value, $this->getType()]);
    }

    public function fetchAll()
    {
        $sql = <<<EOD
            SELECT
            *,
            CASE 
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
                ELSE "notPublished"
            END AS status
        FROM content
        WHERE type=?
        ;
EOD;

        $db = $this->app->db->connect();
        return $db->executeFetchAll($sql, [$this->getType()]);
    }
}
