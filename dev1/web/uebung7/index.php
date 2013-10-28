<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Uebung 7 - Pattern">
 	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <title>Uebung 7 Patterns </title>
  </head>

  <body>
	<?php
		require 'logic/posttablegateway.php';
		require 'logic/post.php';

		echo '<h3>Tests with TableGateway</h3>';

		# create new post entries with table gateway,
		$tableGateway = new PostTableGateway;

		# clear all rows first
		foreach ($tableGateway->findAll() as $post) {
			$tableGateway->delete($post);
		}

		$entry1 = new Post;
		$entry1->setCreated("2013-10-24");
		$entry1->setTitle("Entry 1 created with table gateway.");
		$entry1->setContent("Some content of entry 1.");

		$entry2 = new Post;
		$entry2->setCreated("2013-10-24");
		$entry2->setTitle("Entry 2 created with table gateway.");
		$entry2->setContent("Some content of entry 2.");

		$entry3 = new Post;
		$entry3->setCreated("2013-10-25");
		$entry3->setTitle("Entry 3 created with table gateway.");
		$entry3->setContent("Some content of entry 3.");

		$tableGateway->create($entry1);
		$tableGateway->create($entry2);
		$tableGateway->create($entry3);

		# print all rows
		echo '<p>Current entries in database: </p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		foreach ($tableGateway->findAll() as $post) {
			echo '<tr>';
			echo '<td>'.$post->getCreated().'</td>';
			echo '<td>'.$post->getTitle().'</td>';
			echo '<td>'.$post->getContent().'</td>';
			echo '</tr>';
		}
		echo '</table>';

		# get by attribute
		echo '<p>Current entries in database with attribute created = 24.10.2013: </p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		foreach ($tableGateway->findByAttribute('created', '2013-10-24') as $post) {
			echo '<tr>';
			echo '<td>'.$post->getCreated().'</td>';
			echo '<td>'.$post->getTitle().'</td>';
			echo '<td>'.$post->getContent().'</td>';
			echo '</tr>';
		}
		echo '</table>';

		# get by id
		echo '<p>Current entry in database with id = '.$entry2->getId().'</p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		$post = $tableGateway->findById($entry2->getId());
		echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
		echo '</table>';

		# update found entry
		echo '<p>Updating entry with id = '.$post->getId().'</p>';
		$post->setContent("I'm the new updated content.");
		$tableGateway->update($post);

		# get by id
		echo '<p>Current entry in database with id = '.$post->getId().'</p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		$post = $tableGateway->findById($post->getId());
		echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
		echo '</table>';
		echo '<h3>Tests with RowGateway</h3>';

		$entry1 = new Post;
		$entry1->setCreated("2013-10-24");
		$entry1->setTitle("Entry 1 created with row gateway.");
		$entry1->setContent("Some content of entry 1.");

		$entry2 = new Post;
		$entry2->setCreated("2013-10-24");
		$entry2->setTitle("Entry 2 created with row gateway.");
		$entry2->setContent("Some content of entry 2.");

		$entry3 = new Post;
		$entry3->setCreated("2013-10-25");
		$entry3->setTitle("Entry 3 created with row gateway.");
		$entry3->setContent("Some content of entry 3.");

		$entry1->create();
		$entry2->create();
		$entry3->create();

		# print all rows
		echo '<p>Current entries in database: </p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		foreach ($tableGateway->findAll() as $post) {
		echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
		}
		echo '</table>';

		# get by id
		echo '<p>Current entry in database with id = '.$entry2->getId().'</p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		$post = new Post;
		$post->findById($entry2->getId());
		echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
		echo '</table>';

		# update found entry
		echo '<p>Updating entry with id = '.$post->getId().'</p>';
		$post->setContent("I'm the new updated content.");
		$post->update();

		# get by id
		echo '<p>Current entry in database with id = '.$entry2->getId().'</p>';
		echo '<table class="table">';
		echo '<tr><th>Created</th><th>Title</th><th>Content</th></tr>';
		$post = new Post;
		$post->findById($entry2->getId());
		echo '<tr>';
		echo '<td>'.$post->getCreated().'</td>';
		echo '<td>'.$post->getTitle().'</td>';
		echo '<td>'.$post->getContent().'</td>';
		echo '</tr>';
		echo '</table>';

		# delete all rows
		foreach ($tableGateway->findAll() as $post) {
			$post->delete();
		}
	?>
  </body>
</html>

