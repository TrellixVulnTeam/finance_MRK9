<?php

class JenisBiaya extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MJenisBiaya');
        $this->load->model('MKendaraan');
        $this->load->model('MJenisPengeluaran');
        $this->load->model('MSparepart');
    }
    public function index(){
        $data['auth']           = $this->db->get_where('master_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kendaraans']     = $this->MKendaraan->get(['disabled_date' => NULL, 'is_active' => '1']);
        $data['pengAdmin']      = $this->MJenisPengeluaran->get(['pengeluaran_group' => 'Administrasi', 'deleted_date' => NULL]);
        $data['pengMaint']      = $this->MJenisPengeluaran->get(['pengeluaran_group' => 'Maintenance', 'deleted_date' => NULL]);
        $data['pengExp']        = $this->MJenisPengeluaran->get(['pengeluaran_group' => 'Expense', 'deleted_date' => NULL]);
        $data['sparepart']      = $this->MSparepart->get(['deleted_date' => NULL]);

        $this->template->index('admin/pencatatan/jenis_biaya', $data);
		$this->load->view('_components/sideNavigation', $data);
    }

    public function storeAdministrasi(){
        $dataStore['transaksi_tanggal'] = $_POST['tglTransaksi'];
        $dataStore['no_rangka']         = explode('|', $_POST['kendaraan'])[0];
        $dataStore['kendaraan_stnk']    = explode('|', $_POST['kendaraan'])[1];

        $index = 0;
        foreach ($_POST['jenPeng'] as $item) {
            $dataStore['id_pengeluaran']    = $item;
            $dataStore['transaksi_total']   = $_POST['total'][$index];
            $this->MJenisBiaya->insert($dataStore);
            $index++;
        }
        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/jenis-biaya');
    }
    public function storeMaintenance(){
        $dataStore['transaksi_tanggal']         = $_POST['tglService'];
        $dataStore['no_rangka']                 = explode('|', $_POST['kendaraan'])[0];
        $dataStore['kendaraan_stnk']            = explode('|', $_POST['kendaraan'])[1];
        $dataStore['transaksi_detail']          = $_POST['toko'];
        $dataStore['transaksi_jarak_tempuh']    = $_POST['jarak'];

        $index = 0;
        foreach ($_POST['jenPeng'] as $item) {
            $dataStore['id_pengeluaran']        = $item;
            $dataStore['transaksi_no_seri']     = $_POST['noSeri'][$index];
            $dataStore['id_sparepart']          = $_POST['sparepart'][$index];
            $dataStore['transaksi_jumlah']      = $_POST['kuantitas'][$index];
            $dataStore['transaksi_total']       = $_POST['total'][$index];
            $this->MJenisBiaya->insert($dataStore);
            $index++;
        }
        $this->session->set_flashdata('succ_modal', true);
        redirect('admin/jenis-biaya');
    }
}