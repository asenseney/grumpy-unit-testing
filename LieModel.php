<?php

// Model that represents the lie in our appliation
//
class LieModel
{
    public $client;
    public $db;

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function setHttpClient($client)
    {
        $this->client = $client;
    }

    public function add(array $data = array())
    {
        $response = $this->client->post('http://84d29d0c8efe.rest.akismet.com/1.1/comment-check', [
            'body' => [
                'blog' => 'http://littlehart.net',
                'user_ip' => '127.0.0.1',
                'user_agent' => 'lynx',
                'comment_type' => 'forum-post',
                'comment_author' => 'viagara-test',
                'comment_content' => $data['contents'],
            ]
        ]);

        if ($body = trim($response->getBody()) !== 'true') {
            return false;
        }

        $sql = 'INSERT INTO lies (id, contents, entry_date) VALUES (?, ?, ?)';
        $statement = $this->db->prepare(
            $data['id'],
            $data['contents'],
            $data['entry_date']
        );
        $statement->execute();

        return ($statement->rowCount() === 1);
    }

    public function view($id)
    {
        if (! $id) {
            throw new InvalidArgumentException('Invalid lie id');
        }

        $sql = 'SELECT * FROM lies WHERE id = ?';
        $statement = $this->db->prepare($sql, $id);
        $statement->execute();

        return $statement->fetch();
    }
}
