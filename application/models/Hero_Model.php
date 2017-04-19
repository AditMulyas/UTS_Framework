<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero_Model extends CI_Model{
	
		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}

		public function getDataHero()
		{
			$this->db->select("id,nama,DATE_FORMAT(tanggal_lahir,'%d-%m-%Y') as tanggal_lahir,foto");
			$query = $this->db->get('hero');
			return $query->result();
		}

			// $this->db->select("id,nama,foto,tanggal_lahir");
			// $query = $this->db->get('hero');
			// return $query->result();

		public function getJenisHero()
		{
			$this->db->select("hero.id as id,nama,tanggal_lahir,foto,fk_jenis,jenis_hero.keterangan as keterangan");
			$this->db->join('jenis_hero', 'jenis_hero.id = hero.fk_jenis');	
			$query = $this->db->get('hero');
			return $query->result();
		}

		public function insertHero()
		{
			$object = array(
				'nama' => $this->input->post('nama'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'foto' => $this->upload->data('file_name'),
				'fk_jenis' => $this->input->post('keterangan'));
			$this->db->insert('hero', $object);		
		}

		public function insertJenisHero($idHero)
		{
			$object = array('id' => $this->input->post('id'),'keterangan' => $this->input->post('keterangan'),'fk_jenis' => $idHero);
			$this->db->insert('jenis_hero', $object);		
		}

		public function getHero($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('hero',1);
			return $query->result();
		}

		public function getJenis($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('jenis_hero',1);
			return $query->result();
		}

		public function updateById($id)
		{
			$data = array('nama' => $this->input->post('nama'),'foto' => $this->upload->data('file_name'),);
			$this->db->where('id', $id);
			$this->db->update('hero', $data);
		}

		public function updateJenis($idJenis_Hero)
		{
			$data = array('id' => $this->input->post('id'), 'keterangan' => $this->input->post('keterangan'),);
			$this->db->where('id', $idJenis_Hero);
			$this->db->update('jenis_hero', $data);
		}

		public function deleteById($id)
		{
			$this ->db-> where('id', $id);
  			$this ->db-> delete('hero');
  			$this->db->where('id', $id);
			$this->db->delete('jenis_hero');
		}

		public function deleteData($id)
		{	
			$this->db->query("delete from jenis_hero where id = '$id'");
		}
}