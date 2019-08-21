<?php

namespace MyApp\Controller;

class Thread extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }


    $userModel = new \MyApp\Model\User();
    $this->setValues('users', $userModel->findAll());

    //get threds info
    // $threadModel = new \MyApp\Model\Thread();
    // $threads = $threadModel->getTHREAD_list();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

      protected function postProcess() {
        // try {
        //   $this->_validate();
        // } catch (\MyApp\Exception\InvalidTitle $e) {
        //   $this->setErrors('title', $e->getMessage());
        // } catch (\MyApp\Exception\InvalidContent $e) {
        //   $this->setErrors('content', $e->getMessage());
        // }

        $this->setValues('username', $_POST['createdby']);
        $this->setValues('title', $_POST['title']);
        $this->setValues('content', $_POST['content']);


        if($this->hasError()) {
          return;
        }else{
          // create user
          try {
            $threadModel = new \MyApp\Model\Thread();
            $threadModel->write([
              'writer' => $_POST['writer'],
              'threadid' => $_POST['threadid'],
              'content' => $_POST['content'],
              'commentid' => $_POST['newResNum']
            ]);
          } catch (\MyApp\Exception\WriteError $e) {
            $this->setErrors('write', $e->getMessage());
            return;
          }
          // redirect to login
          header('Location:' . SITE_URL . '/thread.php?threadid='. $_POST['threadid']);
          exit;
        }


      }

      // private function _validate() {
      //   if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      //     // echo "Invalid Token!";
      //     var_dump($_SESSION['token']);
      //     $a=$_POST['token'];
      //     var_dump($a);
      //     exit;
      //   }
      //
      //   if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['username'])) {
      //     throw new \MyApp\Exception\InvalidUsername();
      //   }
      //
      //   if (!filter_var($_POST['title'], FILTER_SANITIZE_STRING)) {
      //     throw new \MyApp\Exception\InvalidTitle();
      //   }
      //
      //   if (!filter_var($_POST['content'], FILTER_SANITIZE_STRING)) {
      //     throw new \MyApp\Exception\InvalidContent();
      //   }
      // }
  }
