<?php

namespace H4MSK1\Content;

class Blog extends Content
{
    public function __construct()
    {
        parent::__construct('post');
    }

    public function fetchOne($value)
    {
        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE 
            slug = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
        ORDER BY published DESC
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
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE type=?
        ORDER BY published DESC
        ;
EOD;

        $db = $this->app->db->connect();
        return $db->executeFetchAll($sql, [$this->getType()]);
    }
}
