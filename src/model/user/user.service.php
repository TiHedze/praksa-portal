<?php
require_once __DIR__ . "/user.model.php";

class UserService
{
    private static $instance;
    private $db;

    private final function __construct($db)
    {
        $this->db = $db;
    }

    private final function __clone()
    {
    }

    public static function getInstance()
    {
        if (UserService::$instance == null) 
        {
            UserService::$instance = new UserService(DB::getInstance());
        }

        return UserService::$instance;
    }

    public function getUserByUsername($username)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE username=:username');
        $query->execute(array('username' => $username));

        $row = $query->fetch();

        if ($row === false) {
            return null;
        }

        return User::loginModel($row['id'], $row['name'], $row['lastname'], $row['username'], $row['password'], $row['role']);
    }

    public function createUser($user)
    {
        $query = $this->db->prepare('INSERT INTO users (name, lastname, username, password, role) VALUES(:name, :lastname, :username, :password, role=:role)');
        $query->execute(
            array(
                'name' => $user->name,
                'lastname' => $user->lastname,
                'username' => $user->username,
                'password' => $user->password_hash,
                'role' => $user->role
            )
        );

        return $query = $this->getUserByUsername($user->username);
    }

    public function add_profil_desc($age, $college, $grades, $email){
		$users= UserService::getUserByUsername($user);

		while( $row = $st->fetch() )
			$users[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']);

		foreach( $users as $user)
			if( $user->username == $_SESSION['username'])
				$value = $user->id;

		$st = $db->prepare( 'UPDATE users SET age = :age, college = :college, grades = :grades, email = :email WHERE id_user = :id_user' );
			$st->execute( array( 'id_product'=>$id_product,'id_user' => $value, 'rating' => $Ocjena, 'comment' => $Komentar) );
		return true;
	}

    public function getAllUsers( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, name, lastname, username, password, role  FROM users' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['name'], $row['lastname'], $row['username'], $row['password'], $row['role'] );
		}

		return $arr;
	}


}
