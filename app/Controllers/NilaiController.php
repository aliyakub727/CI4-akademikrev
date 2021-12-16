<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\NilaiModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\SiswaModel;
use App\Models\NilaiDetailModel;
use App\Models\MasterdataModel;
use App\Models\RaportModel;
use App\Models\RaportDetailModel;
use App\Models\AbsenModel;
use App\Models\AbsenDetailModel;
use Dompdf\Dompdf;
use Dompdf\Options;
 
use DB;

class NilaiController extends BaseController
{
    protected $raport;
    protected $raportdetail;
    protected $masterdata;

    public function __construct()
    {
        $this->nilai = new NilaiModel();
        $this->nilaidetail = new NilaiDetailModel;
        $this->masterdata = new MasterdataModel();
        $this->kelas = new KelasModel();
        $this->mapel = new MapelModel();
        $this->siswa = new SiswaModel();
        $this->jurusan = new JurusanModel();
        $this->raport = new RaportModel();
        $this->raportdetail = new RaportDetailModel();
        $this->absen= new AbsenModel();
        $this->absendetail = new AbsenDetailModel();

    }
    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'nilai' => $this->nilai ->join('mapel', 'mapel.id_mapel=nilai.id_mapel')
                                    ->join('jurusan', 'jurusan.id_jurusan=nilai.id_jurusan')
                                    ->join('kelas', 'kelas.id_kelas=nilai.id_kelas')
                                    ->where('id_akun',user_id())->findAll(),
        ];
        // dd( user_id(3) );
        return view('/nilai/index', $data);

    }
    public function edit($id)
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'detail'=> $this->nilaidetail   ->join('siswa', 'siswa.id=nilai_detail.id_siswa') 
                                            ->where('id_nilai',$id)->findAll(),
            'nilai' => $this->nilai ->join('mapel', 'mapel.id_mapel=nilai.id_mapel')
                                    ->join('jurusan', 'jurusan.id_jurusan=nilai.id_jurusan')
                                    ->join('kelas', 'kelas.id_kelas=nilai.id_kelas')
                                    ->where('id_nilai',$id)->first(),
        ];
        return view ('/nilai/edit',$data);
        
    }
    public function create()
    {
          {
        // session();
        $data = [
            'judul' => 'Form Tambah Data Siswa',
            'jurusan' => $this->jurusan->getjurusan(),
            'mapel' => $this->mapel->getmapel(),
            'kelas' => $this->kelas->getkelas(),
        ];
        return view('/Nilai/create', $data);
    }

    }
    public function savenilai()
    {
        // dd($this->request->getVar());
        $this->nilai->save([
            'id_akun' => user_id(),
            'id_mapel' => $this->request->getVar('id_mapel'),
            'id_jurusan' => $this->request->getVar('id_jurusan'),
            'id_kelas' => $this->request->getVar('id_kelas'),
        ]);
        $id_rapot = $this->raport->insertID();
        $id_nilai = $this->nilai->insertID();
        $dataSiswa = $this->siswa->findAll();
        foreach ($dataSiswa as $key => $value) {
            $this->nilaidetail->save([
                'id_nilai' => $id_nilai,
                'id_siswa' => $value['id'],
                'tugas' => 0,
                'uts' => 0,
                'uas' => 0,
                'rata_rata' => 0,
            ]);
        }
        $dataNilai = $this->nilai->findAll();
        $dataID = '';
        foreach ($dataNilai as $row){
            $dataID = $row['id_nilai'];
        }
        $dataRaport = $this->raport->findAll();
        $dataIDRaport = '';
        foreach ($dataRaport as $row){
            $dataIDRaport = $row['id_raport'];
        }
        $dataMapel = $this->mapel->findAll();
        foreach ($dataMapel as $k) {
             $this->raportdetail->save([
                'id_raport' => $dataIDRaport,
                'id_mapel' =>  $k['id_mapel'],
                'id_nilai' => $id_nilai
             ]);
        }            
        // $raportID = $this->raport->insertID();
        // $nilaiID = $this->nilaidetail->insertID('id_nilai');
        // $dataMapel = $this->mapel->findAll();
        // foreach ($dataMapel as $key => $k) {
        //      $this->raportdetail->save([
        //         'id_raport' => $raportID,
        //         'id_mapel' =>  $k['id_mapel'],
        //         'id_nilai' => $nilaiID ,
        //      ]);
        // }
         return redirect()->to(base_url().'/NilaiController');

    }

    public function saveinput()
    {
        $data = $this->request->getPost();
        $dataNilai = $this->nilaidetail->insertnilai($data);
        return 'Success';
    }
    public function deletenilai($id_nilai)
    {
        $model = new NilaiModel();
        $model->deleteNilai($id_nilai);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/NilaiController');
    }
 
    public function printpdf($id){
            $dataRaport = $this->raport->join('siswa','siswa.id=raport.id_siswa')
                                   ->join('tahun_ajaran','tahun_ajaran.id_ajaran=raport.id_ajaran') 
                                   ->join('jurusan','jurusan.id_jurusan=raport.id_jurusan')
                                   ->join('kelas','kelas.id_kelas=raport.id_kelas')
                                   ->find($id);

		$raportDetail = $this->raportdetail->join('mapel','mapel.id_mapel=raport_detail.id_mapel')
                                           ->join('nilai','nilai.id_nilai=raport_detail.id_nilai')
                                           ->join('nilai_detail','nilai_detail.id_nilai=nilai.id_nilai')
                                           ->where(['id_raport'=> $dataRaport['id_raport'], 'nilai_detail.id_siswa' => $dataRaport['id_siswa']])
                                           ->findAll();     
		$html = view('guru/raport_guru/detail_view',[
			'dataRaport'=> $dataRaport,
			'raportDetail' => $raportDetail,
            // 'dataGuru' => $dataGuru,
		]);
                // instantiate and use the dompdf class
                $options = new Options();
                 $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
       
        
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
     public function absen()
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'absen' => $this->absen ->join('kelas', 'kelas.id_kelas=absen.id_kelas')
                                    ->findAll(),
        ];
        // dd( user_id(3) );
        return view('/absen/index', $data);


    }
      public function absentambah()
    {
          {
        // session();
        $data = [
            'judul' => 'Form Tambah Data Absen',
            'kelas' => $this->kelas->getkelas(),
        ];
        return view('/absen/create', $data);
         }
    }
    
    public function absenedit($id)
    {
        $absen = $this->absen->find($id);
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'absen'=> $this->absen          ->join('detail_absen','detail_absen.id_absen=absen.id_absen')
                                            ->join('masterdatapelajaran','masterdatapelajaran.id_master=detail_absen.id_master') 
                                            ->where(['detail_absen.id_absen'=> $id, 'masterdatapelajaran.id_kelas' => $absen['id_kelas'] ])->findAll(), 
        ];
        return view ('/absen/edit',$data);
        
    }
    public function saveabsen()
    {
        $data = $this->request->getPost();
        $dataAbsen = $this->absendetail->insertabsen($data);
        return 'Success';
        
    }
     public function saveabsensiswa()
    {
        // dd($this->request->getVar());
        $this->absen->save([
            'id_kelas' => $this->request->getVar('id_kelas'),
            'nama_bulan' => $this->request->getVar('bln'),
            'tahun' => $this->request->getVar('tahun'),
        ]);
        $id_absen = $this->absen->insertID();
        $dataMaster = $this->masterdata->findAll();
        foreach ($dataMaster as $key => $value) {
            $this->absendetail->save([
                'id_absen' => $id_absen,
                'id_master' => $value['id_master'],
                'sakit' => 0,
                'izin' => 0,
                'alpha' => 0,
            ]);
        }
        
                   
         return redirect()->to(base_url().'/NilaiController');

}
 public function deleteabsen($id_absen)
    {
        $model = new AbsenModel();
        $model->deleteAbsen($id_absen);
        session()->setFlashdata('Pesan', 'Data Berhasil Di Delete.');
        return redirect()->to('/NilaiController');
    }
}
