<?php
require_once("src/connection.php");
session_start();

if(isset($_SESSION["user"]) == false){
    header("location: login.php");
}
$myUser = $_SESSION["user"];

if($_SERVER["REQUEST_METHOD"] === "POST" ){
    Tweet::createTweet($myUser->getId(),$_POST["tweet"]);
}
echo ("Witaj " . $myUser->getEmail());
?>
<form action="main.php" method="POST" >
    <input type="text" name="tweet" placeholder="dodaj tweet">
    <input type="submit" value="send">
</form>

<?php
echo "<a href='show_user.php?user_id={$myUser->getId()}'>User Profile</a><br>";
$allTweets = Tweet::loadAllTweets();
foreach ($allTweets as $tweet){
    echo "Tweet:<br>";
    echo "Text: {$tweet->getText()}<br>";
    echo "Creation Date: {$tweet->getCreationDate()}<br>";
    echo "<a href='show_tweet.php?tweet_id={$tweet->getId()}'>SHOW Tweet </a><br> ";
}

?>

