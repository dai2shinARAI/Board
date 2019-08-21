<?php

namespace MyApp\Controller;

class Create_Thread extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    // validate
    try {
      $this->_validate();
    } catch (\MyApp\Exception\InvalidTitle $e) {
      // echo $e->getMessage();
      // exit;
      $this->setErrors('title', $e->getMessage());
    } catch (\MyApp\Exception\InvalidContent $e) {
      // echo $e->getMessage();
      // exit;
      $this->setErrors('content', $e->getMessage());
    }

    // echo "success";
    // exit;
    $this->setValues('username', $_POST['createdby']);
    $this->setValues('title', $_POST['title']);
    $this->setValues('content', $_POST['content']);

    if($this->hasError()) {
      return;
    }else{
      // create user
      try {
        $threadModel = new \MyApp\Model\Thread();
        $threadModel->create([
          'createdby' => $_POST['createdby'],
          'title' => $_POST['title'],
          'content' => $_POST['content']
        ]);
      } catch (\MyApp\Exception\WriteError $e) {
        $this->setErrors('write', $e->getMessage());
        return;
      }
      // redirect to login
      header('Location:' . SITE_URL . '/index.php');
      exit;
    }


  }

  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      // echo "Invalid Token!";
      var_dump($_SESSION['token']);
      $a=$_POST['token'];
      var_dump($a);
      exit;
    }

    // if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['username'])) {
    //   throw new \MyApp\Exception\InvalidUsername();
    // }

    if (!filter_var($_POST['title'], FILTER_SANITIZE_STRING)) {
      throw new \MyApp\Exception\InvalidTitle();
    }

    if (!filter_var($_POST['content'], FILTER_SANITIZE_STRING)) {
      throw new \MyApp\Exception\InvalidContent();
    }
  }

}
