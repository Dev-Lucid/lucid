{{nav1 nav1_main}}
{{nav2 nav2_database}}
## Querying

Idiorm/Paris are used to provide a basic ORM. Refer to their documentation for querying, but some examples are provided below


### Selecting a single row in order to print a column:

    # query we want to construct: select * from users where user_id=5;
    $user = lucid::model('users')->where('user_id', 5)->find_one();
    echo($user->first_name);


### Selecting many rows in order to print a column:
    # query we want to construct: select * from users where user_id > 10;
    $users = lucid::model('users')->where_gt('user_id', 10)->find_many();
    foreach ($users as $user) {
        echo($user->first_name . '<br />');
    }


### Updating a row
Technically this can be done in two ways using Idiorm: by selecting the row, changing the row's values, and calling the ->save method on the model; or by constructing a single query that directly updates the values without ever selecting the row. The first approach can be seen as more fault-tolerant, so it will be used for an example below. It does however perform one more query than the second approach, and if you are coding something that may require a very large number of updates, the second approach may be worth looking at.

	# Query1: select * from users where user_id=4;
	# Query2: update users set first_name='Alice' where user_id=4;
	
	$user = lucid::model('users')->where('user_id', 4)->find_one();
	if ($user === false) {
		throw new \Exception('Could not load user with user_id==4');
	}
	$user->first_name = 'Alice';
	$user->save();

### Inserting a row
	
    # Query we want to construct: insert into users (first_name) values ('Bob');
    $user = lucid::model('users')->create();
    $user->first_name 'Bob';
    $user->save();

### Deleting a row
Technically this can be done in two ways using Idiorm: by selecting the row and calling the model's ->delete() method, or by constructing a single query that directly deletes the row without ever selecting the row. The first approach can be seen as more fault-tolerant, so it will be used for an example below. It does however perform one more query than the second approach, and if you are coding something that may require a very large number of deletes, the second approach may be worth looking at.

    # delete from users where user_id=4;
	$user = lucid::model('users')->find_one(4);
	$user->delete();