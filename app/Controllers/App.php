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
use App\Models\Materi_siswaModel;
use App\Models\FileModel;
use App\Models\ChatmateriModel;
use App\Models\UjianModel;
use App\Models\UjiandetailModel;
use App\Models\UjiansiswaModel;
use App\Models\EssaydetailModel;
use App\Models\EssaysiswaModel;
use App\Models\WaktuujianModel;

class App extends BaseController
{
    protected $AdminModel;
    protected $SiswaModel;
    protected $GuruModel;
    protected $MapelModel;
    protected $KelasModel;
    protected $GurukelasModel;
    protected $GurumapelModel;
    protected $SmtpModel;
    protected $MateriModel;
    protected $TugasModel;
    protected $Materi_siswaModel;
    protected $FileModel;
    protected $ChatmateriModel;
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
        $this->Materi_siswaModel = new Materi_siswaModel();
        $this->FileModel = new FileModel();
        $this->ChatmateriModel = new ChatmateriModel();
        $this->UjianModel = new UjianModel();
        $this->UjiandetailModel = new UjiandetailModel();
        $this->UjiansiswaModel = new UjiansiswaModel();
        $this->EssaydetailModel = new EssaydetailModel();
        $this->EssaysiswaModel = new EssaysiswaModel();
        $this->WaktuujianModel = new WaktuujianModel();

        $this->email = \Config\Services::email();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => 'active',
            'expanded' => 'true'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['guru'] = $this->GuruModel->asObject()->findAll();
        $data['guru_aktif'] = $this->GuruModel
            ->where('is_active', 1)
            ->get()->getResultObject();
        $data['guru_tidak_aktif'] = $this->GuruModel
            ->where('is_active', 0)
            ->get()->getResultObject();

        $data['siswa'] = $this->SiswaModel->asObject()->findAll();
        $data['siswa_aktif'] = $this->SiswaModel
            ->where('is_active', 1)
            ->get()->getResultObject();

        $data['siswa_tidak_aktif'] = $this->SiswaModel
            ->where('is_active', 0)
            ->get()->getResultObject();

        $data['kelas'] = $this->KelasModel->asObject()->findAll();
        $data['mapel'] = $this->MapelModel->asObject()->findAll();
        $data['admin'] = $this->AdminModel->asObject()->first();

        return view('admin/dashboard', $data);
    }

    // START::PROFILE & SETTING
    public function profile()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['admin'] = $this->AdminModel->asObject()->first();
        $data['smtp'] = $this->SmtpModel->asObject()->first();

        return view('admin/profile-setting', $data);
    }
    public function edit_profile()
    {
        if (session()->get('role') != 1) {
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
            // hapus File Yang Lama
            if ($this->request->getVar('gambar_lama') != 'default.jpg') {
                unlink('assets/app-assets/user/' . $this->request->getVar('gambar_lama'));
            }
        }

        $this->AdminModel->save([
            'id_admin' => session()->get('id'),
            'nama_admin' => $this->request->getVar('nama_admin'),
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
        return redirect()->to('app/profile');
    }
    public function edit_password()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $admin = $this->AdminModel->asObject()->find(session()->get('id'));

        if (password_verify($this->request->getVar('current_password'), $admin->password)) {
            $this->AdminModel->save([
                'id_admin' => $admin->id_admin,
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
            return redirect()->to('app/profile');
        } else {
            session()->setFlashdata('pesan', "
                        swal({
                            title: 'Oops..',
                            text: 'Current Password Salah',
                            type: 'error',
                            padding: '2em'
                            });
                        ");
            return redirect()->to('app/profile');
        }
    }
    public function smtp_mail()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $this->SmtpModel->save([
            'id_mail' => $this->request->getVar('id_mail'),
            'smtp_host' => $this->request->getVar('smtp_host'),
            'smtp_user' => $this->request->getVar('smtp_user'),
            'smtp_pass' => $this->request->getVar('smtp_pass'),
            'smtp_port' => $this->request->getVar('smtp_port'),
            'smtp_crypto' => $this->request->getVar('smtp_crypto'),
        ]);

        session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'SMTP email telah diubah',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        return redirect()->to('app/profile');
    }
    public function setting_email()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }

        $this->SmtpModel->save([
            'id_mail' => $this->request->getVar('id_mail'),
            'notif_akun' => $this->request->getVar('notif_akun'),
            'notif_materi' => $this->request->getVar('notif_materi'),
            'notif_tugas' => $this->request->getVar('notif_tugas'),
            'notif_ujian' => $this->request->getVar('notif_ujian'),
        ]);

        session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Notifikasi email telah diubah',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        return redirect()->to('app/profile');
    }
    // END::PROFILE & SETTING

    // START::KELAS
    public function kelas()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        // END MENU DATA
        // ================================================

        // MASTER DATA
        $data['kelas'] = $this->KelasModel->asObject()->findAll();
        $data['admin'] = $this->AdminModel->asObject()->first();

        return view('admin/kelas/list', $data);
    }
    public function tambah_kelas()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // Ambil data yang dikirim dari form
        $nama_kelas = $this->request->getVar('nama_kelas');
        $data_kelas = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($nama_kelas as $nama) { // Kita buat perulangan berdasarkan nama_kelas sampai data terakhir
            array_push($data_kelas, array(
                'nama_kelas' => $nama,
            ));

            $index++;
        }

        $sql = $this->KelasModel->insertBatch($data_kelas);

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data disimpan',
                    type: 'success',
                    padding: '2em'
                    })
                ");
            return redirect()->to('app/kelas');
        } else { // Jika gagal
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Error!',
                    text: 'gagal disimpan',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('app/kelas');
        }
    }
    public function edit_kelas()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kelas = decrypt_url($this->request->getVar('id_kelas'));
            $data_kelas = $this->KelasModel->asObject()->find($kelas);
            echo json_encode($data_kelas);
        }
    }
    public function edit_kelas_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_kelas = $this->request->getVar('id_kelas');
        $nama_kelas = $this->request->getVar('nama_kelas');

        $this->KelasModel->save([
            'id_kelas' => $id_kelas,
            'nama_kelas' => $nama_kelas
        ]);

        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'nama kelas diubah',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/kelas');
    }
    public function hapus_kelas($id = '')
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_kelas = decrypt_url($id);
        $this->KelasModel->delete($id_kelas);

        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data dihapus',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/kelas');
    }
    // END::KELAS

    // START::mapel
    public function mapel()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        // END MENU DATA
        // ================================================

        // MASTER DATA
        $data['mapel'] = $this->MapelModel->asObject()->findAll();
        $data['admin'] = $this->AdminModel->asObject()->first();
        return view('admin/mapel/list', $data);
    }
    public function tambah_mapel()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // Ambil data yang dikirim dari form
        $nama_mapel = $this->request->getVar('nama_mapel');
        $data_mapel = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($nama_mapel as $nama) { // Kita buat perulangan berdasarkan nama_mapel sampai data terakhir
            array_push($data_mapel, array(
                'nama_mapel' => $nama,
            ));

            $index++;
        }

        $sql = $this->MapelModel->insertBatch($data_mapel);

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data disimpan',
                    type: 'success',
                    padding: '2em'
                    })
                ");
            return redirect()->to('app/mapel');
        } else { // Jika gagal
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Error!',
                    text: 'gagal disimpan',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('app/mapel');
        }
    }
    public function edit_mapel()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $mapel = decrypt_url($this->request->getVar('id_mapel'));
            $data_mapel = $this->MapelModel->asObject()->find($mapel);
            echo json_encode($data_mapel);
        }
    }
    public function edit_mapel_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_mapel = $this->request->getVar('id_mapel');
        $nama_mapel = $this->request->getVar('nama_mapel');

        $this->MapelModel->save([
            'id_mapel' => $id_mapel,
            'nama_mapel' => $nama_mapel
        ]);

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'nama mapel diubah',
                type: 'success',
                padding: '2em'
                })
        ");
        return redirect()->to('app/mapel');
    }
    public function hapus_mapel($id = '')
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_mapel = decrypt_url($id);
        $this->MapelModel->delete($id_mapel);
        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data dihapus',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/mapel');
    }
    // END::MAPEL

    // START::SISWA
    public function siswa()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => 'active',
            'expanded' => 'true',
            'collapse' => 'show'
        ];
        $data['sub_master'] = [
            'siswa' => 'active',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        // END MENU DATA
        // ================================================

        // MASTER DATA
        $data['siswa'] = $this->SiswaModel->getAll();
        $data['kelas'] = $this->KelasModel->asObject()->findAll();
        $data['admin'] = $this->AdminModel->asObject()->first();

        return view('admin/siswa/list', $data);
    }
    public function tambah_siswa()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $smtp = $this->SmtpModel->asObject()->first();
        // Ambil data yang dikirim dari form
        $nama_siswa = $this->request->getVar('nama_siswa');
        $data_siswa = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($nama_siswa as $nama) { // Kita buat perulangan berdasarkan nama_siswa sampai data terakhir
            $kelas = $this->KelasModel->asObject()->find($this->request->getVar('kelas')[$index]);
            array_push($data_siswa, array(
                'no_induk_siswa' => $this->request->getVar('nis')[$index],
                'nama_siswa' => $nama,
                'email' => $this->request->getVar('email')[$index],
                'password' => password_hash($this->request->getVar('nis')[$index], PASSWORD_DEFAULT),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin')[$index],
                'kelas' => $this->request->getVar('kelas')[$index],
                'role' => 2,
                'is_active' => 1,
                'date_created' => time(),
                'avatar' => 'default.jpg'
            ));

            // KIRIM EMAIL
            if ($smtp->notif_akun == 1) {
                $config['SMTPHost'] = $smtp->smtp_host;
                $config['SMTPUser'] = $smtp->smtp_user;
                $config['SMTPPass'] = $smtp->smtp_pass;
                $config['SMTPPort'] = $smtp->smtp_port;
                $config['SMTPCrypto'] = $smtp->smtp_crypto;
                $config['mailType'] = 'html';

                $this->email->initialize($config);

                $this->email->setNewline("\r\n");

                $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
                $this->email->setTo($this->request->getVar('email')[$index]);

                $this->email->setSubject('Akun UJIAN CBT');
                $this->email->setMessage('
                    <div style="color: #000; padding: 10px;">
                        <div
                            style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                            UJIAN CBT</div>
                        <small style="color: #000;">by Coding Center</small>
                        <br>
                        <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $nama . ' <br>
                            <span style="color: #000;">Admin telah menambahkan anda kedalam aplikasi UJIAN CBT</span></p>
                        <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                            <tr>
                                <td>NAMA</td>
                                <td> : ' . $nama . '</td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td> : ' . $this->request->getVar('email')[$index] . '</td>
                            </tr>
                            <tr>
                                <td>KELAS</td>
                                <td> : ' . $kelas->nama_kelas . '</td>
                            </tr>
                            <tr>
                                <td>PASSWORD</td>
                                <td> : ' . $this->request->getVar('nis')[$index] . '</td>
                            </tr>
                        </table>
                        <br>
                        <a href="' . base_url('auth') . '"
                            style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                            In
                            Now!
                        </a>
                    </div>
                ');

                if (!$this->email->send()) {
                    echo $this->email->printDebugger();
                    die();
                }
            }

            $index++;
        }

        // dd($data_siswa);

        $this->SiswaModel->insertBatch($data_siswa);

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'data disimpan',
                type: 'success',
                padding: '2em'
                })
            ");
        return redirect()->to('app/siswa');
    }
    public function edit_siswa()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $siswa = decrypt_url($this->request->getVar('id_siswa'));
            $data_siswa = $this->SiswaModel->asObject()->find($siswa);
            echo json_encode($data_siswa);
        }
    }
    public function edit_siswa_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_siswa = $this->request->getVar('id_siswa');
        $email = $this->request->getVar('email');
        $nama_siswa = $this->request->getVar('nama_siswa');
        $kelas = $this->request->getVar('kelas');
        $active = $this->request->getVar('active');
        $status_member = $this->request->getVar('status_member');

        $this->SiswaModel
            ->where('id_siswa', $id_siswa)
            ->set('nama_siswa', $nama_siswa)
            ->set('email', $email)
            ->set('kelas', $kelas)
            ->set('is_active', $active)
            ->set('status_member', $status_member)
            ->update();

        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data siswa diubah',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/siswa');
    }
    public function hapus_siswa($id = '')
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_siswa = decrypt_url($id);
        $this->SiswaModel->delete($id_siswa);
        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data dihapus',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/siswa');
    }
    // END::SISWA

    // START::GURU
    public function guru()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => 'active',
            'expanded' => 'true',
            'collapse' => 'show'
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => 'active'
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        // END MENU DATA
        // ================================================

        // MASTER DATA
        $data['guru'] = $this->GuruModel->asObject()->findAll();
        $data['admin'] = $this->AdminModel->asObject()->first();
        return view('admin/guru/list', $data);
    }
    public function tambah_guru()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $smtp = $this->SmtpModel->asObject()->first();
        // Ambil data yang dikirim dari form
        $nama_guru = $this->request->getVar('nama_guru');
        $data_guru = array();

        $index = 0; // Set index array awal dengan 0
        foreach ($nama_guru as $nama) { // Kita buat perulangan berdasarkan nama_guru sampai data terakhir
            $pwd_guru = 123;
            array_push($data_guru, array(
                'nama_guru' => $nama,
                'email' => $this->request->getVar('email')[$index],
                'password' => password_hash($pwd_guru, PASSWORD_DEFAULT),
                'role' => 3,
                'is_active' => 1,
                'date_created' => time(),
                'avatar' => 'default.jpg'
            ));

            // KIRIM EMAIL
            if ($smtp->notif_akun == 1) {
                $config['SMTPHost'] = $smtp->smtp_host;
                $config['SMTPUser'] = $smtp->smtp_user;
                $config['SMTPPass'] = $smtp->smtp_pass;
                $config['SMTPPort'] = $smtp->smtp_port;
                $config['SMTPCrypto'] = $smtp->smtp_crypto;
                $config['mailType'] = 'html';

                $this->email->initialize($config);

                $this->email->setNewline("\r\n");

                $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
                $this->email->setTo($this->request->getVar('email')[$index]);

                $this->email->setSubject('Akun CBT-MALELA');
                $this->email->setMessage('
                    <div style="color: #000; padding: 10px;">
                        <div
                            style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                            UJIAN CBT</div>
                        <small style="color: #000;">by Coding Center</small>
                        <br>
                        <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $nama . ' <br>
                            <span style="color: #000;">Admin telah menambahkan anda kedalam aplikasi UJIAN CBT</span></p>
                        <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                            <tr>
                                <td>NAMA</td>
                                <td style="text-transform: uppercase;"> : ' . $nama . '</td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td> : ' . $this->request->getVar('email')[$index] . '</td>
                            </tr>
                            <tr>
                                <td>ROLE</td>
                                <td> : GURU</td>
                            </tr>
                            <tr>
                                <td>PASSWORD</td>
                                <td> : ' . $pwd_guru . '</td>
                            </tr>
                            <tr>
                                <td>STATUS AKUN</td>
                                <td> : AKTIF</td>
                            </tr>
                        </table>
                        <br>
                        <a href="' . base_url('auth') . '"
                            style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                            In
                            Now!
                        </a>
                    </div>
                ');

                if (!$this->email->send()) {
                    echo $this->email->printDebugger();
                    die();
                }
            }

            $index++;
        }

        $sql = $this->GuruModel->insertBatch($data_guru);

        // Cek apakah query insert nya sukses atau gagal
        if ($sql) { // Jika sukses
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data disimpan',
                    type: 'success',
                    padding: '2em'
                    })
                ");
            return redirect()->to('app/guru');
        } else { // Jika gagal
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Error!',
                    text: 'gagal disimpan',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('app/guru');
        }
    }
    public function edit_guru()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $guru = decrypt_url($this->request->getVar('id_guru'));
            $data_guru = $this->GuruModel->asObject()->find($guru);
            echo json_encode($data_guru);
        }
    }
    public function edit_guru_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_guru = $this->request->getVar('id_guru');
        $nama_guru = $this->request->getVar('nama_guru');
        $email = $this->request->getVar('email');
        $active = $this->request->getVar('active');

        $this->GuruModel->save([
            'id_guru' => $id_guru,
            'nama_guru' => $nama_guru,
            'email' => $email,
            'is_active' => $active
        ]);

        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data guru diubah',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/guru');
    }
    public function hapus_guru($id = '')
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_guru = decrypt_url($id);
        $this->GuruModel->delete($id_guru);
        session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data dihapus',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        return redirect()->to('app/guru');
    }
    // END::GURU

    // START::RELASI
    public function relasi()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => 'active',
            'expanded' => 'true',
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
        $data['guru'] = $this->GuruModel->asObject()->findAll();
        $data['admin'] = $this->AdminModel->asObject()->first();
        
        $adm = $data['admin'];
        $admin = (object)[
            'id_guru' => $adm->id_admin,
            'nama_guru' => $adm->nama_admin,
            'email' => $adm->email,
            'password' => $adm->password,
            'role' => $adm->role,
            'is_active' => $adm->is_active,
            'date_created' => $adm->date_created,
            'avatar' => $adm->avatar,
            'guru_kelas' => '',
            'guru_mapel' => '' 
        ];
        $data['guru'][] = $admin;

        return view('admin/guru/list-relasi', $data);
    }
    public function atur_relasi($id = '')
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => 'active',
            'expanded' => 'true',
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

        $id_guru = decrypt_url($id);
        $data['kelas'] = $this->KelasModel->asObject()->findAll();
        $data['mapel'] = $this->MapelModel->asObject()->findAll();
        $data['guru'] = $this->GuruModel->asObject()->find($id_guru);
        $data['admin'] = $this->AdminModel->asObject()->first();

        if ($data['guru'] === null) {
            $adm = $data['admin'];
            $admin = (object)[
                'id_guru' => $adm->id_admin,
                'nama_guru' => $adm->nama_admin,
                'email' => $adm->email,
                'password' => $adm->password,
                'role' => $adm->role,
                'is_active' => $adm->is_active,
                'date_created' => $adm->date_created,
                'avatar' => $adm->avatar,
                'guru_kelas' => '',
                'guru_mapel' => '' 
            ];
            $data['guru'] = $admin;
        }

        return view('admin/guru/relasi', $data);
    }
    public function guru_kelas()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $id_guru = decrypt_url($this->request->getVar('id_guru'));
            $id_kelas = $this->request->getVar('id_kelas');

            $kelass = $this->KelasModel->find($id_kelas);
            $kelas = $kelass['nama_kelas'];


            $data = [
                'guru' => $id_guru,
                'kelas' => $id_kelas,
                'nama_kelas' => $kelas
            ];

            $result = $this->GurukelasModel->getALLByGuruAndKelas($id_guru, $id_kelas);

            if (count($result) < 1) {
                $this->GurukelasModel->save($data);
            } else {
                $this->GurukelasModel
                    ->where('guru', $id_guru)
                    ->where('kelas', $id_kelas)
                    ->delete();
            }

            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data diubah',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        }
    }
    public function guru_mapel()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $id_guru = decrypt_url($this->request->getVar('id_guru'));
            $id_mapel = $this->request->getVar('id_mapel');

            $mapels = $this->MapelModel->find($id_mapel);
            $mapel = $mapels['nama_mapel'];


            $data = [
                'guru' => $id_guru,
                'mapel' => $id_mapel,
                'nama_mapel' => $mapel
            ];

            $result = $this->GurumapelModel->getALLByGuruAndMapel($id_guru, $id_mapel);

            if (count($result) < 1) {
                $this->GurumapelModel->save($data);
            } else {
                $this->GurumapelModel
                    ->where('guru', $id_guru)
                    ->where('mapel', $id_mapel)
                    ->delete();
            }

            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'data diubah',
                    type: 'success',
                    padding: '2em'
                    })
                ");
        }
    }
    // END::RELASI

    // START::MATERI
    public function materi()
    {
        // if (session()->get('role') != 3) {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['admin'] = $this->AdminModel->asObject()->first();

        $data['materi'] = $this->MateriModel->getAllByGuru(session()->get('id'));

        $data['guru_mapel'] = $this->GurumapelModel->getALLByGuru(session()->get('id'));
        $data['guru_kelas'] = $this->GurukelasModel->getALLByGuru(session()->get('id'));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));

        return view('admin/materi/list', $data);
    }
    public function tambah_materi()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $data_materi = [
            'kode_materi' => $this->request->getVar('kode_materi'),
            'nama_materi' => $this->request->getVar('nama_materi'),
            'guru' => session()->get('id'),
            'mapel' => $this->request->getVar('mapel'),
            'kelas' => $this->request->getVar('kelas'),
            'text_materi' => $this->request->getVar('text_materi'),
            'date_created' => time()
        ];

        $mapel = $this->MapelModel->asObject()->find($this->request->getVar('mapel'));
        
        $siswa = $this->SiswaModel
        ->where('kelas', $this->request->getVar('kelas'))
        ->get()->getResultObject();

        if (count($siswa) == 0) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Belum ada siswa dikelas ini',
                    type: 'error',
                    padding: '2em'
                    });
                ");
            return redirect()->to('app/materi');
        }

        // Kirim Email Ke siswa
        $data_email_siswa = '';
        $smtp = $this->SmtpModel->asObject()->first();

        if ($smtp->notif_materi == 1) {

            foreach ($siswa as $s) {
                $data_email_siswa .= $s->email . ',';
            }

            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($data_email_siswa);

            $this->email->setSubject('Materi');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div
                        style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT
                    </div>
                    <small style="color: #000;">by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo para peserta <br>
                        <span style="color: #000;">' . session()->get('nama') . ' memposting materi baru</span></p>
                    <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                        <tr>
                            <td>Material</td>
                            <td> : ' . $this->request->getVar('nama_materi') . '</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td> : ' . $mapel->nama_mapel . '</td>
                        </tr>
                    </table>
                    <br>
                    <a href="' . base_url('auth') . '"
                        style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                        In
                        Now!
                    </a>
                </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            }
        }


        // CEK APAKAH ADA FILE U=YANG DIPILIH
        $file_materi = $this->request->getFileMultiple('file_materi');
        if ($file_materi[0]->getError() != 4) {
            $data_file_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($file_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_file_materi, [
                    'kode_file' => $this->request->getVar('kode_materi'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_file_materi);
        }

        $video_materi = $this->request->getFileMultiple('video_materi');
        if ($video_materi[0]->getError() != 4) {
            $data_video_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($video_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_video_materi, [
                    'kode_file' => $this->request->getVar('kode_materi'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_video_materi);
        }

        $siswa_materi = [];
        foreach ($siswa as $s2) {
            array_push($siswa_materi, array(
                'materi' => $this->request->getVar('kode_materi'),
                'kelas' => $this->request->getVar('kelas'),
                'mapel' => $this->request->getVar('mapel'),
                'siswa' => $s2->id_siswa,
                'dilihat' => 0
            ));
        }

        // INSERT DATA MATERI
        $this->MateriModel->save($data_materi);
        // INSERT DATA MATERI SISWA
        $this->Materi_siswaModel->insertBatch($siswa_materi);

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Materi telah dibuat',
                type: 'success',
                padding: '2em'
                });
            ");
        return redirect()->to('app/materi');
    }
    public function lihat_materi($id)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $id_materi = decrypt_url($id);

        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['materi'] = $this->MateriModel->getById($id_materi);
        $data['admin'] = $this->AdminModel->asObject()->find(session()->get('id'));
        $data['file'] = $this->FileModel->getAllByKode($data['materi']->kode_materi);

        return view('admin/materi/lihat-materi', $data);
    }
    public function edit_materi()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $materi = decrypt_url($this->request->getVar('id_materi'));
            $data_materi = $this->MateriModel->asObject()->find($materi);
            echo json_encode($data_materi);
        }
    }
    public function edit_materi_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $kode_materi = $this->request->getVar('e_kode_materi');

        // CEK APAKAH ADA FILE U=YANG DIPILIH
        $file_materi = $this->request->getFileMultiple('e_file_materi');
        if ($file_materi[0]->getError() != 4) {
            $data_file_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($file_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_file_materi, [
                    'kode_file' => $this->request->getVar('e_kode_materi'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_file_materi);
        }

        $video_materi = $this->request->getFileMultiple('e_video_materi');
        if ($video_materi[0]->getError() != 4) {
            $data_video_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($video_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_video_materi, [
                    'kode_file' => $this->request->getVar('e_kode_materi'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_video_materi);
        }

        $this->MateriModel
            ->set('nama_materi', $this->request->getVar('e_nama_materi'))
            ->set('mapel', $this->request->getVar('e_mapel'))
            ->set('kelas', $this->request->getVar('e_kelas'))
            ->set('text_materi', $this->request->getVar('e_text_materi'))
            ->where('kode_materi', $kode_materi)
            ->update();


        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Materi telah diupdate',
                type: 'success',
                padding: '2em'
                });
            ");
        return redirect()->to('app/materi');
    }
    public function chat_materi()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kode_materi = $this->request->getVar('kode_materi');
            $chat_materi = $this->request->getVar('chat_materi');
            $user = $this->GuruModel->asObject()->find(session('id'));

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
        if (session()->get('role') != 1) {
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
    public function hapus_materi($kode_materi)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $this->FileModel
            ->where('kode_file', decrypt_url($kode_materi))
            ->delete();

        $this->MateriModel
            ->where('kode_materi', decrypt_url($kode_materi))
            ->delete();

        $this->ChatmateriModel
            ->where('materi', decrypt_url($kode_materi))
            ->delete();

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Materi telah di hapus',
                type: 'success',
                padding: '2em'
                });
            ");
        return redirect()->to('app/materi');
    }
    // END::MATERI

    // START::TUGAS
    public function tugas()
    {
        if (session()->get('role') != 1) {
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

        $data['tugas'] = $this->TugasModel->getAllByGuru(session()->get('id'));

        $data['guru_kelas'] = $this->GurukelasModel->getALLByGuru(session()->get('id'));
        $data['guru_mapel'] = $this->GurumapelModel->getALLByGuru(session()->get('id'));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));

        return view('admin/tugas/list', $data);
    }
    public function tambah_tugas()
    {
        if (session()->get('role') != 3) {
            return redirect()->to('auth');
        }
        $data_tugas = [
            'kode_tugas' => $this->request->getVar('kode_tugas'),
            'kelas' => $this->request->getVar('kelas'),
            'mapel' => $this->request->getVar('mapel'),
            'guru' => session()->get('id'),
            'nama_tugas' => $this->request->getVar('nama_tugas'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'date_created' => time(),
            'due_date' => $this->request->getVar('tgl') . ' ' . $this->request->getVar('jam')
        ];
        $mapel = $this->MapelModel->asObject()->find($this->request->getVar('mapel'));

        $siswa = $this->SiswaModel
            ->where('kelas', $this->request->getVar('kelas'))
            ->get()->getResultObject();

        if (count($siswa) == 0) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Belum ada siswa dikelas ini',
                    type: 'error',
                    padding: '2em'
                    });
                ");
            return redirect()->to('app/tugas');
        }

        // Kirim Email Ke siswa
        $data_email_siswa = '';
        $siswa_tugas = [];
        $smtp = $this->SmtpModel->asObject()->first();
        foreach ($siswa as $s) {
            $data_email_siswa .= $s->email . ',';
            array_push($siswa_tugas, array(
                'tugas' => $this->request->getVar('kode_tugas'),
                'siswa' => $s->id_siswa
            ));
        }

        if ($smtp->notif_tugas == 1) {

            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($data_email_siswa);

            $this->email->setSubject('Tugas');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div
                        style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT
                    </div>
                    <small style="color: #000;">by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo para peserta <br>
                        <span style="color: #000;">' . session()->get('nama') . ' memposting Tugas baru</span></p>
                    <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                        <tr>
                            <td>Tugas</td>
                            <td> : ' . $this->request->getVar('nama_tugas') . '</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td> : ' . $mapel->nama_mapel . '</td>
                        </tr>
                        <tr>
                            <td>Due Date</td>
                            <td> : ' . $data_tugas['due_date'] . '</td>
                        </tr>
                    </table>
                    <br>
                    <a href="' . base_url('auth') . '"
                        style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                        In
                        Now!
                    </a>
                </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            }
        }


        // CEK APAKAH ADA FILE U=YANG DIPILIH
        $file_materi = $this->request->getFileMultiple('file_materi');
        if ($file_materi[0]->getError() != 4) {
            $data_file_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($file_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_file_materi, [
                    'kode_file' => $this->request->getVar('kode_tugas'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_file_materi);
        }

        $video_materi = $this->request->getFileMultiple('video_materi');
        if ($video_materi[0]->getError() != 4) {
            $data_video_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($video_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_video_materi, [
                    'kode_file' => $this->request->getVar('kode_tugas'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_video_materi);
        }

        // INSERT DATA TUGAS
        $this->TugasModel->save($data_tugas);
        // INSERT DATA TUGAS SISWA
        $this->Tugas_siswaModel->insertBatch($siswa_tugas);

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Tugas telah dibuat',
                type: 'success',
                padding: '2em'
                });
            ");
        return redirect()->to('app/tugas');
    }
    public function edit_tugas()
    {
        if (session()->get('role') != 3) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $tugas = decrypt_url($this->request->getVar('id_tugas'));
            $data_tugas = $this->TugasModel->asObject()->find($tugas);
            echo json_encode($data_tugas);
        }
    }
    public function edit_tugas_()
    {
        if (session()->get('role') != 3) {
            return redirect()->to('auth');
        }
        $kode_tugas = $this->request->getVar('e_kode_tugas');

        // CEK APAKAH ADA FILE U=YANG DIPILIH
        $file_materi = $this->request->getFileMultiple('e_file_materi');
        if ($file_materi[0]->getError() != 4) {
            $data_file_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($file_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_file_materi, [
                    'kode_file' => $this->request->getVar('e_kode_tugas'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_file_materi);
        }

        $video_materi = $this->request->getFileMultiple('e_video_materi');
        if ($video_materi[0]->getError() != 4) {
            $data_video_materi = [];

            // FUNGSI UPLOAD FILE
            foreach ($video_materi as $file) {
                // Generate nama file Random
                $nama_file = str_replace(' ', '_', $file->getName());
                // Upload Gambar
                $file->move('assets/app-assets/file', $nama_file);

                array_push($data_video_materi, [
                    'kode_file' => $this->request->getVar('e_kode_tugas'),
                    'nama_file' => $nama_file
                ]);
            }

            $this->FileModel->insertBatch($data_video_materi);
        }

        $this->TugasModel
            ->set('nama_tugas', $this->request->getVar('e_nama_tugas'))
            ->set('mapel', $this->request->getVar('e_mapel'))
            ->set('kelas', $this->request->getVar('e_kelas'))
            ->set('deskripsi', $this->request->getVar('e_deskripsi'))
            ->set('due_date', $this->request->getVar('e_tgl') . ' ' . $this->request->getVar('e_jam'))
            ->where('kode_tugas', $kode_tugas)
            ->update();


        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Tugas telah diupdate',
                type: 'success',
                padding: '2em'
                });
            ");
        return redirect()->to('app/tugas');
    }
    public function lihat_tugas($data_kode_tugas, $data_id_guru)
    {
        if (session()->get('role') != 3) {
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

        $data['tugas'] = $this->TugasModel->getBykodeTugas(decrypt_url($data_kode_tugas));
        // dd(decrypt_url($data_kode_tugas));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));

        $data['file'] = $this->FileModel->getAllByKode(decrypt_url($data_kode_tugas));
        $data['tugas_siswa'] = $this->Tugas_siswaModel->getAllByKodeTugas(decrypt_url($data_kode_tugas));

        return view('admin/tugas/lihat-tugas', $data);
    }
    public function get_chat_tugas()
    {
        if (session()->get('role') != 3) {
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
        if (session()->get('role') != 3) {
            return redirect()->to('auth');
        }
        if ($this->request->isAJAX()) {
            $kode_tugas = $this->request->getVar('kode_tugas');
            $chat_tugas = $this->request->getVar('chat_tugas');
            $user = $this->GuruModel->asObject()->find(session()->get('id'));

            $data = [
                'tugas' => $kode_tugas,
                'nama' => $user->nama_guru,
                'email' => $user->email,
                'gambar' => $user->avatar,
                'text' => $chat_tugas,
                'date_created' => time()
            ];

            $this->ChattugasModel->save($data);
        }
    }
    public function tugas_siswa($kode_tugas, $id_siswa)
    {
        if (session()->get('role') != 3) {
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

        $data['siswa'] = $this->SiswaModel->asObject()->find(decrypt_url($id_siswa));

        $data['tugas_siswa'] = $this->Tugas_siswaModel
            ->where('tugas', decrypt_url($kode_tugas))
            ->where('siswa', decrypt_url($id_siswa))
            ->get()->getRowObject();

        $data['tugas'] = $this->TugasModel->getBykodeTugas(decrypt_url($kode_tugas));
        $data['file'] = $this->FileModel->getAllByKode($data['tugas_siswa']->file_siswa);
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));

        return view('admin/tugas/tugas-siswa', $data);
    }
    public function nilai_tugas()
    {
        if (session()->get('role') != 3) {
            return redirect()->to('auth');
        }
        $this->Tugas_siswaModel
            ->set('nilai', $this->request->getVar('nilai'))
            ->set('catatan_guru', $this->request->getVar('catatan_guru'))
            ->where('tugas', $this->request->getVar('tugas'))
            ->where('siswa', $this->request->getVar('siswa'))
            ->update();

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Tugas telah Dinilai',
                type: 'success',
                padding: '2em'
                });
        ");
        return redirect()->to('app/lihat_tugas/' .  encrypt_url($this->request->getVar('tugas')) . '/' . encrypt_url($this->request->getVar('siswa')));
    }
    public function hapus_tugas($kode_tugas)
    {
        if (session()->get('role') != 3) {
            return redirect()->to('auth');
        }
        $this->FileModel
            ->where('kode_file', decrypt_url($kode_tugas))
            ->delete();

        $this->ChattugasModel
            ->where('tugas', decrypt_url($kode_tugas))
            ->delete();

        $this->Tugas_siswaModel
            ->where('tugas', decrypt_url($kode_tugas))
            ->delete();

        $this->TugasModel
            ->where('kode_tugas', decrypt_url($kode_tugas))
            ->delete();

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Tugas telah di hapus',
                type: 'success',
                padding: '2em'
                });
            ");
        return redirect()->to('app/tugas');
    }
    // END::TUGAS

    // START::UJIAN

    // START = UJIAN PG
    public function ujian()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        
        $data['admin'] = $this->AdminModel->asObject()->first();

        // $data['ujian'] = $this->UjianModel->getAllBykodeGuru(session()->get('id'));
        $data['ujian'] = $this->UjianModel->getAllBykodeAdmin(session()->get('id'));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));

        return view('admin/ujian/list', $data);
    }
    public function tambah_pg()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['admin'] = $this->AdminModel->asObject()->first();

        $data['guru_kelas'] = $this->GurukelasModel->getALLByGuru(session()->get('id'));
        $data['guru_mapel'] = $this->GurumapelModel->getALLByGuru(session()->get('id'));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));
        return view('admin/ujian/tambah_pg', $data);
    }
    public function tambah_pg_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $siswa = $this->SiswaModel->getAllbyKelas($this->request->getVar('kelas'));
        $guru = $this->GuruModel->asObject()->find(session()->get('id'));
        if (count($siswa) == 0) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Belum ada siswa dikelas ini',
                    type: 'error',
                    padding: '2em'
                    });
            ");
            return redirect()->to('app/ujian');
        }

        // DATA UJIAN
        $kode_ujian = random_string('alnum', 10);
        $data_ujian = [
            'kode_ujian' => $kode_ujian,
            'nama_ujian' => $this->request->getVar('nama_ujian'),
            'guru' => session()->get('id'),
            'kelas' => $this->request->getVar('kelas'),
            'mapel' => $this->request->getVar('mapel'),
            'date_created' => time(),
            'waktu_ujian' => $this->request->getVar('waktu_ujian'),
        ];
        // END DATA UJIAN

        // DATA DETAIL UJIAN PG
        $nama_soal = $this->request->getVar('nama_soal');
        $data_detail_ujian = array();
        $index = 0;
        foreach ($nama_soal as $nama) {
            array_push($data_detail_ujian, array(
                'kode_ujian' => $kode_ujian,
                'nama_soal' => $nama,
                'pg_1' => 'A. ' . $this->request->getVar('pg_1')[$index],
                'pg_2' => 'B. ' . $this->request->getVar('pg_2')[$index],
                'pg_3' => 'C. ' . $this->request->getVar('pg_3')[$index],
                'pg_4' => 'D. ' . $this->request->getVar('pg_4')[$index],
                'pg_5' => 'E. ' . $this->request->getVar('pg_5')[$index],
                'jawaban' => $this->request->getVar('jawaban')[$index],
                'pembahasan' => $this->request->getVar('pembahasan')[$index],
            ));

            $index++;
        }
        // END DATA DETAIL UJIAN PG

        // Kirim Email Ke siswa
        $smtp = $this->SmtpModel->asObject()->first();

        if ($smtp->notif_ujian == 1) {
            $data_email_siswa = '';
            $mapel = $this->MapelModel->asObject()->find($this->request->getVar('mapel'));
            foreach ($siswa as $s) {
                $data_email_siswa .= $s->email . ',';
            }

            // KIRIM EMAIL
            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($data_email_siswa);

            $this->email->setSubject('UJIAN');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div
                        style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT</div>
                    <small style="color: #000;">V 1.0 by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo para peserta <br>
                        <span style="color: #000;">' . $guru->nama_guru . ' memposting Ujian baru</span></p>
                    <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                        <tr>
                            <td>Ujian</td>
                            <td> : ' . $this->request->getVar('nama_ujian') . '</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td> : ' . $mapel->nama_mapel . '</td>
                        </tr>
                        <tr>
                            <td>Mulai</td>
                            <td> : ' . $data_ujian['waktu_mulai'] . '</td>
                        </tr>
                        <tr>
                            <td>Berakhir</td>
                            <td> : ' . $data_ujian['waktu_berakhir'] . '</td>
                        </tr>
                    </table>
                    <br>
                    <a href="' . base_url('auth') . '"
                        style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                        In
                        Now!</a>
                </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            }
        }

        $this->UjianModel->save($data_ujian);
        $this->UjiandetailModel->insertBatch($data_detail_ujian);

        $waktu_ujian = [];
        foreach ($siswa as $su) {
            array_push($waktu_ujian, [
                'kode_ujian' => $kode_ujian,
                'nama_ujian' => $data_ujian['nama_ujian'],
                'siswa_id' => $su->id_siswa
            ]);
        }

        $this->WaktuujianModel->insertBatch($waktu_ujian);

        session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Ujian telah dibuat',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        return redirect()->to('app/ujian?pesan=success');
    }
    public function excel_pg()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $siswa = $this->SiswaModel->getAllbyKelas($this->request->getVar('e_kelas'));
        $guru = $this->GuruModel->asObject()->find(session()->get('id'));
        if (count($siswa) == 0) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Belum ada siswa dikelas ini',
                    type: 'error',
                    padding: '2em'
                    });
            ");
            return redirect()->to('app/ujian');
        }

        // DATA UJIAN
        $kode_ujian = random_string('alnum', 10);
        $data_ujian = [
            'kode_ujian' => $kode_ujian,
            'nama_ujian' => $this->request->getVar('e_nama_ujian'),
            'guru' => session()->get('id'),
            'kelas' => $this->request->getVar('e_kelas'),
            'mapel' => $this->request->getVar('e_mapel'),
            'date_created' => time(),
            'waktu_ujian' => $this->request->getVar('e_waktu_ujian'),
        ];
        // END DATA UJIAN


        // TANGKAP FILE EXCEL YANG DI UPLLOAD
        $file = $this->request->getFile('excel');
        // AMBIL EXTENSI EXCEL YANG DI UPLOAD
        $ekstensi = $file->getClientExtension();

        // JIKA EKSTENSINYA XLS BERARTI FORMAT EXCEL VERSI LAMA
        if ($ekstensi == 'xls') {
            $reader = new Xls();
        }
        // JIKA EKSTENSINYA XLSX BERARTI FORMAT EXCEL VERSI BARU
        if ($ekstensi == 'xlsx') {
            $reader = new Xlsx();
        }
        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($file);
        // SIMPAN DATA EXCEL KEDALAM VARIABLE $data DAN UBAH MENJADI ARRAY
        $data = $spreadsheet->getActiveSheet()->toArray();
        // LOOPING DATA EXCEL

        // DATA DETAIL UJIAN PG
        $nama_soal = $this->request->getVar('e_nama_soal');
        $data_detail_ujian = array();
        $index = 0;

        foreach ($data as $baris => $kolom) {
            // KARENA DI DALAM EXCELNYA MEMILIKI HEADER / JUDUL (contoh : nama | kelas | email)
            // MAKA SKIP BAGIAN JUDUL / BARIS PERTAMA
            if ($baris != 0) {
                // AMBDIL DATA DARI BARIS KEDUA DAN MENYIMPANNYA KEDALAM VARIABEL $data_detail_ujian
                if ($kolom[0] != null) {
                    array_push($data_detail_ujian, array(
                        'kode_ujian' => $kode_ujian,
                        'nama_soal' => $kolom[0],
                        'pg_1' => 'A. ' . $kolom[1],
                        'pg_2' => 'B. ' . $kolom[2],
                        'pg_3' => 'C. ' . $kolom[3],
                        'pg_4' => 'D. ' . $kolom[4],
                        'pg_5' => 'E. ' . $kolom[5],
                        'jawaban' => $kolom[6],
                    ));
                }
            }
        }

        // Kirim Email Ke siswa
        $data_email_siswa = '';
        $mapel = $this->MapelModel->asObject()->find($this->request->getVar('e_mapel'));
        $smtp = $this->SmtpModel->asObject()->first();
        if ($smtp->notif_ujian == 1) {
            foreach ($siswa as $s) {
                $data_email_siswa .= $s->email . ',';
            }

            // KIRIM EMAIL
            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($data_email_siswa);

            $this->email->setSubject('UJIAN');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div
                        style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT</div>
                    <small style="color: #000;">V 1.0 by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo para peserta <br>
                        <span style="color: #000;">' . $guru->nama_guru . ' memposting Ujian baru</span></p>
                    <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                        <tr>
                            <td>Ujian</td>
                            <td> : ' . $this->request->getVar('e_nama_ujian') . '</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td> : ' . $mapel->nama_mapel . '</td>
                        </tr>
                        <tr>
                            <td>Mulai</td>
                            <td> : ' . $data_ujian['waktu_mulai'] . '</td>
                        </tr>
                        <tr>
                            <td>Berakhir</td>
                            <td> : ' . $data_ujian['waktu_berakhir'] . '</td>
                        </tr>
                    </table>
                    <br>
                    <a href="' . base_url('auth') . '"
                        style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                        In
                        Now!</a>
                </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            }
        }

        $this->UjianModel->save($data_ujian);
        $this->UjiandetailModel->insertBatch($data_detail_ujian);

        $waktu_ujian = [];
        foreach ($siswa as $su) {
            array_push($waktu_ujian, [
                'kode_ujian' => $kode_ujian,
                'nama_ujian' => $data_ujian['nama_ujian'],
                'siswa_id' => $su->id_siswa
            ]);
        }

        $this->WaktuujianModel->insertBatch($waktu_ujian);
        session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Ujian telah dibuat',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        return redirect()->to('app/ujian?pesan=success');
    }
    public function lihat_ujian($kode_ujian)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['admin'] = $this->AdminModel->asObject()->first();

        $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        $data['detail_ujian'] = $this->UjiandetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        
        $data['siswa'] = $this->SiswaModel->getAllbyKelas($data['ujian']->kelas);
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));
        return view('admin/ujian/pg-lihat', $data);
    }
    public function pg_siswa($id_siswa, $kode_ujian)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        $data['detail_ujian'] = $this->UjiandetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        $data['siswa'] = $this->SiswaModel->asObject()->find(decrypt_url($id_siswa));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));

        $data['ujian_siswa'] = $this->UjiansiswaModel
            ->where('ujian', decrypt_url($kode_ujian))
            ->where('siswa', decrypt_url($id_siswa))
            ->get()->getResultObject();

        if (count($data['ujian_siswa']) <= 0) {
            session()->setFlashdata('pesan', "
                        swal({
                            title: 'Warning!',
                            text: 'Siswa ini tidak bisa mengikuti ujian dikarenakan akun terdaftar setelah ujian dibuat',
                            type: 'warning',
                            padding: '2em'
                            });
                        ");
            $url = 'app/lihat_ujian/' . $kode_ujian . '/' . encrypt_url(session()->get('id'));
            return redirect()->to($url);
        }

        $data['jawaban_benar'] = $this->UjiansiswaModel->benar(decrypt_url($kode_ujian), decrypt_url($id_siswa), 1);
        $data['jawaban_salah'] = $this->UjiansiswaModel->benar(decrypt_url($kode_ujian), decrypt_url($id_siswa), 0);
        $data['tidak_dijawab'] = $this->UjiansiswaModel->benar(decrypt_url($kode_ujian), decrypt_url($id_siswa), null);

        return view('admin/ujian/pg-siswa', $data);
    }
    public function cetak_nilai_pg($kode_ujian)
    {
        $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        $data['detail_ujian'] = $this->UjiandetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        $data['siswa'] = $this->SiswaModel->getAllbyKelas($data['ujian']->kelas);
        return view('admin/ujian/cetak-nilai-pg', $data);
    }
    // END = UJIAN PG

    // START = UJIAN ESSAY
    public function tambah_essay()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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

        $data['admin'] = $this->AdminModel->asObject()->first();

        $data['guru_kelas'] = $this->GurukelasModel->getALLByGuru(session()->get('id'));
        $data['guru_mapel'] = $this->GurumapelModel->getALLByGuru(session()->get('id'));
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));
        return view('admin/ujian/tambah_essay', $data);
    }
    public function tambah_essay_()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $siswa = $this->SiswaModel->getAllbyKelas($this->request->getVar('kelas'));
        if (count($siswa) == 0) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Belum ada siswa dikelas ini',
                    type: 'error',
                    padding: '2em'
                });
            ");
            return redirect()->to('app/ujian');
        }
        // DATA UJIAN
        $kode_ujian = random_string('alnum', 10);
        $data_ujian = [
            'kode_ujian' => $kode_ujian,
            'nama_ujian' => $this->request->getVar('nama_ujian'),
            'guru' => session()->get('id'),
            'kelas' => $this->request->getVar('kelas'),
            'mapel' => $this->request->getVar('mapel'),
            'date_created' => time(),
            'waktu_ujian' => $this->request->getVar('waktu_ujian'),
            'jenis_ujian' => 1
        ];
        // END DATA UJIAN


        // DATA DETAIL UJIAN ESSAY
        $nama_soal = $this->request->getVar('soal');
        $data_detail_essay = array();
        foreach ($nama_soal as $nama) {
            array_push($data_detail_essay, array(
                'kode_ujian' => $kode_ujian,
                'soal' => $nama,
            ));
        }
        // END DATA DETAIL UJIAN ESSAY

        // Kirim Email Ke siswa
        $data_email_siswa = '';
        $smtp = $this->SmtpModel->asObject()->first();
        if ($smtp->notif_ujian == 1) {
            $mapel = $this->MapelModel->asObject()->find($this->request->getVar('mapel'));
            foreach ($siswa as $s) {
                $data_email_siswa .= $s->email . ',';
            }

            // KIRIM EMAIL
            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($data_email_siswa);

            $this->email->setSubject('UJIAN ESSAY');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div
                        style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT</div>
                    <small style="color: #000;">V 1.0 by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo para peserta <br>
                        <span style="color: #000;">' . session()->get('nama') . ' memposting Ujian baru</span></p>
                    <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                        <tr>
                            <td>Ujian</td>
                            <td> : ' . $this->request->getVar('nama_ujian') . '</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td> : ' . $mapel->nama_mapel . '</td>
                        </tr>
                        <tr>
                            <td>Mulai</td>
                            <td> : ' . $data_ujian['waktu_mulai'] . '</td>
                        </tr>
                        <tr>
                            <td>Berakhir</td>
                            <td> : ' . $data_ujian['waktu_berakhir'] . '</td>
                        </tr>
                    </table>
                    <br>
                    <a href="' . base_url('auth') . '"
                        style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                        In
                        Now!</a>
                    </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            }
        }

        $waktu_ujian = [];
        foreach ($siswa as $su) {
            array_push($waktu_ujian, [
                'kode_ujian' => $kode_ujian,
                'nama_ujian' => $data_ujian['nama_ujian'],
                'siswa_id' => $su->id_siswa
            ]);
        }

        $this->UjianModel->save($data_ujian);
        $this->EssaydetailModel->insertBatch($data_detail_essay);
        $this->WaktuujianModel->insertBatch($waktu_ujian);

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Ujian telah dibuat',
                type: 'success',
                padding: '2em'
            });
        ");
        return redirect()->to('app/ujian?pesan=success');
    }
    public function lihat_essay($kode_ujian, $id_guru)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        $data['admin'] = $this->AdminModel->asObject()->first();
        $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        $data['essay_detail'] = $this->EssaydetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        $data['siswa'] = $this->SiswaModel->getAllbyKelas($data['ujian']->kelas);
        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));
        return view('admin/ujian/essay-lihat', $data);
    }
    public function essay_siswa($id_siswa, $kode_ujian)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }

        $essay_siswa = $this->EssaysiswaModel
            ->where('ujian', decrypt_url($kode_ujian))
            ->where('siswa', decrypt_url($id_siswa))
            ->get()->getResultObject();

        if (count($essay_siswa) <= 0) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Warning!',
                    text: 'Siswa ini tidak bisa mengikuti ujian dikarenakan akun terdaftar setelah ujian dibuat',
                    type: 'warning',
                    padding: '2em'
                });
            ");
            $url = '/app/lihat_essay/' . $kode_ujian . '/' . encrypt_url(session()->get('id'));
            return redirect()->to($url);
        }

        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['master'] = [
            'menu' => '',
            'expanded' => 'false',
            'collapse' => ''
        ];
        $data['sub_master'] = [
            'siswa' => '',
            'guru' => ''
        ];
        $data['menu_kelas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_mapel'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_relasi'] = [
            'menu' => '',
            'expanded' => 'false',
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
        $data['ujian'] = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));
        $data['essay_detail'] = $this->EssaydetailModel->getAllBykodeUjian(decrypt_url($kode_ujian));
        $data['essay_siswa'] = $essay_siswa;
        $data['siswa'] = $this->SiswaModel->asObject()->find(decrypt_url($id_siswa));

        $data['guru'] = $this->GuruModel->asObject()->find(session()->get('id'));
        return view('admin/ujian/essay-siswa', $data);
    }
    // public function nilai_essay()
    // {
    //     if (session()->get('role') != 3) {
    //         return redirect()->to('auth');
    //     }
    //     $kode_ujian = $this->request->getVar('kode_ujian');
    //     $siswa = $this->request->getVar('siswa');
    //     // $ujian = $this->db->get_where('ujian', ['kode_ujian' => $kode_ujian])->row();

    //     $essay_detail = $this->EssaysiswaModel
    //         ->where('ujian', $kode_ujian)
    //         ->where('siswa', $siswa)
    //         ->get()->getResultObject();

    //     foreach ($essay_detail as $ed) {
    //         $score = $this->request->getVar("$ed->id_essay_siswa");

    //         $this->EssaysiswaModel
    //             ->set('score', $score)
    //             ->where('id_essay_siswa', $ed->id_essay_siswa)
    //             ->update();
    //     }
    //     session()->setFlashdata('pesan', "
    //                     swal({
    //                         title: 'Berhasil!',
    //                         text: 'Ujian telah dinilai',
    //                         type: 'success',
    //                         padding: '2em'
    //                         });
    //                     ");
    //     return redirect()->to('guru/lihat_essay/' . encrypt_url($kode_ujian) . '/' . encrypt_url(session()->get('id')));
    // }
    public function nilai_essay()
    {
        if ($this->request->isAJAX()) {
            $this->EssaysiswaModel
                ->set('score', $this->request->getVar('nilai'))
                ->where('id_essay_siswa', $this->request->getVar('id'))
                ->update();

            return 'berhasil dinilai';
        }
    }
    public function cetak_nilai_essay($kode_ujian)
    {
        $data['ujian'] = $this->UjianModel->getBykodeAdmin($kode_ujian);
        $data['detail_ujian'] = $this->EssaydetailModel->getAllBykodeUjian($kode_ujian);
        $data['siswa'] = $this->SiswaModel->getAllbyKelas($data['ujian']->kelas);
        return view('admin/ujian/cetak-nilai-essay', $data);
    }
    // END = UJIAN ESSAY

    public function hapus_ujian($kode_ujian)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $ujian = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));

        if ($ujian->jenis_ujian == 1) {

            $this->EssaysiswaModel
                ->where('ujian', decrypt_url($kode_ujian))
                ->delete();

            $this->EssaydetailModel
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->delete();

            $this->WaktuujianModel
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->delete();

            $this->UjianModel
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->delete();
        }

        if ($ujian->jenis_ujian == null) {

            $this->UjiansiswaModel
                ->where('ujian', decrypt_url($kode_ujian))
                ->delete();

            $this->UjiandetailModel
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->delete();

            $this->WaktuujianModel
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->delete();

            $this->UjianModel
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->delete();
        }

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Ujian telah di hapus',
                type: 'success',
                padding: '2em'
            });
        ");
        return redirect()->to('app/ujian');
    }

    // END::UJIAN

    // START::SUMMERNOTE
    public function upload_summernote()
    {
        if (session()->get('role') != 1) {
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
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $src = $this->request->getVar('src');
        $file_name = str_replace(base_url() . '/', '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }
    // END::SUMMERNOTE

    // START::PUBLISH UJIAN

    public function publish_ujian($kode_ujian)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('auth');
        }
        $ujian = $this->UjianModel->getBykodeAdmin(decrypt_url($kode_ujian));

        if ($ujian->publish == 1) {
            $this->UjianModel
                ->set('publish', null)
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->update();
            
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'Ujian telah di hide',
                    type: 'success',
                    padding: '2em'
                });
            ");
        }

        if ($ujian->publish == null) {
            $this->UjianModel
                ->set('publish', 1)
                ->where('kode_ujian', decrypt_url($kode_ujian))
                ->update();
            
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Berhasil!',
                    text: 'Ujian telah di publish',
                    type: 'success',
                    padding: '2em'
                });
            ");
        }

        return redirect()->to('app/ujian');
    }

    // END::PUBLISH UJIAN
}
