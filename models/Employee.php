<?php
class Employee
{
    // db connection
    private $conn;

    // employee properties
    public $id;
    public $name;
    public $email;
    public $skill;

    // constructor with $db arg as db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read all the data
    public function read()
    {
        // query the db and prepare statement
        $sql = 'SELECT * FROM tblemployee';
        $stmt = $this->conn->prepare($sql);

        // execute and return
        $stmt->execute();
        return $stmt;
    }

    // create a new record
    public function create()
    {
        // query the db and prepare statement
        $sql = 'INSERT INTO tblemployee(name, email, skill) VALUES(:name, :email, :skill)';
        $stmt = $this->conn->prepare($sql);

        // sanitize the data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->skill = htmlspecialchars(strip_tags($this->skill));

        // bind the data
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':skill', $this->skill);

        // execute and return
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // read all the data
    public function read_one()
    {
        // query the db and prepare
        $sql = 'SELECT * FROM tblemployee WHERE id=:id';
        $stmt = $this->conn->prepare($sql);

        // bind the id
        $stmt->bindValue(':id', $this->id);

        // execute
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'] ?? '';
        $this->email = $row['email'] ?? '';
        $this->skill = $row['skill'] ?? '';
    }

    // update the data
    public function update()
    {
        // query the db and prepare
        $sql = 'UPDATE tblemployee SET name=:name, email=:email, skill=:skill WHERE id=:id';
        $stmt = $this->conn->prepare($sql);

        // sanitize the data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->skill = htmlspecialchars(strip_tags($this->skill));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind the data
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':skill', $this->skill);
        $stmt->bindValue(':id', $this->id);

        // execute and return
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // delete a record
    public function delete()
    {
        // query the db and prepare
        $sql = 'DELETE FROM tblemployee WHERE id=:id';
        $stmt = $this->conn->prepare($sql);

        // sanitize the data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind the data
        $stmt->bindValue(':id', $this->id);

        // execute and return
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
