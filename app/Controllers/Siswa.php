<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\GurukelasModel;
use App\Models\GurumapelModel;
use App\Models\SmtpModel;
use App\Models\MateriModel;
use App\Models\TugasModel;
use App\Models\FileModel;
use App\Models\Materi_siswaModel;
use App\Models\Tugas_siswaModel;
use App\Models\ChatmateriModel;
use App\Models\ChattugasModel;
use App\Models\UjianModel;
use App\Models\UjiandetailModel;
use App\Models\UjiansiswaModel;
use App\Models\EssaydetailModel;
use App\Models\EssaysiswaModel;
use App\Models\WaktuujianModel;

class Siswa extends BaseController
{
    protected $guruModel;
    protected $SiswaModel;
    protected $GuruModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $GurukelasModel;
    protected $GurumapelModel;
    protected $SmtpModel;
    protected $MateriModel;
    protected $TugasModel;
    protected $FileModel;
    protected $Materi_siswaModel;
    protected $Tugas_siswaModel;
    protected $ChatmateriModel;
    protected $ChattugasModel;
    protected $UjianModel;
    protected $UjiandetailModel;
    protected $UjiansiswaModel;
    protected $EssaydetailModel;
    protected $EssaysiswaModel;
    protected $WaktuujianModel;


    public function __construct()
    {
        $validation = \Config\Services::validation();
        $this->AdminModel = new AdminModel();
        $this->SiswaModel = new SiswaModel();
        $this->GuruModel = new GuruModel();
        $this->MapelModel = new MapelModel();
        $this->KelasModel = new KelasModel();
        $this->GurukelasModel = new GurukelasModel();
        $this->GurumapelModel = new GurumapelModel();
        $this->SmtpModel = new SmtpModel();
        $this->MateriModel = new MateriModel();
        $this->TugasModel = new TugasModel();
        $this->FileModel = new FileModel();
        $this->Materi_siswaModel = new Materi_siswaModel();
        $this->Tugas_siswaModel = new Tugas_siswaModel();
        $this->ChatmateriModel = new ChatmateriModel();
        $this->ChattugasModel = new ChattugasModel();
        $this->UjianModel = new UjianModel();
        $this->UjiandetailModel = new UjiandetailModel();
        $this->UjiansiswaModel = new UjiansiswaModel();
        $this->EssaydetailModel = new EssaydetailModel();
        $this->EssaysiswaModel = new EssaysiswaModel();
        $this->WaktuujianModel = new WaktuujianModel();

        date_default_timezone_set('Asia/Jakarta');

        $this->email = \Config\Services::email();
    }

    public function index()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => 'active',
            'expanded' => 'true'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['kelas'] = $this->KelasModel->asObject()->findAll();
        $data['mapel'] = $this->MapelModel->asObject()->findAll();
        // $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['ujian'] = $this->WaktuujianModel->getNotif(session()->get('id'));
        // $data['kelas'] = $this->SiswaModel->getAll();

        // foreach ($data['kelas'] as $key => $value) {
        //     if (session()->get('id') == $value->id_siswa) {
        //         $data['kelas'] = $data['kelas'][$key];
        //     }
        // }
        // echo "<pre>";
        // print_r($data);
        // // print_r(session()->get('id'));
        // echo "</pre>";
        // die();

        $data['tugas_siswa'] = $this->Tugas_siswaModel
            ->join('tugas', 'tugas.kode_tugas=tugas_siswa.tugas')
            ->where('tugas_siswa.siswa', session()->get('id'))
            ->where('tugas_siswa.date_send', null)
            ->get()->getResultObject();

        $data['materi_siswa'] = $this->Materi_siswaModel
            ->join('materi', 'materi.kode_materi=materi_siswa.materi')
            ->join('mapel', 'mapel.id_mapel=materi_siswa.mapel')
            ->where('materi_siswa.siswa', session()->get('id'))
            ->get()->getResultObject();

        $data['jumlah_materi_siswa'] = $this->MateriModel
            ->where('kelas', $data['siswa']->kelas)
            ->get()->getResultObject();

        $data['jumlah_tugas_siswa'] = $this->Tugas_siswaModel
            ->where('siswa', session()->get('id'))
            ->get()->getResultObject();

        $data['jumlah_tugas_siswa_selesai'] = $this->Tugas_siswaModel
            ->where('siswa', session()->get('id'))
            ->where('is_telat', 0)
            ->get()->getResultObject();

        $data['jumlah_tugas_siswa_telat'] = $this->Tugas_siswaModel
            ->where('siswa', session()->get('id'))
            ->where('is_telat', 1)
            ->get()->getResultObject();

        //     $materi = $this->MateriModel->getBykodeMateri('iYUuJGTc');
        //     $kelas = $this->KelasModel->asObject()->find($materi->kelas);
        //     $mapel = $this->MapelModel->asObject()->find($materi->mapel);            
        // echo "<pre>";
        // print_r($data['materi_siswa']);
        // // print_r($materi);
        // // print_r($kelas);
        // // print_r($mapel);
        // echo "</pre>";
        // die();
        return view('siswa/dashboard', $data);
    }

    // START::PROFILE
    public function profile()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];

        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));

        return view('siswa/profile', $data);
    }
    public function edit_profile()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $fileGambar = $this->request->getFile('avatar');

        // Cek Gambar, Apakah Tetap Gambar lama
        if ($fileGambar->getError() == 4) {
            $nama_gambar = $this->request->getVar('gambar_lama');
        } else {
            // Generate nama file Random
            $nama_gambar = $fileGambar->getRandomName();
            // Upload Gambar
            $fileGambar->move('assets/app-assets/user', $nama_gambar);
        }

        $this->SiswaModel->save([
            'id_siswa' => session()->get('id'),
            'nama_siswa' => $this->request->getVar('nama_siswa'),
            'avatar' => $nama_gambar
        ]);

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Profile telah diubah',
                type: 'success',
                padding: '2em'
            }); 
        ");
        return redirect()->to('siswa/profile');
    }
    public function edit_password()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $siswa = $this->SiswaModel->asObject()->find(session()->get('id'));

        if (password_verify($this->request->getVar('current_password'), $siswa->password)) {
            $this->SiswaModel->save([
                'id_siswa' => $siswa->id_siswa,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ]);
            session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Password telah diubah',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
            return redirect()->to('siswa/profile');
        } else {
            session()->setFlashdata('pesan', "
                        swal({
                            title: 'Oops..',
                            text: 'Current Password Salah',
                            type: 'error',
                            padding: '2em'
                            });
                        ");
            return redirect()->to('siswa/profile');
        }
    }
    // END::PROFILE

    // START::MATERI
    public function materi()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['materi'] = $this->MateriModel->getAllbyKelas($data['siswa']->kelas);
        return view('siswa/materi/list', $data);
    }
    public function lihat_materi($kode)
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['materi'] = $this->MateriModel->getBykodeMateri(decrypt_url($kode));
        $data['file'] = $this->FileModel->getAllByKode(decrypt_url($kode));

        if ($data['materi'] === null) {
            $data['materi'] = $this->MateriModel->getBykodeMateriAdmin(decrypt_url($kode));
        }

        $this->Materi_siswaModel
            ->where('materi', decrypt_url($kode))
            ->where('siswa', session()->get('id'))
            ->delete();

        return view('siswa/materi/lihat-materi', $data);
    }
    public function chat_materi()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kode_materi = $this->request->getVar('kode_materi');
            $chat_materi = $this->request->getVar('chat_materi');
            $user = $this->SiswaModel->asObject()->find(session('id'));

            $data = [
                'materi' => $kode_materi,
                'nama' => session()->get('nama'),
                'gambar' => $user->avatar,
                'email' => session()->get('email'),
                'text' => $chat_materi,
                'date_created' => time()
            ];

            $this->ChatmateriModel->save($data);
        }
    }
    public function get_chat_materi()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kode_materi = $this->request->getVar('kode_materi');
            $chat_materi = $this->ChatmateriModel->getAllByKodeMateri($kode_materi);

            foreach ($chat_materi as $chat) {
                if ($chat->email == session()->get('email')) {
                    echo '
                    <div class="media">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="' . base_url('assets/app-assets/user/') . '/' . $chat->gambar . '" class="rounded-circle" />
                        </div>
                        <div class="media-body ml-2">
                            <h5 class="media-heading"><span class="media-title"> ' . $chat->nama . ' <span class="badge badge-primary">You</span></h5>
                            <p class="media-text" style="white-space: pre-line; margin-top: -20px;">
                                ' . $chat->text . '
                            </p>
                            <hr>
                        </div>
                    </div>
                ';
                } else {
                    echo '
                    <div class="media">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="' . base_url('assets/app-assets/user/') . '/' . $chat->gambar . '" class="rounded-circle" />
                        </div>
                        <div class="media-body ml-2">
                            <h5 class="media-heading"><span class="media-title"> ' . $chat->nama . '</h5>
                            <p class="media-text" style="white-space: pre-line; margin-top: -20px;">
                                ' . $chat->text . '
                            </p>
                            <hr>
                        </div>
                    </div>
                ';
                }
            }
            exit;
        }
    }
    // END::MATERI

    // START::TUGAS
    public function tugas()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['tugas'] = $this->TugasModel->getAllByKelas($data['siswa']->kelas);
        return view('siswa/tugas/list', $data);
    }
    public function lihat_tugas($kode)
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['tugas'] = $this->TugasModel->getBykodeTugas(decrypt_url($kode));
        $data['guru'] = $this->GuruModel->asObject()->find($data['tugas']->guru);
        $data['tugas_siswa'] = $this->Tugas_siswaModel->getByKodeTugasAndSiswa(decrypt_url($kode), $data['siswa']->id_siswa);
        $data['file'] = $this->FileModel->getAllByKode(decrypt_url($kode));

        return view('siswa/tugas/lihat-tugas', $data);
    }
    public function get_chat_tugas()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kode_tugas = $this->request->getVar('kode_tugas');
            $chat_tugas = $this->ChattugasModel->getAllByKodeTugas($kode_tugas);

            foreach ($chat_tugas as $chat) {
                if ($chat->email == session()->get('email')) {
                    echo '
                    <div class="media">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="' . base_url('assets/app-assets/user/') . '/' . $chat->gambar . '" class="rounded-circle" />
                        </div>
                        <div class="media-body ml-2">
                            <h5 class="media-heading"><span class="media-title"> ' . $chat->nama . ' <span class="badge badge-primary">You</span></h5>
                            <p class="media-text" style="white-space: pre-line; margin-top: -20px;">
                                ' . $chat->text . '
                            </p>
                            <hr>
                        </div>
                    </div>
                ';
                } else {
                    echo '
                    <div class="media">
                        <div class="avatar avatar-sm avatar-indicators avatar-online">
                            <img alt="avatar" src="' . base_url('assets/app-assets/user/') . '/' . $chat->gambar . '" class="rounded-circle" />
                        </div>
                        <div class="media-body ml-2">
                            <h5 class="media-heading"><span class="media-title"> ' . $chat->nama . '</h5>
                            <p class="media-text" style="white-space: pre-line; margin-top: -20px;">
                                ' . $chat->text . '
                            </p>
                            <hr>
                        </div>
                    </div>
                ';
                }
            }
            exit;
        }
    }
    public function chat_tugas()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kode_tugas = $this->request->getVar('kode_tugas');
            $chat_tugas = $this->request->getVar('chat_tugas');
            $user = $this->SiswaModel->asObject()->find(session()->get('id'));

            $data = [
                'tugas' => $kode_tugas,
                'nama' => $user->nama_siswa,
                'email' => $user->email,
                'gambar' => $user->avatar,
                'text' => $chat_tugas,
                'date_created' => time()
            ];

            $this->ChattugasModel->save($data);
        }
    }
    public function kumpulkan()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $kode_tugas = $this->request->getVar('kode_tugas');
        $tugas = $this->TugasModel->getBykodeTugas($kode_tugas);
        $siswa = $this->SiswaModel->asObject()->find(session()->get('id'));
        $tugas_siswa = $this->Tugas_siswaModel->getByKodeTugasAndSiswa($kode_tugas, $siswa->id_siswa);

        $kode_file_siswa = null;
        if ($tugas_siswa->file_siswa == null) {
            $kode_file_siswa = random_string('alnum', 8);
        } else {
            $kode_file_siswa = $tugas_siswa->file_siswa;
        }
        // Cek Tugas Telat
        $telat = '';
        $waktu =  date('Y-m-d H:i', time());
        $batas = date($tugas->due_date);
        if (strtotime($waktu) > strtotime($batas)) {
            // echo "<b>Batas waktu sudah berakhir</b><br>";
            $telat = 1;
        } else {
            // echo "<b>Masih dalam jangka waktu</b><br>";
            $telat = 0;
        }


        // CEK APAKAH ADA FILE U=YANG DIPILIH
        $file_siswa = $this->request->getFileMultiple('file_siswa');
        if ($file_siswa[0]->getError() != 4) {
            $data_file_siswa = [];

            // FUNGSI UPLOAD FILE
            foreach ($file_siswa as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_file_siswa, [
                    'kode_file' => $kode_file_siswa,
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_file_siswa);
        }

        $this->Tugas_siswaModel
            ->set('text_siswa', $this->request->getVar('text_siswa'))
            ->set('file_siswa', $kode_file_siswa)
            ->set('date_send', time())
            ->set('is_telat', $telat)
            ->where('tugas', $kode_tugas)
            ->where('siswa', $siswa->id_siswa)
            ->update();

        session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Tugas telah dikerjakan',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        return redirect()->to('siswa/lihat_tugas/' . encrypt_url($tugas->kode_tugas));
    }
    // END::TUGAS

    // START::UJIAN

    // START = UJIAN PG
    public function ujian()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];


        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['ujian'] = $this->WaktuujianModel->getAllBySiswa(session()->get('id'));

        return view('siswa/ujian/list', $data);
    }
    public function lihat_pg($kode_ujian, $id_siswa)
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['ujian'] = $this->UjianModel->getBykode(decrypt_url($kode_ujian));
        $data['detail_ujian'] = $this->UjiandetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        $data['ujian_siswa'] = $this->UjiansiswaModel->cek_sudah_ujian(decrypt_url($kode_ujian), session()->get('id'));

        if ($data['ujian'] === null) {
            $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        }

        if (count($data['ujian_siswa']) == 0) {
            $pg_siswa = [];
            foreach ($data['detail_ujian'] as $soal) {
                array_push($pg_siswa, [
                    'ujian_id' => $soal->id_detail_ujian,
                    'ujian' => $soal->kode_ujian,
                    'siswa' => session()->get('id')
                ]);
            }

            $ujian = $data['ujian'];
            $timestamp = strtotime(date('Y-m-d H:i', time()));
            $waktu_berakhir =  date('Y-m-d H:i', strtotime("+$ujian->waktu_ujian minute", $timestamp));

            $waktu_ujian = [
                'waktu_berakhir' => $waktu_berakhir
            ];

            $this->WaktuujianModel
                ->set($waktu_ujian)
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->where('siswa_id', session()->get('id'))
                ->update();

            $this->UjiansiswaModel->insertBatch($pg_siswa);
        }

        $data['waktu_ujian'] = $this->WaktuujianModel->getBySiswa(decrypt_url($kode_ujian), session()->get('id'));

        $data['jawaban_benar'] = $this->UjiansiswaModel->benar(decrypt_url($kode_ujian), decrypt_url($id_siswa), 1);
        $data['jawaban_salah'] = $this->UjiansiswaModel->benar(decrypt_url($kode_ujian), decrypt_url($id_siswa), 0);
        $data['tidak_dijawab'] = $this->UjiansiswaModel->belum_terjawab(decrypt_url($kode_ujian), decrypt_url($id_siswa), null);

        return view('siswa/ujian/pg-lihat', $data);
    }
    public function simpan_pg()
    {
        if ($this->request->isAJAX()) {
            $id_detail_ujian = $this->request->getVar('idDetail');
            $id_pg = $this->request->getVar('id_pg');
            $jawaban = $this->request->getVar('jawaban');

            $soal = $this->UjiandetailModel->getById($id_detail_ujian);

            if ($jawaban == $soal->jawaban) {
                $benar = 1;
            } else {
                $benar = 0;
            }

            $data = [
                'jawaban' => $jawaban,
                'benar' => $benar
            ];

            try {
                $this->UjiansiswaModel
                    ->set($data)
                    ->where('id_ujian_siswa', $id_pg)
                    ->update();
                echo "jawaban dikirim";
            } catch (\Exception $exeption) {
                echo $exeption->getMessage();
            }
        }
    }
    public function ragu()
    {
        if ($this->request->isAJAX()) {
            if ($this->request->getVar('ragu') == '') {
                $ragu = Null;
            } else {
                $ragu = $this->request->getVar('ragu');
            }
            $this->UjiansiswaModel
                ->set('ragu', $ragu)
                ->where('id_ujian_siswa', $this->request->getVar('id_pg'))
                ->update();
        }
    }
    public function kirim_ujian()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $kode_ujian = $this->request->getVar('kode');
        $this->WaktuujianModel
            ->set('selesai', 1)
            ->where('kode_ujian', $kode_ujian)
            ->where('siswa_id', session()->get('id'))
            ->update();

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Ujian telah dikerjakan',
                type: 'success',
                padding: '2em'
            });
        ");
        return redirect()->to('siswa/lihat_pg/' . encrypt_url($kode_ujian) . '/' . encrypt_url(session()->get('id')));
    }
    // END = UJIAN PG

    // START = UJIAN ESSAY
    public function lihat_essay($kode_ujian, $id_siswa)
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_materi'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];


        $data['siswa'] = $this->SiswaModel->getById(session()->get('id'));
        $data['ujian'] = $this->UjianModel->getBykode(decrypt_url($kode_ujian));
        $data['essay_detail'] = $this->EssaydetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        $data['ujian_siswa'] = $this->EssaysiswaModel->getAllByUjianAndSiswa(decrypt_url($kode_ujian), session()->get('id'));

        if ($data['ujian'] === null) {
            $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        }

        if (count($data['ujian_siswa']) == 0) {
            $essay_siswa = [];
            foreach ($data['essay_detail'] as $soal) {
                array_push($essay_siswa, [
                    'essay_id' => $soal->id_essay_detail,
                    'ujian' => $soal->kode_ujian,
                    'siswa' => session()->get('id'),
                    'score' => 0,
                ]);
            }

            $ujian = $data['ujian'];
            $timestamp = strtotime(date('Y-m-d H:i', time()));
            $waktu_berakhir =  date('Y-m-d H:i', strtotime("+$ujian->waktu_ujian minute", $timestamp));

            $waktu_ujian = [
                'waktu_berakhir' => $waktu_berakhir
            ];

            $this->WaktuujianModel
                ->set($waktu_ujian)
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->where('siswa_id', session()->get('id'))
                ->update();

            $this->EssaysiswaModel->insertBatch($essay_siswa);
        }

        $data['waktu_ujian'] = $this->WaktuujianModel->getBySiswa(decrypt_url($kode_ujian), session()->get('id'));

        $data['essay_siswa'] = $this->EssaysiswaModel->getAllByUjianAndSiswa(decrypt_url($kode_ujian), session()->get('id'));

        return view('siswa/ujian/essay-lihat', $data);
    }
    public function simpan_essay()
    {
        // echo "<pre>";
        // print_r($this->request->getVar());
        // echo "</pre>";
        // die();

        if ($this->request->isAJAX()) {
            $id_essay = $this->request->getVar('id_essay');
            if ($this->request->getVar('jawaban') == '' || $this->request->getVar('jawaban') == null) {
                $jawaban = Null;
                $sudah_dikerjakan = Null;
            } else {
                $jawaban = $this->request->getVar('jawaban');
                $sudah_dikerjakan = 1;
            }
        // echo "<pre>";
        // print_r($jawaban);
        // echo "</pre>";
        // die();    

            $this->EssaysiswaModel
                ->set('jawaban', $jawaban)
                ->set('sudah_dikerjakan', $sudah_dikerjakan)
                ->where('id_essay_siswa', $id_essay)
                ->update();

            echo 'jawaban dikirim';
        }
    }
    public function ragu_essay()
    {
        if ($this->request->isAJAX()) {
            $id_essay = $this->request->getVar('id_essay');
            if ($this->request->getVar('ragu') == '') {
                $ragu = Null;
            } else {
                $ragu = $this->request->getVar('ragu');
            }

            $this->EssaysiswaModel
                ->set('ragu', $ragu)
                ->where('id_essay_siswa', $id_essay)
                ->update();

            echo 'Ragu clicked';
        }
    }
    public function kirim_essay()
    {
        // echo "<pre>";
        // print_r($this->request->getVar());
        // echo "</pre>";
        // die();

        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $kode_ujian = $this->request->getVar('kode');
        $siswa = session()->get('id');

        $this->WaktuujianModel
            ->set('selesai', 1)
            ->where('kode_ujian', $kode_ujian)
            ->where('siswa_id', $siswa)
            ->update();

        session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Ujian telah dikerjakan',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        return redirect()->to('siswa/lihat_essay/' . encrypt_url($kode_ujian) . '/' . encrypt_url($siswa));
    }
    // END = UJIAN ESSAY

    // END::UJIAN

    // START::SUMMERNOTE
    public function upload_summernote()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $fileGambar = $this->request->getFile('image');
        // Generate nama file Random
        $nama_gambar = $fileGambar->getRandomName();
        // Upload Gambar
        $fileGambar->move('assets/app-assets/file', $nama_gambar);

        echo base_url() . '/assets/app-assets/file/' . $nama_gambar;
    }

    function delete_image()
    {
        if (session()->get('role') != 2) {
            return redirect()->to('auth');
        }
        $src = $this->request->getVar('src');
        $file_name = str_replace(base_url() . '/', '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }
    // END::SUMMERNOTE

}
