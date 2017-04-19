<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function index($idPegawai)
	{
		$this->load->model('pegawai_model');		
		$data["jabatan_list"] = $this->pegawai_model->getJabatanByPegawai($idPegawai);
		$this->load->view('jabatan', $data);
	}

	public function create($idPegawai)
	{	
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tanggalMulai', 'tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tanggalSelesai', 'tanggal Selesai', 'trim|required');
		$this->load->model('pegawai_model');
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('tambah_jabatan_view');

		}else{
			$this->pegawai_model->insertJabatanPegawai($idPegawai);
			redirect('jabatan/index/'.$this->uri->segment(3));
		}
	}

	public function update($idPegawai)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tanggalMulai', 'tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tanggalSelesai', 'tanggal Selesai', 'trim|required');
		$this->load->model('pegawai_model');
		$data['jabatan']=$this->pegawai_model->getJabatPegawai($idPegawai);
		//skeleton code
		if($this->form_validation->run()==FALSE){
		//setelah load data dikirim ke view
			$this->load->view('edit_jabatan_view',$data);

		}else{
			$this->pegawai_model->updateJabatanPegawai($idPegawai);
			redirect('jabatan/index/'.$this->uri->segment(3));

		}
	}

		public function delete($idPegawai)
	{

		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->load->model('pegawai_model');
		$this->pegawai_model->deleteJabatan($idPegawai);
		if($this->form_validation->run()==FALSE){
			redirect('jabatan/index/'.$this->uri->segment(3));
		}
		
	}

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */

 ?>