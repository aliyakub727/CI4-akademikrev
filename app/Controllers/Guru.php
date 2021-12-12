<?php 

namespace App\Controllers;

use App\Models\Nilai;
use App\Models\GuruModel;
use Myth\Auth\Models\UserModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\SiswaModel;
use App\Models\RaportModel;
use App\Models\RaportDetailModel;
use TCPDF;


class Guru extends BaseController
{
    protected $nilai;
    protected $guru;
    protected $user;
    protected $jurusan;
    protected $db, $builder;
    protected $kelas;
    protected $mapel;
    protected $siswa;
    protected $raport;
    protected $raportdetail;

    public function __construct()
    {

        // $this->load->library('pdf');
        $this->nilai = new Nilai();
        $this->guru = new GuruModel();
        $this->user = new UserModel();
        $this->jurusan = new JurusanModel();
        $this->usermodel = new UserModel();
        $this->kelas = new KelasModel();
        $this->mapel = new MapelModel();
        $this->siswa = new SiswaModel();
        $this->raport = new RaportModel();
        $this->raportdetail = new RaportDetailModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'kelas' => $this->kelas->getkelas(),
            'guru'  => $this->guru->getguru(),

        ];
        return view('/guru/view', $data);
    }
    //munculin data siswa
        public function guru($id_mapel)
        {
        $data = [
         
            'judul' => 'SUZURAN | OPERATOR',
            'nilai' => $this->nilai->join('siswa', 'siswa.id=nilai.id_siswa')
            ->join('mapel', 'mapel.id_mapel=nilai.id_mapel')
            ->join('tahun_ajaran', 'tahun_ajaran.id_ajaran=nilai.id_ajaran')
            ->join('guru', 'guru.id_guru=nilai.id_guru')
            ->join('kelas', 'kelas.id_kelas=nilai.id_kelas')
            ->join('jurusan', 'jurusan.id_jurusan=nilai.id_jurusan')
            ->where('nilai.id_mapel', $id_mapel)->findAll(),
        ];

        // dd($data['nilai']);
        return view('guru/index', $data);
    }
    //tambah data siswa
    public function tambahnilai($user_id)
    {
        // session();
        $data = [
            'judul' => 'SUZURAN | OPERATOR',
            'validation' => \Config\Services::validation(),
            'user' => $this->user->findAll(),
            'jurusan' => $this->jurusan->getjurusan(),
            'kelas' => $this->kelas->getkelas(),
            'guru'  => $this->guru->where('id_akun', $user_id)->findAll(),

        ];
        return view('guru/view', $data);
    }

    // profile
    public function profile($id)
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('users');
        $this->builder->select('users.id as userid, username, email, user_image, name, description, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'users' => $query->getRow(),
            'guru' => $this->guru->detailakun($id),
            'mapel' => $this->mapel->getmapel(),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/detailakun', $data);
    }

    public function lengkapi($id)
    {
        $data = [
            'judul' => 'SUZURAN | ACCOUNT-GURU',
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/lengkapi_akun', $data);
    }

    public function savelengkapi()
    {
        if (!$this->validate([
            'nama_guru' => [
                'rules' => 'required|is_unique[guru.nama_guru]',
                'errors' => [
                    'required' => 'Nama Guru Harus diisi',
                    'is_unique' => 'Nama Guru Sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telepon Harus diisi',
                ]
            ],
        ])) {

            return redirect()->to('/guru/lengkapi/' . $this->request->getVar('id'))->withInput();
        }
        $this->guru->save([
            'id_akun' => $this->request->getVar('id'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        return redirect()->to('/guru/Profile/' . $this->request->getVar('id'));
    }

    public function saveprofile()
    {
        $lmguru =  $this->guru->detailakun($this->request->getVar('id'));

        //cek nama diganti atau engga
        if ($lmguru['nama_guru'] == $this->request->getVar('nama_guru')) {
            $rule12 = 'required';
        } else {
            $rule12 = 'required|is_unique[guru.nama_guru]';
        }
        if (!$this->validate([
            'nama_guru' => [
                'rules' => $rule12,
               'errors' => [
                    'required' => 'Nama Guru Harus diisi',
                    'is_unique' => 'Nama Guru Sudah terdaftar.'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Harus diisi',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Telepon Harus diisi',
                ]
            ],
        ])) {

            return redirect()->to('/guru/profile/' . $this->request->getVar('id'))->withInput();
        }
        $this->guru->save([
            'id_guru' => $this->request->getVar('id_guru'),
            'id_akun' => $this->request->getVar('id'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        return redirect()->to('/guru/Profile/' . $this->request->getVar('id'));
    }

    public function gantiprofil($id)
    {
        $filegambar = $this->request->getFile('userimage');

        //cek gambar
        $gambarlama = $this->request->getVar('gambarlama');
        if ($gambarlama == 'default.svg') {
            $namagambar = $filegambar->getRandomName();
            //pindahkan gambar
            $filegambar->move('img/fotoprofil/', $namagambar);
        } elseif ($filegambar != $gambarlama) {
            $namagambar = $filegambar->getRandomName();
            //pindahkan gambar
            $filegambar->move('img/fotoprofil/', $namagambar);
            //hapus file lama
            unlink('img/fotoprofil/' . $this->request->getVar('gambarlama'));
        } else {

            $namagambar = $this->request->getVar('gambarlama');
        }

        $this->user->save([
            'id' => $id,
            'user_image' => $namagambar
        ]);

        return redirect()->to('/guru/profile/' . $this->request->getVar('id'));
    }


    //save data siswa
    public function saveguru()
    {
        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Harus diisi.',
                    'is_unique' => 'Nama minuman Sudah terdaftar.'
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // dd($validation);
            // return redirect()->to('/Siswa/create')->withInput()->with('validation', $validation);
            return redirect()->to('/guru/create')->withInput();
        }
        $this->nilai->save([
            'id_akun'   => $this->request->getVar('id'),
            'id_mapel'   => $this->request->getVar('id_mapel'),
            'id_jurusan'   => $this->request->getVar('id_jurusan'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'tahun_ajaran' => $this->request->getVar('tahun_ajaran'),
            'nama_guru' => $this->request->getVar('nama_guru'),
            'nis' => $this->request->getVar('nis'),
            'jurusan' => $this->request->getVar('jurusan'),
            'tugas' => $this->request->getVar('tugas'),
            'uts' => $this->request->getVar('uts'),
            'uas' => $this->request->getVar('uas')
        ]);

        session()->setFlashdata('Pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/guru/index');
    }
    public function savenilai()
    {
        $data = $this->request->getPost();
        $dataNilai = $this->nilai->insertnilai($data);
        return 'Success';
    }
    public function search($nama_kelas)
    {
        $data = [
            'judul' => 'Akademik | Administrator',
            'nilai' => $this->nilai->getnilai2($nama_kelas),
        ];
        return view('guru/index', $data);
    }
    public function laporannilai()
    {
        $data = [
            'judul' => 'Akademik | Administrator',
            'raport' => $this->raport->join('siswa', 'siswa.id=raport.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id_ajaran=raport.id_ajaran')
            ->join('jurusan', 'jurusan.id_jurusan=raport.id_jurusan')
            ->join('kelas', 'kelas.id_kelas=raport.id_kelas')->findAll()
        ];
        return view('/guru/raport_guru/view',$data);
    }
    // public function viewraport()
    // {
    //     $data = [
    //         'judul' => 'Akademik | Administrator',
    //         'raport_detail' => $this->raportdetail->join('raport', 'raport.id_raport=raport_detail.id_raport')
    //         ->join('mapel', 'mapel.id_mapel=raport_detail.id_mapel')
    //         ->join('nilai', 'nilai.id_nilai=raport_detail.id_nilai')->findAll()
    //     ];
    //     return view('/guru/raport_guru/detail_view',$data);
    // }
    public function nilaiRaport($id)
	{
		$dataRaport = $this->raport->join('siswa','siswa.id=raport.id_siswa')
                                   ->join('tahun_ajaran','tahun_ajaran.id_ajaran=raport.id_ajaran') 
                                   ->join('jurusan','jurusan.id_jurusan=raport.id_jurusan')
                                   ->join('kelas','kelas.id_kelas=raport.id_kelas')
                                   ->find($id);

		$raportDetail = $this->raportdetail->join('mapel','mapel.id_mapel=raport_detail.id_mapel')
                                           ->join('nilai','nilai.id_nilai=raport_detail.id_nilai')
                                           ->where('id_raport', $dataRaport['id_raport'])
                                           ->findAll();
        // dd($dataRaport,$raportDetail);
        // $dataGuru = $this->guru->join('mapel','mapel.id_mapel=guru.id_mapel') 
                            //    ->where('guru.id_mapel', $raportDetail[0]['id_mapel'])
                            //    ->first();

		$html = view('guru/raport_guru/detail_view',[
			'dataRaport'=> $dataRaport,
			'raportDetail' => $raportDetail,
            // 'dataGuru' => $dataGuru,
		]);

		$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('ADMIN');
		$pdf->SetTitle('Raport');
		$pdf->SetSubject('Nilai Raport');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false,'');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('raportnilai.pdf', 'I');
		
	}
    // public function invoice($id_mapel){
    //     {
    //     // $model = new Nilai();
    //     // $join['nilai'] = $model->innerjoin();
    //     $data = [
         
    //         'judul' => 'SUZURAN | OPERATOR',
    //         // 'nilai' => $this->nilai->where('id_mapel', $id_mapel)->findAll(),
    //         'nilai' => $this->nilai->join('siswa', 'siswa.id=nilai.id_siswa')
    //         ->join('mapel', 'mapel.id_mapel=nilai.id_mapel')
    //         ->join('tahun_ajaran', 'tahun_ajaran.id_ajaran=nilai.id_ajaran')
    //         ->join('guru', 'guru.id_guru=nilai.id_guru')
    //         ->join('kelas', 'kelas.id_kelas=nilai.id_kelas')
    //         ->join('jurusan', 'jurusan.id_jurusan=nilai.id_jurusan')
            

            
    //         ->where('nilai.id_mapel', $id_mapel)->findAll(),
    //     ];
    //     $html = view('guru/raport_guru/raport_all', $data);
    //     $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //     $pdf->SetCreator(PDF_CREATOR);
    //     $pdf->SetAuthor('Nama Guru');
    //     $pdf->SetTitle('Raport Nilai');
    //     $pdf->SetSubject('Nilai Raport');
    //     $Pdf->SetPrintHeader(false);
    //     $Pdf->SetPrintFooter(false);
    //     $pdf->AddPage();
    //     $pdf->writeHTMLCell( $html,true, false, true,false,'');
    //     $this->reponse->setContentType('application/pdf');
    //     $pdf->Output('nilaiRaport.pdf', 'I');
    //         }


// }
    
}