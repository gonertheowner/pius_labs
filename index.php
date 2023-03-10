<?php

require 'vendor/autoload.php';

use App\User;
use App\Comment;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Validation;

// Task_1
echo 'Task_1<br/>';

$validator = Validation::createValidator();
$violations = [];

$users[] = new User(1, "User1", "example1@gmail.com", "password1");
$users[] = new User(2, "User2", "example2@gmail.com", "password2");
$users[] = new User(3, "User3", "example3@gmail.com", "password3");
$users[] = new User(4, "User4", "example4@gmail.com", "password4");
$users[] = new User(5, "User5", "example5@gmail.com", "password5");

foreach($users as $user) {
	echo 'ID_' . $user->id . ' : name_' . $user->name . '<br/>';

	$violations[] = $validator->validate($user->id, [
		new Positive(),
	]);

	$violations[] = $validator->validate($user->name, [
		new NotBlank(),
		new NotNull(),
		new Length(['min' => 4, 'max' => 32])
	]);

	$violations[] = $validator->validate($user->password, [
		new NotBlank(),
		new NotNull(),
		new Length(['min' => 8, 'max' => 32])
	]);
}

if (0 !== count($violations)) {
    foreach ($violations as $items) {
		foreach($items as $violation) {
			echo $violation->getMessage() . '<br/>';
		}
    }
}

// Task_2
$messages[] = "message 1";
$messages[] = "message 2";
$messages[] = "message 3";
$messages[] = "message 4";
$messages[] = "message 5";

$comments = [];
for($i = 0; $i < count($messages); $i++) {
	$comments[] = new Comment($users[$i], $messages[$i]);
}

$datetime = new DateTime('2022-04-01 01:01:01');
foreach($comments as $comment) {
	if($comment->user->createdOn > $datetime) {
		echo $user->getCreatedOn() . '<br/>';
	}
}