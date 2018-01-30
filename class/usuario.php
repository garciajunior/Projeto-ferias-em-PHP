<?php
	class Usuario
	{
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario()
		{
			return $this->idusuario;
		}
		public function setIdusuario($value)
		{
			$this->idusuario = $value;
		}


		public function getDeslogin()
		{
			return $this->deslogin;
		}
		public function setDeslogin($value)
		{
			$this->deslogin = $value;
		}


		public function getDessenha()
		{
			return $this->dessenha;
		}

		public function setDessenha($value)
		{
			$this->dessenha = $value;
		}


		public function getDtcadastro()
		{
			return $this->dtcadastro;
		}

		public function setDtcadastro($value)
		{
			$this->dtcadastro = $value;
		}

		public function loadByid($id)
		{
			$sql = new Sql();
			$results = $sql->select("SELECT * FROM  tb_usuarios WHERE idusuario = :ID", array(":ID" =>$id));
			if (isset($results[0]))
			{
				$this->setData($results[0]);
			}
		}

		public static function getList()
		{
			$sql = new Sql();
			 return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

		}
		public static function search($Login)
		{
			$sql = new Sql();
			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY  deslogin", array(':SEARCH'=>"%".$Login."%"
			));
		}
		public  function login($Login, $password)
		{
			$sql = new Sql();
			$results = $sql->select("SELECT *FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD ",array(":LOGIN"=>$Login, ":PASSWORD"=>$password));
			if (isset($results[0]))
			{
				$this->setData($results[0]);
			}
			else
			{
				throw new Exception("Login e senha invalidos");
			}
		}
	public function setData($data)
	{
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime ($data['dtcadastro']));
	}
	public function __construct($Login = "", $password = "")
	{
		$this->setDeslogin($Login);
		$this->setDessenha($password);
	}

	public function insert()
	{
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)", array(
			'LOGIN'=>$this->getDeslogin(),
			'PASSWORD'=>$this->getDessenha()
		));
		echo "nada";
		if(count($results) > 0)
		{
			$this->setData($results[0]); 
			echo "nada";
		}
	}
	public function  update($Login, $Password)
    {
        $this->setDeslogin ($Login);
        $this->setDessenha ($Password);
        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :Password WHERE idusuario = :ID", array(
            ":LOGIN"=>$this->getDeslogin (),
            "Password"=>$this->getDessenha (),
            "ID"=>$this->getIdusuario ()
        ));
    }
    public function delete()
    {
        $sql = new Sql();
        $sql->query("DELETE FROM  tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$this->getIdusuario ()
        ));
        $this->setIdusuario (0);
        $this->setDeslogin ("");
        $this->setDessenha ("");
        $this->setDtcadastro (new DateTime());
    }
	public function __toString()
	{
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m,Y H:i:s")
		));
	}
	}



?>