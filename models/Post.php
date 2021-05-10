<?php

class Post
{
    // DB stuff
    private $connection;
    private $table = 'posts';

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    // Get Posts
    public function read()
    {
        // Create query
        $query = 'SELECT 
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
        FROM
            ' . $this->table . ' p
        LEFT JOIN
            categories c ON p.category_id = c.id
        ORDER BY
            p.created_at DESC';

        // Prepare statement
        $statement = $this->connection->prepare($query);

        // Execute
        $statement->execute();

        return $statement;
    }
}
