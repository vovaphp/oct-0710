<?php

namespace models;

class ArticleModel
{
    /**
     * @var string table name
     */
    protected $table = 'articles';
    /**
     * @var \mysqli
     */
    protected $db;

    /**
     * Article doc constructor
     */
    public function __construct()
    {
        $this->db = new \mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if($this->db->connect_error !=0){
            die($this->db->connect_error);//TODO добавить исключение
        }
    }

    /**
     * add new article in storage
     * @param array $article associated arrey off article params
     * @return bool
     */
    public function add(array $article){
        $sql = "INSERT INTO {$this->table} (title, text) VALUES ('{$article['title']}', '{$article['text']}')";
        return $this->db->query($sql);
    }


}

