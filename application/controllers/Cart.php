<?php
 
class Cart extends CI_Controller
{
     
    function __construct(){
        parent::__construct();

    if(!isset($this->session->userdata['username'])) {
      $this->session->set_flashdata('Pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><small> Anda Belum Login! (Silahkan Login untuk mengakses halaman yang akan dituju!)</small> <button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times;</span> </button> </div>');
      redirect('auth');
    }
    //if($this->session->userdata['username']  != 'user') {
    //  redirect('dashboard');
    //}

    $this->load->model('MTransaksi');

  }  
 
    function view_keluar(){

        $data['tr_keluar'] = $this->MTransaksi->transaksi_keluar();

        $this->load->view('v_cart',$data);
        //$this->load->view('templates/head/tabel');
        //$this->load->view('templates/sidebar');
        //$this->load->view('templates/topbar');
        //$this->load->view('master/transaksi_keluar/transaksi_keluar', $data);
        //$this->load->view('templates/footer/tabel');
    }
 

    function save_keluar()
    {
  
      $tanggal  = $this->input->post('tanggal');
      $idbarang  = $this->input->post('id_barang');
      $jumlahkeluar  = $this->input->post('jumlah_keluar');
      $picpenerima = $this->input->post('pic_penerima');
      $note = $this->input->post('note');
  
      $data = array(
          'tanggal' => $tanggal,
          'id_barang' => $idbarang,
          'jumlah_keluar' => $jumlahkeluar,
              'pic_penerima' => $picpenerima,
          'note' => $note
      );
  
      $this->MTransaksi->input_data($data, 'tbl_transaksi_keluar');
      $this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Data Berhasil Ditambahkan
          </div>');
      redirect('Transaksi-keluar-view');
  
    }

    function add_to_cart(){ //fungsi Add To Cart
        $data['barang'] = $this->MTransaksi->get_master_toobject("vbarang","pk_barang_id","kocak","nama_barang","Select","","");
        $data = array(
            'id' => $this->input->post('produk_id'), 
            'name' => $this->input->post('produk_nama'), 
            'price' => $this->input->post('produk_harga'), 
            'qty' => $this->input->post('quantity'), 
        );
        $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }
 
    function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .='
                <tr>
                    <td>'.$items['name'].'</td>
                    <td>'.number_format($items['price']).'</td>
                    <td>'.$items['qty'].'</td>
                    <td>'.number_format($items['subtotal']).'</td>
                    <td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
            </tr>
        ';
        return $output;
    }
 
    function load_cart(){ //load data cart
        echo $this->show_cart();
    }
 
    function hapus_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }
}