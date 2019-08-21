<?php

namespace MyApp\Model;

class Thread extends \MyApp\Model {

  public function create($values) {
    $stmt1 = $this->db->prepare("insert into thread_list (createdby, title, created, modified) values (:createdby, :title, now(), now())");
    $res1 = $stmt1->execute([
      ':createdby' => $values['createdby'],
      ':title' => $values['title']
    ]);

    $stmt2 = $this->db->prepare("SELECT MAX(id) FROM thread_list ");
    $stmt2->execute();
    $result = $stmt2->fetch(\PDO::FETCH_ASSOC);
    $values['threadid'] = $result['MAX(id)'];


    $stmt3 = $this->db->prepare("INSERT INTO comments (writer, content, created,threadid, commentid) VALUES (:writer, :content, now(), :threadid, :commentid)");
    $res3 = $stmt3->execute([
      ':writer' => $values['createdby'],
      ':content' => $values['content'],
      'threadid' => $values['threadid'],
      ':commentid' => '1'
    ]);


    if ($res1 === false) {
      throw new \MyApp\Exception\WriteError();
    }
    // if ($res2 === false) {
    //   throw new \MyApp\Exception\WriteError();
    // }
    if ($res3 === false) {
      throw new \MyApp\Exception\WriteError();
    }
  }


  public function write($values) {
    $stmt = $this->db->prepare("INSERT INTO comments (writer, content, threadid, commentid, created) VALUES (:writer, :content, :threadid, :commentid, now())");
    $res = $stmt->execute([
      ':writer' => $values['writer'],
      ':content' => $values['content'],
      ':threadid' => $values['threadid'],
      ':commentid' => $values['commentid']
    ]);
    if ($res === false) {
      throw new \MyApp\Exception\WriteError();
    }
  }

  public function getTHREAD_list() {
    $stmt = $this->db->prepare("SELECT * FROM thread_list ORDER BY id");
    $stmt->execute();
    $result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function getTHREAD_title($threadid) {
    $stmt = $this->db->prepare("SELECT title FROM thread_list WHERE id = {$threadid} ");
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result['title'];
  }

  public function getRes($threadid) {
    $stmt = $this->db->prepare("SELECT * FROM comments WHERE threadid = {$threadid} ORDER BY id");
    $stmt->execute();
    $result = $stmt->fetchALL(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function getResnum($threadid) {
    $stmt = $this->db->prepare("SELECT MAX(commentid) FROM comments WHERE threadid = {$threadid} ");
    $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result['MAX(commentid)'];
  }






  // public function login($values) {
  //   $stmt = $this->db->prepare("select * from users where email = :email");
  //   $res = $stmt->execute([
  //     ':email' => $values['email']
  //   ]);
  //   $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  //   $user = $stmt->fetch();
  //
  //   if (empty($user)) {
  //     throw new \MyApp\Exception\UnmatchEmailOrPassword();
  //   }
  //
  //   if (!password_verify($values['password'], $user->password)) {
  //     throw new \MyApp\Exception\UnmatchEmailOrPassword();
  //   }
  //
  //   return $user;
  // }


//for getting thread info
  public function findAll() {
    $stmt = $this->db->query("select * from thread_list order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
