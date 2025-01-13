<?php


class Notification
{

    public function __construct(
        public string $message
    ) {}

    public function send()
    {
        echo 'Notification Send Message is '. $this->message . '<br>';
    }
}

class EmailNotification extends Notification
{

    public function send()
    {
        echo 'Email Notification Send is '. $this->message . '<br>';
    }
}

class OSNotification extends Notification
{
    public function send()
    {
        echo 'Fire up the OS Notification is ' . $this->message . '<br>';
    }
}

//Notification class
// $notification = new Notification('hello world');
// $notification->send();


//Email class
// $emailNotify = new EmailNotification('hello from india');
// $emailNotify->send();

//OS Class
// $OsNotify = new OSNotification('hello from kerala');
// $OsNotify->send();


//second class

class User {
    public string $name;
    public int $postsCount;
    public int $commentsCount;

    public function __construct(string $name, int $postsCount, int $commentsCount) {
        $this->name = $name;
        $this->postsCount = $postsCount;
        $this->commentsCount = $commentsCount;
    }

    public function posts() {
        return $this->postsCount;
    }

    public function comments() {
        return $this->commentsCount;
    }
}

abstract class Achievement
{
    public function __construct(
        public string $name,
        public string $description,
        public string $icon
    ) {
        //
    }

    abstract public function qualifier(User $user): bool;
}

class FirstPostAchievement extends Achievement
{
    public function qualifier(User $user): bool
    {
        return $user->posts() >= 1;
    }
}

class TalkativeAchievement extends Achievement
{
    public function qualifier(User $user): bool
    {
        return $user->comments() >= 200;
    }
}

// Sample Data for Users
$user1 = new User('Alice', 0, 200); // 0 post, 200 comments
$user2 = new User('Bob', 10, 250); // 10 posts, 250 comments

// Achievements
$firstPost = new FirstPostAchievement('First Post', 'Granted when you create your first post.', 'first-post.svg');
$talkative = new TalkativeAchievement('Talkative', 'Granted when you make 200 comments.', 'talkative.svg');

// Check Achievements for each user
function checkAchievement(Achievement $achievement, User $user) {
    if ($achievement->qualifier($user)) {
        echo "{$user->name} has earned the '{$achievement->name}' achievement! \n";
    } else {
        echo "{$user->name} has not earned the '{$achievement->name}' achievement. \n";
    }
}

checkAchievement($firstPost, $user1);  // Alice should earn First Post
checkAchievement($talkative, $user1);  // Alice should not earn Talkative

checkAchievement($firstPost, $user2);  // Bob should earn First Post
checkAchievement($talkative, $user2);  // Bob should earn Talkative
