<?php 
include_once('../includes/config.php');
session_start();
class blogs extends DbConnection{ 
    public $title;
    public $description;
    public $main_image;
    public $userid;
    public function __construct(){
        parent::__construct();
        $this->id = '';
        $this->title = '';
        $this->description = '';
        $this->main_image = '';
        $this->userid = '';
    }
    public function setID($id){
        $this->id=$id;
    }
    public function setTitle($title){
        $this->title=$title;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setImage($photo){
        $this->main_image=$photo;
    }
    public function setuserID($userid){
        $this->userid=$userid;
    }
    public function blogInsert(){
        $sql="INSERT INTO `blog`(`title`, `main_image`, `description`, `userid`) VALUES ('$this->title','$this->main_image','$this->description','$this->userid')";
        $result = $this->connection->query($sql);
        return $result;
        
    }
   
    public function getallData(){
        $sql = "SELECT users.name, blog.title, blog.main_image, blog.id
        FROM blog
        INNER JOIN users
         ON blog.userid=users.id";
         $result = $this->connection->query($sql);
        
         return $result -> fetch_all(MYSQLI_ASSOC);
          
    }
    public function matchID($id){
        $sql = "SELECT users.name, blog.title, blog.main_image, blog.id, blog.description
        FROM blog
        INNER JOIN users
        ON (blog.userid=users.id)
          WHERE blog.id='$id'";
         $result = $this->connection->query($sql);
        
         return $result -> fetch_all(MYSQLI_ASSOC);
    }
    public function getallBlogs(){
        $sql = "SELECT users.name, blog.title, blog.id
        FROM blog
        INNER JOIN users
         ON blog.userid=users.id";
         $result = $this->connection->query($sql);
        
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
    public function getBlogDetails(){
        $sql = "SELECT * FROM blog";
        $result = $this->connection->query($sql);
        
        return $result -> fetch_all(MYSQLI_ASSOC);
    }
    public function blogDelete(){

        $blog = "DELETE FROM `blog` WHERE `id`='$this->id'";
        $result = $this->connection->query($blog);
        return $result;
    }
    public function editBlog(){
        $user = "UPDATE `blog` SET `title`='$this->title',
        `description`='$this->description' WHERE `id`='$this->id'";
        $result = $this->connection->query($user);
        return $result;
    }
    public function getUserBlogs($id){
        $sql = "SELECT users.name, blog.title, blog.id
        FROM blog
        INNER JOIN users
         ON (blog.userid=users.id)
          WHERE blog.userid='$id'";
         $result = $this->connection->query($sql);
        
        return $result -> fetch_all(MYSQLI_ASSOC);
    }

}