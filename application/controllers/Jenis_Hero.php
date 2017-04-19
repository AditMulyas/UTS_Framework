<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_Hero extends CI_Controller {

	public function index($idHero)
	{
		$this->load->model('hero_model');		
		$data["jenis_hero_list"] = $this->hero_model->getJenisHero($idHero);
		$this->load->view('jenis_hero', $data);
	}

	public function datatable()
	{
		$this->load->model('hero_model');
		$data["jenis_hero_list"] = $this->hero_model->getDataKlub();
		$this->load->view('jenis_hero_datatable',$data);
	}

	public function create($idHero)
	{	
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->load->model('hero_model');
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('tambah_jenis_hero_view');

		}else{
			$this->hero_model->insertJenisHero($idHero);
			redirect('jenis_hero/index/'.$this->uri->segment(3));
		}
	}

		public function update($idHero)
	{	
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		$this->load->model('hero_model');
		$data['jenis_hero']=$this->hero_model->getJenisHero($idHero);
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('edit_jenis_hero_view');

		}else{
			$this->hero_model->updateJenisHero($idHero);
			redirect('jenis_hero/index/'.$this->uri->segment(3));
		}
	}

		public function delete($id)
	{

		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->load->model('hero_model');
		$this->hero_model->getHero($id);
		if($this->form_validation->run()==FALSE){
			redirect('jenis_hero/index/'.$this->uri->segment(3));
		}
		
	}
}