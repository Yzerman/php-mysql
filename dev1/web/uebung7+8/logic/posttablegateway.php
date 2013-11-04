<?php

require 'php/db_config.php';

class PostTableGateway {

    public function findByID($id) {
    	$sql = "SELECT * FROM tbl_person WHERE id = :id";
    	$fieldValueMapping = array(':id'=>$id);

    	$pquery = prepareSql($sql);
    	$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
    	$pquery = executeSql($pquery, $fieldValueMapping);

    	return $pquery->fetch();
    }

    public function findByAttribute($attribute, $value) {
    	$sql = "SELECT * FROM tbl_person WHERE $attribute = :$attribute";
    	$fieldValueMapping = array(":$attribute"=>$value);

    	$pquery = prepareSql($sql);
    	$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
    	$pquery = executeSql($pquery, $fieldValueMapping);

    	return $pquery->fetchAll();
    }

    public function findAll() {
    	$sql = "SELECT * FROM tbl_person";

    	$pquery = prepareSql($sql);
    	$pquery->setFetchMode(PDO::FETCH_CLASS, 'Post');
    	$pquery = executeSql($pquery, array());

    	return $pquery->fetchAll();
    }


    private function checkCounter($entry)
    {

        $sql = "SELECT counter FROM tbl_person WHERE id=:id; UPDATE tbl_person SET counter = counter + 1 WHERE id=:id;";
        $fieldValueMapping = array(':id'=>$entry->getId());
        $pquery = prepareSql($sql);
        $pquery = executeSql($pquery, $fieldValueMapping);
        $counter = $pquery->fetch();

        return $counter[0] + 1;
    }

    public function create($entry) {
    	$sql = "INSERT INTO tbl_person (created, title, content, counter) VALUES (:created, :title, :content, :counter)";
    	$fieldValueMapping = array(':created'=>$entry->getCreated(),':title'=>$entry->getTitle(), ':content'=>$entry->getContent(), ':counter'=>0);

        if (DEBUGGING == true) {
            echo var_dump($fieldValueMapping);
        }
    
    	$pquery = prepareSql($sql);
    	$pquery = executeSql($pquery, $fieldValueMapping);
    	$entry->setId(getDb()->lastInsertId());
    	return $entry;
    }

    public function update($entry) {
        try {
                $counter = $this->checkCounter($entry);
                $sql = "UPDATE tbl_person SET created = :created, title = :title, content = :content WHERE id = :id and counter=:counter";
                $fieldValueMapping = array(':created'=>$entry->getCreated(),':title'=>$entry->getTitle(), ':content'=>$entry->getContent(), ':id'=>$entry->getId(),':counter'=>$counter);

                $pquery = prepareSql($sql);
                $pquery = executeSql($pquery, $fieldValueMapping);
                return $entry;

        }
        catch (PDOException $e) {

                        die("Update Failed: " . $e -> getMessage() . "<br/>");

                }

    }

    public function delete($entry) {

        try {
                $counter = $this->checkCounter($entry);
                $sql = "DELETE FROM tbl_person  WHERE id=:id AND counter=:counter";
                $fieldValueMapping = array(':id'=>$entry->getId(),':counter'=>$counter);

                $pquery = prepareSql($sql);
                $pquery = executeSql($pquery, $fieldValueMapping);

        }
        catch (PDOException $e) {

                        die("Delete Failed: " . $e -> getMessage() . "<br/>");

                }

    }


}

?>
