<?php 

// Model that represents the lie in our appliation
//
class LieModel
{
    public $db;

    public function setDb($db)
    {
        $this->db = $db;
    }

    public function add(array $data = array())
    {
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
        $statement = $this->db->prepare($id);
        $statement->execute();

        return $statement->fetch();
    }
}
