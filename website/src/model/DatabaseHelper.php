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
        $query = "SELECT p.postId, p.title, p.postImage, p.longdescription, p.postDate, p.upvote, p.downvote, u.username, u.avatar, g.name, g.avatar as groupAvatar
              FROM POSTS p 
              JOIN USERS u ON p.userId = u.userid 
              JOIN GROUPS g ON p.groupId = g.groupId 
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

    //LIKE/DISLIKE//
    public function toggleVote($postId, $userId, $isUpvote) {
        $query = "SELECT is_upvote FROM LIKES WHERE postId = ? AND userId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $postId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $delQuery = "DELETE FROM LIKES WHERE postId = ? AND userId = ?";
            $delStmt = $this->db->prepare($delQuery);
            $delStmt->bind_param('ii', $postId, $userId);
            $delStmt->execute();
            $colonna = $row['is_upvote'] ? 'upvote' : 'downvote';
            $updateQuery = "UPDATE POSTS SET $colonna = $colonna - 1 WHERE postId = ?";
            $upStmt = $this->db->prepare($updateQuery);
            $upStmt->bind_param('i', $postId);
            $upStmt->execute();
            return ["status" => "removed", "type" => $colonna];
        } else {
            $insQuery = "INSERT INTO LIKES (postId, userId, is_upvote) VALUES (?, ?, ?)";
            $val = $isUpvote ? 1 : 0;
            $insStmt = $this->db->prepare($insQuery);
            $insStmt->bind_param('iii', $postId, $userId, $val);
            $insStmt->execute();
            $colonna = $isUpvote ? 'upvote' : 'downvote';
            $updateQuery = "UPDATE POSTS SET $colonna = $colonna + 1 WHERE postId = ?";
            $upStmt = $this->db->prepare($updateQuery);
            $upStmt->bind_param('i', $postId);
            $upStmt->execute();
            return ["status" => "added", "type" => $colonna];
        }
    }

    //REPORT//
    public function reportPost($postId) {
        $query = "UPDATE POSTS SET reportCount = reportCount + 1 WHERE postId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postId);
        return $stmt->execute();
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

    //FORUM//

    public function getGroupById($groupId){
        $query = "SELECT g.*, COUNT(p.userId) AS memberCount FROM GROUPS g LEFT JOIN PARTICIPANT p ON g.groupId = p.groupId WHERE g.groupId = ? GROUP BY g.groupId ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getPostsByGroupId($groupId){
        $query = "SELECT P.postId, P.title, P.longdescription, P.upvote, P.downvote, P.postDate, P.postImage, P.reportCount, U.userId, U.username, U.avatar FROM POSTS AS P JOIN USERS AS U ON P.userId = U.userId WHERE P.groupId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}