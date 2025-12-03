<?php
class DatabaseHelper {
    private static $instance = null;
    private $db;

    // Il costruttore non ha bisogno di parametri se li prende direttamente da Settings
    private function __construct()
    {
        $this->db = new mysqli(
            Settings::DB_SERVERNAME,
            Settings::DB_USERNAME,
            Settings::DB_PASSWORD,
            Settings::DB_DBNAME,
            Settings::DB_PORT
        );
        
        if ($this->db->connect_error) {
            die("Connection Failed : " .$this->db->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(); 
        }
        return self::$instance;
    }
    
    public function getConnection(): mysqli
    {
        return $this->db;
    }
    public function getTopPosts($n){
        $query = "SELECT p.postId, p.groupId, p.title, p.postImage, p.longdescription, p.postDate, 
            u.username, u.avatar as userIcon,
            g.name, g.avatar as groupIcon
            FROM POSTS p
            JOIN USERS u ON p.userId = u.userid
            JOIN GROUPS g ON p.groupId = g.groupId
            ORDER BY (p.upvote - p.downvote) DESC
            LIMIT ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getPosts($n, $userId){
        $query = "SELECT p.postId, p.groupId, p.title, p.postImage, p.longdescription, p.postDate, 
                     p.upvote, p.downvote,
                     u.username, u.avatar as userIcon, 
                     g.name as groupName, g.avatar as groupIcon,
                     l.is_upvote as userVote
              FROM POSTS p 
              JOIN USERS u ON p.userId = u.userid 
              JOIN GROUPS g ON p.groupId = g.groupId 
              LEFT JOIN LIKES l ON p.postId = l.postId AND l.userId = ? 
              ORDER BY p.postDate DESC 
              LIMIT ?";
    
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $userId, $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //LOGIN//

    public function checkLogin($username,$password){
        $query = "SELECT userid, username, password,email, typology, avatar FROM USERS WHERE username=? AND password=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    //SIGN UP UTILITIES//
    
    public function isUserAvailable($username, $email){
        $query = "SELECT username, email FROM USERS WHERE username = ? OR email = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss",$username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows === 0;
    }

    public function addUser($username,$email,$password,$gender,$avatar,$description, $typology = "user"){
        $query = "INSERT INTO USERS(username, email, password,description, avatar, gender , typology) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt) {
            error_log("Prepare failed: (" . $this->db->errno . ") " . $this->db->error);
            return false;
        }
    
        $stmt->bind_param("sssssss", $username, $email, $password,$description,$avatar, $gender, $typology);
    
        if (!$stmt->execute()) {
            error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            $stmt->close();
            return false;
        }
        $stmt->close();
        return true;
    }

    public function getGender(){
        $query = "SELECT DISTINCT gender FROM USERS";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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
            $currentVote = (int)$row['is_upvote'];
            $newVote = $isUpvote ? 1 : 0;
            if ($currentVote === $newVote) {
                $delQuery = "DELETE FROM LIKES WHERE postId = ? AND userId = ?";
                $delStmt = $this->db->prepare($delQuery);
                $delStmt->bind_param('ii', $postId, $userId);
                $delStmt->execute();
                $colonna = $isUpvote ? 'upvote' : 'downvote';
                $this->db->query("UPDATE POSTS SET $colonna = GREATEST(0, $colonna - 1) WHERE postId = $postId");
            
                return ["status" => "removed", "type" => $colonna];
            } else {
                $upQuery = "UPDATE LIKES SET is_upvote = ? WHERE postId = ? AND userId = ?";
                $upStmt = $this->db->prepare($upQuery);
                $upStmt->bind_param('iii', $newVote, $postId, $userId);
                $upStmt->execute();
                if ($isUpvote) {
                    $this->db->query("UPDATE POSTS SET upvote = upvote + 1, downvote = GREATEST(0, downvote - 1) WHERE postId = $postId");
                    return ["status" => "swapped", "type" => "upvote"];
                } else {
                    $this->db->query("UPDATE POSTS SET downvote = downvote + 1, upvote = GREATEST(0, upvote - 1) WHERE postId = $postId");
                    return ["status" => "swapped", "type" => "downvote"];
                }
            }
        } else {
            $insQuery = "INSERT INTO LIKES (postId, userId, is_upvote) VALUES (?, ?, ?)";
            $val = $isUpvote ? 1 : 0;
            $insStmt = $this->db->prepare($insQuery);
            $insStmt->bind_param('iii', $postId, $userId, $val);
            $insStmt->execute();
            $colonna = $isUpvote ? 'upvote' : 'downvote';
            $this->db->query("UPDATE POSTS SET $colonna = $colonna + 1 WHERE postId = $postId");
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

    public function getPostsByUserId($targetUserId, $viewerId){
        $query = "SELECT p.postId, p.title, p.postImage, p.longdescription, p.postDate, p.upvote, p.downvote, p.groupId,u.userId, u.username, u.avatar, g.name as groupName, g.avatar as groupIcon,l.is_upvote as userVote  
                  FROM POSTS p
                  JOIN USERS u ON p.userId = u.userid
                  JOIN GROUPS g ON p.groupId = g.groupId
                  LEFT JOIN LIKES l ON p.postId = l.postId AND l.userId = ?
                  WHERE p.userId = ?
                  ORDER BY p.postDate DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $viewerId, $targetUserId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //FORUM - USER JOIN/LEFT/CHECK //

    public function joinUserGroup($userId, $groupId){
        $query = "INSERT INTO PARTICIPANT (userId, groupId, subscriptionDate) VALUES ( ? , ? , NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $userId, $groupId);
        $stmt->execute();
    }

    public function leaveGroup($userId, $groupId){
        $query = "DELETE FROM PARTICIPANT WHERE userId = ? AND groupId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $userId, $groupId);
        $stmt->execute();
    }

    public function isUserFollowingGroup($userId, $groupId){
        $query = "SELECT userId, groupId FROM PARTICIPANT WHERE userId = ? AND groupId = ?";
        $stmt = $this->db->prepare($query);
        $stmt -> bind_param("ii" , $userId , $groupId);
        $stmt->execute();
        $result = $stmt -> get_result();
        if ($result -> num_rows > 0){
            return true;
        }
        return false;
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
    
    public function getPostsByGroupId($groupId, $userId){
        $query = "SELECT P.postId, P.title, P.longdescription, P.upvote, P.downvote, P.postDate, P.postImage, P.reportCount, U.userId, U.username, U.avatar, L.is_upvote as userVote FROM POSTS AS P JOIN USERS AS U ON P.userId = U.userId LEFT JOIN LIKES AS L ON P.postId = L.postId AND L.userId = ? WHERE P.groupId = ? ORDER BY P.postDate DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $userId, $groupId); 
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //ADMIN UTILITIES//

    public function getAllForums(){
        $query = "SELECT groupId, name, avatar FROM GROUPS ORDER BY name DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUsers(){
        $query = "SELECT userId, username, avatar FROM USERS ORDER BY username DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReportedPosts(){
        $query = "SELECT p.postId, p.title, p.postImage, p.longdescription, p.postDate, p.reportCount, g.groupId, g.name, g.avatar  FROM POSTS p JOIN GROUPS g ON g.groupId = p.groupId WHERE p.reportCount >= 1 ORDER BY p.reportCount DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function dismissReport($postId) {
        $query = "UPDATE POSTS SET reportCount = 0 WHERE postId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postId);
        return $stmt->execute();
    }

    public function deletePost($postId) {
        $query = "DELETE FROM POSTS WHERE postId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postId);
        return $stmt->execute();
    }

    public function deleteForum($groupId) {
        $query = "DELETE FROM GROUPS WHERE groupId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $groupId); 
        return $stmt->execute();
    }

    public function deleteUser($userId) {
        $query = "DELETE FROM USERS WHERE userId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $userId);
        return $stmt->execute();
    }

    //COMMENT//
    public function getPostById($postId, $viewerId){
        $query = "SELECT p.postId, p.title, p.longdescription, p.upvote, p.downvote, 
                         p.postDate, p.postImage, p.groupId,
                         u.userId, u.username, u.avatar, 
                         g.name as groupName, g.avatar as groupIcon,
                         l.is_upvote as userVote  
                  FROM POSTS p 
                  JOIN USERS u ON p.userId = u.userid 
                  JOIN GROUPS g ON p.groupId = g.groupId 
                  LEFT JOIN LIKES l ON p.postId = l.postId AND l.userId = ? 
                  WHERE p.postId = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $viewerId, $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertComment($postId, $userId, $text){
        $query = "INSERT INTO COMMENTS (longdescription, userId, postId) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sii", $text, $userId, $postId);

        return $stmt->execute();
    }

    public function getCommentsByPostId($postId){
        $query = "SELECT c.commentId , c.longdescription, u.userId, u.username, u.avatar FROM COMMENTS c JOIN POSTS p ON c.postId = p.postId JOIN USERS u ON c.userId = u.userId WHERE c.postId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //SEARCH-BAR//
    public function getLiveSearch($element){
    $wildCard = "%" .$element ."%";
    
    // CORREZIONE: Aggiunti gli alias e i campi necessari per il JSON
    $query = "SELECT
                groupId AS id,         /* Il JS si aspetta 'id' */
                name,
                avatar AS avatar_url,  /* Il JS si aspetta 'avatar_url' */
                'group' AS type        /* Il JS si aspetta 'type' con valore 'group' */
              FROM GROUPS
              WHERE name LIKE ?
              LIMIT 5";

    $stmt = $this->db->prepare($query);

    // Bind del parametro
    $stmt->bind_param("s", $wildCard);
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    // Restituisce un array associativo con i campi richiesti
    return $result->fetch_all(MYSQLI_ASSOC);
    }

    //UPLOAD POST//
    public function uploadPost($userId, $groupId, $title, $longdescription, $postImage){
        $query = "INSERT INTO POSTS (title, longdescription, postImage, groupId, userId) VALUES (? , ? , ? , ? , ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssii" , $title, $longdescription, $postImage, $groupId, $userId);
        $stmt->execute();
    }

}