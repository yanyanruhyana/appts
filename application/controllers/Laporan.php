<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Laporan extends CI_Controller
{
    function __construct(){
		  parent::__construct();

      if(!isset($this->session->userdata['username'])) {
        $this->session->set_flashdata('Pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><small> Anda Belum Login! (Silahkan Login untuk mengakses halaman yang akan dituju!)</small> <button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times;</span> </button> </div>');
        redirect('auth');
      }


      $this->load->library('pdf');
      $this->load->model('MLaporan');
      $this->load->library('excel');
    
    } 
    
    function barang_masuk()
    {

        $data['graph'] = $this->MLaporan->graph();
        $data['caribarang'] = $this->MLaporan->show_barang();
        
        $this->load->view('templates/head/tabel');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('master/laporan/barangmasuk', $data);
        $this->load->view('templates/footer/tabel');
    }

    function barang_keluar()
    {

        $data['graph'] = $this->MLaporan->graph_keluar();
        $data['caribarang'] = $this->MLaporan->show_barang_keluar();
        
        $this->load->view('templates/head/tabel');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('master/laporan/barangkeluar', $data);
        $this->load->view('templates/footer/tabel');
    }

    function stok_barang()
    {
        
        $data['barang'] = $this->user_m->data_barang();

		$this->load->view('templates/head/tabel');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('master/laporan/stokbarang', $data);
        $this->load->view('templates/footer/tabel');
    }

    function laporan_masuk()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');

        $data['caribarang'] = $this->MLaporan->data_barang($dari,$sampai);

        $this->load->view('templates/head/tabel');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('master/laporan/barangmasuk', $data);
        $this->load->view('templates/footer/tabel');
    }

    function laporan_keluar()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');

        $data['caribarang'] = $this->MLaporan->data_barang_keluar($dari,$sampai);

        $this->load->view('templates/head/tabel');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('master/laporan/barangkeluar', $data);
        $this->load->view('templates/footer/tabel');
    }

    function export_pdf_masuk($dari, $sampai)
    {    
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->Image('application/images/logo.png', 10, 10, 30, 10);
        $pdf->SetFont('Arial','B',16);
        //Cell(Panjang, tinggi, Note, Border, Pindah baris, align)
        $pdf->Cell(35,5,' ',0,0,'C');
        $pdf->Cell(110,10,'DATA BARANG MASUK',0,0,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(45,5,'Printed By: '. $this->session->userdata['username'],0,1);
        $pdf->Cell(145,5,' ',0,0,'C');
        $pdf->Cell(45,5,'Printed Date: '. date("d/m/Y"),0,1);
        //Spasi Cell
        $pdf->Cell(190,7,'',0,1);
        $pdf->Cell(45,5,'Periode: '. $dari . ' s/d ' .$sampai ,0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(25,6,'Tanggal',1,0,'C');
        $pdf->Cell(65,6,'Nama Barang',1,0,'C');
        $pdf->Cell(40,6,'Surat Jalan',1,0,'C');
        $pdf->Cell(30,6,'Jumlah Masuk',1,0,'C');
        $pdf->Cell(20,6,'Satuan',1,1,'C');
        $pdf->SetFont('Arial','',8);
        $dtbarang = $this->MLaporan->data_barang($dari,$sampai);
        $no=0;
        foreach ($dtbarang as $row){
            $no++;
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(25,6,$row->tanggal,1,0,'C');
            $pdf->Cell(65,6,$row->nama_barang,1,0);
            $pdf->Cell(40,6,$row->surat_jalan,1,0);
            $pdf->Cell(30,6,$row->jumlah_masuk,1,0,'C');
            $pdf->Cell(20,6,$row->satuan_barang,1,1,'C'); 
        }
        $pdf->Output();
    }

    function export_pdf_keluar($dari, $sampai)
    {    
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->Image('application/images/logo.png', 10, 10, 30, 10);
        $pdf->SetFont('Arial','B',16);
        //Cell(Panjang, tinggi, Note, Border, Pindah baris, align)
        $pdf->Cell(35,5,' ',0,0,'C');
        $pdf->Cell(110,10,'DATA BARANG KELUAR',0,0,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(45,5,'Printed By: '. $this->session->userdata['username'],0,1);
        $pdf->Cell(145,5,' ',0,0,'C');
        $pdf->Cell(45,5,'Printed Date: '. date("d/m/Y"),0,1);
        //Spasi Cell
        $pdf->Cell(190,7,'',0,1);
        $pdf->Cell(45,5,'Periode: '. $dari . ' s/d ' . $sampai ,0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(20,6,'Tanggal',1,0,'C');
        $pdf->Cell(50,6,'Nama Barang',1,0,'C');
        $pdf->Cell(25,6,'Jumlah Keluar',1,0,'C');
        $pdf->Cell(45,6,'Penerima',1,0,'C');
        $pdf->Cell(40,6,'Note',1,1,'C');
        $pdf->SetFont('Arial','',8);
        $dtbarang = $this->MLaporan->data_barang_keluar($dari,$sampai);
        $no=0;
        foreach ($dtbarang as $row){
            $no++;
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(20,6,$row->tanggal,1,0,'C');
            $pdf->Cell(50,6,$row->nama_barang,1,0);
            $pdf->Cell(25,6,$row->jumlah_keluar . ' ' . $row->satuan_barang,1,0,'C');
            $pdf->Cell(45,6,$row->pic_penerima,1,0); 
            $pdf->Cell(40,6,$row->note,1,1); 
        }
        $pdf->Output();

    }

    function export_pdf_stokbarang()
    {
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->Image('application/images/logo.png', 10, 10, 30, 10);
        $pdf->SetFont('Arial','B',16);
        //Cell(Panjang, tinggi, Note, Border, Pindah baris, align)
        $pdf->Cell(35,5,' ',0,0,'C');
        $pdf->Cell(110,10,'LAPORAN STOK BARANG',0,0,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(45,5,'Printed By: '. $this->session->userdata['username'],0,1);
        $pdf->Cell(145,5,' ',0,0,'C');
        $pdf->Cell(45,5,'Printed Date: '. date("d/m/Y"),0,1);
        //Spasi Cell
        $pdf->Cell(190,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(20,6,'ID Barang',1,0,'C');
        $pdf->Cell(65,6,'Nama Barang',1,0,'C');
        $pdf->Cell(50,6,'Jenis Barang',1,0,'C');
        $pdf->Cell(20,6,'Stok',1,0,'C');
        $pdf->Cell(25,6,'Satuan',1,1,'C');
        $pdf->SetFont('Arial','',10);
        $dtbarang = $this->user_m->data_barang();
        $no=0;
        foreach ($dtbarang as $row){
            $stok = $row->stokbarang;
			$keluar = $row->keluar;
			$jumlah = $stok-$keluar;
            $no++;
            $pdf->Cell(10,6,$no,1,0,'C');
            $pdf->Cell(20,6,$row->id_barang,1,0,'C');
            $pdf->Cell(65,6,$row->nama_barang,1,0);
            $pdf->Cell(50,6,$row->jenis_barang,1,0);
            $pdf->Cell(20,6,$jumlah,1,0,'C');
            $pdf->Cell(25,6,$row->satuan_barang,1,1); 
        }
        $pdf->Output();
    }

    function export_excel_stokbarang()
    {
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0)->setCellValue('B1', "LAPORAN STOK BARANG");
        $object->setActiveSheetIndex(0)->setCellValue('E1', "Printed by: ". $this->session->userdata['username']);
        $object->setActiveSheetIndex(0)->setCellValue('E2', "Printed Date: ". date("d/m/Y") );
        $object->getActiveSheet()->mergeCells('B1:D2');
        //$object->getActiveSheet()->mergeCells('E1:F1');
        //$object->getActiveSheet()->mergeCells('E2:F2');
        $object->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('B1')->getFont()->setSize(15);
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $style_col = array(
            'font' => array('bold' => true),
                'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_row = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        //add image
        $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath('application/images/logo.png');
            $objDrawing->setCoordinates('A1');                      
            //setOffsetX works properly
            $objDrawing->setOffsetX(5); 
            $objDrawing->setOffsetY(5);                
            //set width, height
            $objDrawing->setWidth(100); 
            $objDrawing->setHeight(35); 
            $objDrawing->setWorksheet($object->getActiveSheet());
        //MulaiTable
        // Set Auto Width
        //$object->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $table_columns = array("NO", "ID BARANG", "NAMA BARANG", "JENIS BARANG", "STOK", "SATUAN");
        $column = 0;//awal memasukan colom
        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);//header Tabel
            $object->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
            $column++;
        }
        $dtbarang = $this->user_m->data_barang();
        $no=0;
        $excel_row = 6; //mulai Awal Baris
        foreach ($dtbarang as $row){
            $stok = $row->stokbarang;
			$keluar = $row->keluar;
			$jumlah = $stok-$keluar;
            $no++;
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->id_barang);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nama_barang);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->jenis_barang);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $jumlah);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->satuan_barang);
            $object->getActiveSheet()->getStyle('A'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('B'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('C'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('D'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('E'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('F'.$excel_row)->applyFromArray($style_row);
            $excel_row++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Stok_Barang.xls"');
        $object_writer->save('php://output');
    }

    function export_excel_trxin($dari, $sampai)
    {
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0)->setCellValue('B1', "LAPORAN BARANG MASUK");
        $object->setActiveSheetIndex(0)->setCellValue('F1', "Printed by: ". $this->session->userdata['username']);
        $object->setActiveSheetIndex(0)->setCellValue('F2', "Printed Date: ". date("d/m/Y") );
        $object->getActiveSheet()->mergeCells('B1:E2');
        $object->setActiveSheetIndex(0)->setCellValue('A4', "Periode: ". $dari . " s/d " . $sampai);
        $object->getActiveSheet()->mergeCells('A4:D4');
        //$object->getActiveSheet()->mergeCells('E1:F1');
        //$object->getActiveSheet()->mergeCells('E2:F2');
        $object->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('B1')->getFont()->setSize(15);
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $style_col = array(
            'font' => array('bold' => true),
                'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_row = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        //add image
        $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath('application/images/logo.png');
            $objDrawing->setCoordinates('A1');                      
            //setOffsetX works properly
            $objDrawing->setOffsetX(5); 
            $objDrawing->setOffsetY(5);                
            //set width, height
            $objDrawing->setWidth(100); 
            $objDrawing->setHeight(35); 
            $objDrawing->setWorksheet($object->getActiveSheet());
        //MulaiTable
        // Set Auto Width
        //$object->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $table_columns = array("NO", "TANGGAL", "NAMA BARANG", "SURAT JALAN", "JUMLAH MASUK", "SATUAN");
        $column = 0;//awal memasukan colom
        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);//header Tabel
            $object->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
            $column++;
        }
        $dtbarang = $this->MLaporan->data_barang($dari,$sampai);
        $no=0;
        $excel_row = 6; //mulai Awal Baris
        foreach ($dtbarang as $row){
            $no++;
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->tanggal);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nama_barang);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->surat_jalan);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->jumlah_masuk);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->satuan_barang);
            $object->getActiveSheet()->getStyle('A'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('B'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('C'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('D'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('E'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('F'.$excel_row)->applyFromArray($style_row);
            $excel_row++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Barang_Masuk.xls"');
        $object_writer->save('php://output');
    }

    function export_excel_trxout($dari, $sampai)
    {
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0)->setCellValue('B1', "LAPORAN BARANG KELUAR");
        $object->setActiveSheetIndex(0)->setCellValue('F1', "Printed by: ". $this->session->userdata['username']);
        $object->setActiveSheetIndex(0)->setCellValue('F2', "Printed Date: ". date("d/m/Y") );
        $object->getActiveSheet()->mergeCells('B1:E2');
        $object->setActiveSheetIndex(0)->setCellValue('A4', "Periode: ". $dari . " s/d " . $sampai);
        $object->getActiveSheet()->mergeCells('A4:D4');
        //$object->getActiveSheet()->mergeCells('E1:F1');
        //$object->getActiveSheet()->mergeCells('E2:F2');
        $object->getActiveSheet()->getStyle('B1')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('B1')->getFont()->setSize(15);
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        $style_col = array(
            'font' => array('bold' => true),
                'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_row = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        //add image
        $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath('application/images/logo.png');
            $objDrawing->setCoordinates('A1');                      
            //setOffsetX works properly
            $objDrawing->setOffsetX(5); 
            $objDrawing->setOffsetY(5);                
            //set width, height
            $objDrawing->setWidth(100); 
            $objDrawing->setHeight(35); 
            $objDrawing->setWorksheet($object->getActiveSheet());
        //MulaiTable
        // Set Auto Width
        //$object->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $object->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $table_columns = array("NO", "TANGGAL", "NAMA BARANG", "JUMLAH KELUAR", "SATUAN", "PENERIMA", "NOTE");
        $column = 0;//awal memasukan colom
        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);//header Tabel
            $object->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
            $object->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
            $column++;
        }

        $dtbarang = $this->MLaporan->data_barang_keluar($dari, $sampai);
        $no=0;
        $excel_row = 6; //mulai Awal Baris
        foreach ($dtbarang as $row){
            $no++;
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->tanggal);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nama_barang);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->jumlah_keluar);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->satuan_barang);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->pic_penerima);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->note);
            $object->getActiveSheet()->getStyle('A'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('B'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('C'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('D'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('E'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('F'.$excel_row)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('G'.$excel_row)->applyFromArray($style_row);
            $excel_row++;
        }
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Barang_Keluar.xls"');
        $object_writer->save('php://output');
    }
}