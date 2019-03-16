<?php

require_once "model/model.php";

Class Admin extends Model 

{

	// Recuperation infos compte
	public function getAccountInfo($username)
	{
		$sql = "SELECT * FROM members WHERE name = ?";
		$admin = $this->executerRequete($sql, array($username));
		return $admin->fetch();
	}
	
	// Liste commentaires signalés
	public function getSignCom()
	{
		$sql = "SELECT * FROM `comments` WHERE COM_SIGNALER = 1 AND COM_MODERE = 0";
		$signCom = $this->executerRequete($sql);
		return $signCom;
	}
	
	public function getLogs()
	{
		$sql = "SELECT log_id as log_id, com_id as id, com_date AS date_fr, com_author AS author, com_content AS content, post_id AS post_id, log_date AS log_date FROM logs ORDER BY log_id DESC";
		$logs = $this->executerRequete($sql);
		return $logs->fetchAll();
	}
	
	// Nombre commentaire à moderer
	public function countSignCom()
	{
		$sql = "select count(*) as nbsigncoms from comments where COM_SIGNALER = 1 AND COM_MODERE = 0";
		$commentSignNumber = $this->executerRequete($sql);
	return $commentSignNumber->fetch();
	}
	
	// Modérer commentaire signalés
	public function modSignCom($contenus, $idCommentaire)
	{
		$sql = 'UPDATE comments SET COM_MODERE = 1, COM_CONTENU = ? WHERE COM_ID = ?';
		$this->executerRequete($sql, array($contenus, $idCommentaire));
	}

	// Supprimer commentaire signalé 
	public function suppressCom($idCommentaire){
		$sql = "DELETE FROM comments WHERE COM_ID = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Insertion logs moderation
	public function insertLogs($idCommentaire){
		$sql ="INSERT INTO logs(com_id, com_date, com_author, com_content, post_id) 
				SELECT com_id, com_date, com_auteur, com_contenu, bil_id FROM comments WHERE com_id = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Insertion type Supprimé log Modération
	public function insertLogsSupp($idCommentaire){
		$sql ="UPDATE logs SET type = 'deleted' WHERE com_id = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Insertion type Modifié log Modération
	public function insertLogsMod($idCommentaire){
		$sql ="UPDATE logs SET type = 'modified' WHERE com_id = ?";
		$this->executerRequete($sql, array($idCommentaire));
	}
	
	// Creation Billet
	public function create($titre, $content)
	{
		$sql = "INSERT INTO posts(BIL_DATE, BIL_TITRE, BIL_CONTENU) VALUES(NOW(), ?, ?)";
		$this->executerRequete($sql, array($titre, $content));
	}
	
	// Suppression Billet
	public function suppress($idBillet)
	{
		$sql = 'DELETE FROM posts WHERE bil_id = ?';
		$this->executerRequete($sql, array($idBillet));
	}
	
	// Modification Billet
	public function update($idBillet, $titreBillet, $contenuBillet)
	{
		$sql = "UPDATE posts SET bil_titre = ?, bil_contenu = ? WHERE bil_id = ?";
		$this->executerRequete($sql, array($titreBillet, $contenuBillet, $idBillet));
	}

}

