<?php

class Database 
{
	protected $chapterManager;
	protected $commentManager;

	private $db_host;
	private $db_name;
	private $db_user;
	private $db_pass;

	public function __construct() {
		$this->db_host = 'localhost';
		$this->db_name = 'blog_alaska';
		$this->db_user = 'root';
		$this->db_pass = '';
		$db = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8', $this->db_user, $this->db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$this->chapterManager = new ChapterManager($db);
		$this->commentManager = new CommentManager($db);
	}
}