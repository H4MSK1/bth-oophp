<?php

namespace H4MSK1\Content;

use H4MSK1\Filter\TextFilter;
use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class Content implements AppInjectableInterface
{
    use AppInjectableTrait;

    protected $type;

    public function __construct($type = null)
    {
        $this->type = $type;
        $this->filter = new TextFilter();
    }

    public function insert($title)
    {
        $sql = "INSERT INTO content (title) VALUES (?);";
        $db = $this->app->db->connect();
        return $db->execute($sql, [$title]);
    }

    public function update($params)
    {
        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $db = $this->app->db->connect();
        return $db->execute($sql, array_values($params));
    }

    public function fetchOne($value)
    {
        return $this->findById($value);
    }

    public function getType()
    {
        return $this->type;
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM content;";
        $db = $this->app->db->connect();
        return $db->executeFetchAll($sql);
    }

    public function delete($id)
    {
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $db = $this->app->db->connect();
        return $db->execute($sql, [$id]);
    }

    public function findBy($column, $value)
    {
        $sql = "SELECT * FROM content WHERE {$column} = ?;";
        $db = $this->app->db->connect();
        return $db->executeFetch($sql, [$value]);
    }

    public function findById($value)
    {
        return $this->findBy('id', $value);
    }
}
