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
        $result = $this->db->prepare(
            $data['id'],
            $data['contents'],
            $data['entry_date']
        );
        $result->execute();

        return ($result->rowCount() === 1);
    }
}
