<?php


class DatabaseHelper {
    private static $instance = null;
    private $db;

    // Il costruttore non ha bisogno di parametri se li prende direttamente da Settings
    private function __construct()
    {
        // Importante: Assicurati che Settings sia già stata inclusa!
        $this->db = new mysqli(
            Settings::DB_SERVERNAME,
            Settings::DB_USERNAME,
            Settings::DB_PASSWORD,
            Settings::DB_DBNAME,
            Settings::DB_PORT
        );
        
        // Gestione degli errori tramite eccezione (molto meglio di die())
        if ($this->db->connect_error) {
            die("Connection Failed : " .$this->db->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            // Istanzia la classe senza passare parametri al costruttore
            self::$instance = new self(); 
        }
        return self::$instance;
    }
    
    public function getConnection(): mysqli
    {
        return $this->db;
    }
    public function getTopPosts($limit){
        $query = "SELECT p.postId, p.title, p.postImage, p.upvote, g.groupId, g.name, g.avatar 
                  FROM POSTS p, GROUPS g 
                  WHERE p.groupId = g.groupId 
                  ORDER BY p.upvote DESC 
                  LIMIT ?";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPosts($limit){
        $query = "SELECT p.postId, p.title, p.postImage, p.longdescription, p.postDate, 
                         g.groupId, g.name, g.avatar
                  FROM POSTS p, GROUPS g
                  WHERE p.groupId = g.groupId
                  ORDER BY p.postDate DESC
                  LIMIT ?";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
}

    //LOGIN//

    public function checkLogin($username,$password){
        $query = "SELECT userid, username, password, typology, avatar FROM USERS WHERE username=? AND password=?"; 
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    //USER//

    public function getUserByUserId($userid){
        $query = "SELECT username, avatar, description FROM USERS WHERE userid=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getPostsByUserId($userid){
        $query = "SELECT p.postId, p.title, p.postImage, p.longdescription, p.postDate,g.groupId, g.name, g.avatar FROM POSTS p JOIN GROUPS g ON p.groupId = g.groupId WHERE p.userId = ? ORDER BY p.postDate DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$userid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}