<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SmtpModel;
use App\Models\TokenModel;

class Auth extends BaseController
{
    protected $AdminModel;
    protected $SiswaModel;
    protected $GuruModel;
    protected $KelasModel;
    protected $SmtpModel;
    protected $TokenModel;

    public function __construct()
    {
        $validation = \Config\Services::validation();
        $this->AdminModel = new AdminModel();
        $this->SiswaModel = new SiswaModel();
        $this->GuruModel = new GuruModel();
        $this->KelasModel = new KelasModel();
        $this->SmtpModel = new SmtpModel();
        $this->TokenModel = new TokenModel();
        date_default_timezone_set('Asia/Jakarta');

        $this->email = \Config\Services::email();
    }

    public function index()
    {
        $data['admin'] = $this->AdminModel->asObject()->first();

        return view('auth', $data);
    }
    public function login_()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cek Siswa
        $siswa = $this->SiswaModel->getByEmail($email);
        if ($siswa != null) {
            if (password_verify($password, $siswa->password)) {
                // Jika Password Benar
                if ($siswa->is_active == 1) {
                    $data = [
                        'id' => $siswa->id_siswa,
                        'email' => $siswa->email,
                        'nama' => $siswa->nama_siswa,
                        'role' => $siswa->role,
                    ];
                    session()->set($data);
                    // Arahkan Ke halaman siswa
                    session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'Login Berhasil',
                            type: 'success',
                            padding: '2em'
                            })
                        ");
                    return redirect()->to('siswa');
                } else {
                    session()->setFlashdata('pesan', "
                        swal({
                            title: 'Oops!',
                            text: 'Login Gagal, Akun tidak aktif',
                            type: 'error',
                            padding: '2em'
                            })
                        ");
                    return redirect()->to('auth')->withInput();
                }
            } else {
                session()->setFlashdata('pesan', "
                        swal({
                            title: 'Oops!',
                            text: 'Login Gagal, Password salah',
                            type: 'error',
                            padding: '2em'
                            })
                        ");
                return redirect()->to('auth')->withInput();
            }
        } else {
            $guru = $this->GuruModel->getByEmail($email);
            // Cek Guru
            if ($guru != null) {

                if (password_verify($password, $guru->password)) {
                    // Jika Password Benar
                    if ($guru->is_active == 1) {
                        $data = [
                            'id' => $guru->id_guru,
                            'email' => $guru->email,
                            'nama' => $guru->nama_guru,
                            'role' => $guru->role,
                        ];
                        session()->set($data);
                        // Arahkan Ke halaman guru
                        session()->setFlashdata('pesan', "
                            swal({
                                title: 'Berhasil!',
                                text: 'Login Berhasil',
                                type: 'success',
                                padding: '2em'
                                })
                        ");
                        return redirect()->to('guru');
                    } else {
                        session()->setFlashdata('pesan', "
                            swal({
                                title: 'Oops!',
                                text: 'Login Gagal, Akun tidak aktif',
                                type: 'error',
                                padding: '2em'
                                })
                            ");
                        return redirect()->to('auth')->withInput();
                    }
                } else {
                    session()->setFlashdata('pesan', "
                        swal({
                            title: 'Oops!',
                            text: 'Login Gagal, Password salah',
                            type: 'error',
                            padding: '2em'
                            })
                        ");
                    return redirect()->to('auth')->withInput();
                }
            } else {
                $admin = $this->AdminModel->getbyemail($email);
                if ($admin != null) {
                    // Jika adminnya ada
                    // Cek Password
                    if (password_verify($password, $admin->password)) {
                        // Jika Password Benar
                        if ($admin->is_active == 1) {
                            $data = [
                                'id' => $admin->id_admin,
                                'email' => $admin->email,
                                'nama' => $admin->nama_admin,
                                'role' => $admin->role,
                            ];
                            session()->set($data);
                            // Arahkan Ke halaman admin
                            session()->setFlashdata('pesan', "
                                swal({
                                    title: 'Berhasil!',
                                    text: 'Login Berhasil',
                                    type: 'success',
                                    padding: '2em'
                                    })
                            ");
                            return redirect()->to('app');
                        } else {
                            session()->setFlashdata('pesan', "
                                swal({
                                    title: 'Oops!',
                                    text: 'Login Gagal, Akun tidak aktif',
                                    type: 'error',
                                    padding: '2em'
                                    })
                            ");
                            return redirect()->to('auth')->withInput();
                        }
                    } else {
                        session()->setFlashdata('pesan', "
                            swal({
                                title: 'Oops!',
                                text: 'Login Gagal, Password salah',
                                type: 'error',
                                padding: '2em'
                                })
                        ");
                        return redirect()->to('auth')->withInput();
                    }
                } else {
                    session()->setFlashdata('pesan', "
                        swal({
                            title: 'Oops!',
                            text: 'Login Gagal, Akun tidak ditemukan',
                            type: 'error',
                            padding: '2em'
                        })
                    ");
                    return redirect()->to('auth');
                }
            }
        }
    }

    public function install()
    {
        return view('install');
    }
    public function install_()
    {
        // CEK EMAIL
        $email = $this->request->getVar('email');

        $siswa = $this->SiswaModel->getByEmail($email);
        if ($siswa != null) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Gagal Disimpan, email sudah dipakai Siswa lain',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('auth/install');
        }

        $guru = $this->GuruModel->getByEmail($email);
        if ($guru != null) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Gagal Disimpan, email sudah dipakai Guru lain',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('auth/install');
        }

        $admin = $this->AdminModel->getbyemail($email);
        if ($admin) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Gagal Disimpan, email sudah dipakai Admin lain',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('auth/install');
        }

        $data_admin = [
            'nama_admin' => $this->request->getVar('nama_admin'),
            'email' => $email,
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'is_active' => 1,
            'date_created' => time(),
            'avatar' => 'default.jpg',
            'role' => 1,
            'pm' => $this->request->getVar('password')
        ];

        $this->AdminModel->save($data_admin);
        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'Admin Disimpan, Silahkan Login',
                type: 'success',
                padding: '2em'
                })
            ");
        return redirect()->to('auth');
    }

    public function register()
    {
        $data['kelas'] = $this->KelasModel->asObject()->findAll();

        return view('register', $data);
    }

    public function register_()
    {
        $email = $this->request->getVar('email');

        $siswa = $this->SiswaModel->getByEmail($email);
        if ($siswa != null) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Gagal Disimpan, email sudah dipakai Siswa lain',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('auth/register')->withInput();
        }

        $guru = $this->GuruModel->getByEmail($email);
        if ($guru != null) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Gagal Disimpan, email sudah dipakai Guru lain',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('auth/register')->withInput();
        }

        $admin = $this->AdminModel->getbyemail($email);
        if ($admin != null) {
            session()->setFlashdata('pesan', "
                swal({
                    title: 'Oops!',
                    text: 'Gagal Disimpan, email sudah dipakai Admin',
                    type: 'error',
                    padding: '2em'
                    })
                ");
            return redirect()->to('auth/register')->withInput();
        }
        
        // JIKA YANG DAFTAR ADALAH SISWA
        // if ($this->request->getVar('saya_siswa') != null) {

            $data_siswa = [
                // 'no_induk_siswa' => $this->request->getVar('no_induk'),
                'nama_siswa' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                // 'kelas' => $this->request->getVar('kelas'),
                'kelas' => 7,
                'role' => 2,
                'is_active' => 0,
                'date_created' => time(),
                'avatar' => 'default.jpg'
            ];

            $token = random_string('alnum', 32);
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // KIRIM EMAIL
            $smtp = $this->SmtpModel->asObject()->first();
            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($email);

            $this->email->setSubject('Aktivasi Akun');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT
                    </div>
                    <small style="color: #000;">V 1.0 by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $this->request->getVar('nama') . ' <br>
                        <span style="color: #000;">Anda telah Melakukan Pendaftaran ke UJIAN CBT sebagai PESERTA. Silahkan lakukan aktivasi dengan cara mengklik tombol aktivasi</span><br>
                        </p>
                    <a href="' . base_url() . '/auth/verify?email=' . $email . '&token=' . $token .  '" style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">
                        aktivasi        
                    </a>
                </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            } else {
                $this->TokenModel->save($user_token);
                $this->SiswaModel->save($data_siswa);
                session()->setFlashdata('pesan', "
                    swal({
                        title: 'Berhasil!',
                        text: 'Akun Disimpan, Silahkan Lakukan verifikasi via email',
                        type: 'success',
                        padding: '2em'
                    })
                ");
                return redirect()->to('auth');
            }
        // } else {
        //     // JIKA GURU YANG DAFTAR
        //     $data_guru = [
        //         'nama_guru' => $this->request->getVar('nama'),
        //         'email' => $this->request->getVar('email'),
        //         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        //         'role' => 3,
        //         'is_active' => 0,
        //         'date_created' => time(),
        //         'avatar' => 'default.jpg'
        //     ];
        //     // Siapkan token
        //     $token = random_string('alnum', 32);
        //     $user_token = [
        //         'email' => $email,
        //         'token' => $token,
        //         'date_created' => time()
        //     ];

        //     // KIRIM EMAIL
        //     $smtp = $this->SmtpModel->asObject()->first();
        //     $config['SMTPHost'] = $smtp->smtp_host;
        //     $config['SMTPUser'] = $smtp->smtp_user;
        //     $config['SMTPPass'] = $smtp->smtp_pass;
        //     $config['SMTPPort'] = $smtp->smtp_port;
        //     $config['SMTPCrypto'] = $smtp->smtp_crypto;
        //     $config['mailType'] = 'html';

        //     $this->email->initialize($config);

        //     $this->email->setNewline("\r\n");

        //     $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
        //     $this->email->setTo($email);

        //     $this->email->setSubject('Aktivasi Akun');
        //     $this->email->setMessage('
        //         <div style="color: #000; padding: 10px;">
        //             <div style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
        //                 UJIAN CBT
        //             </div>
        //             <small style="color: #000;">V 1.0 by Coding Center</small>
        //             <br>
        //             <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $this->request->getVar('nama') . ' <br>
        //                 <span style="color: #000;">Anda telah Melakukan Pendaftaran ke UJIAN CBT sebagai OPERATOR. Silahkan lakukan aktivasi dengan cara mengklik tombol aktivasi</span><br>
        //             </p>
        //             <a href="' . base_url() . '/auth/verify?email=' . $email . '&token=' . $token .  '" style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">
        //                 aktivasi        
        //             </a>
        //         </div>
        //     ');

        //     if (!$this->email->send()) {
        //         echo $this->email->printDebugger();
        //         die();
        //     } else {
        //         $this->TokenModel->save($user_token);
        //         $this->GuruModel->save($data_guru);
        //         session()->setFlashdata('pesan', "
        //             swal({
        //                 title: 'Berhasil!',
        //                 text: 'Akun Disimpan, Silahkan Lakukan verifikasi via email',
        //                 type: 'success',
        //                 padding: '2em'
        //             })
        //         ");
        //         return redirect()->to('auth');
        //     }
        // }
    }

    public function cek_no_induk()
    {
        if ($this->request->isAJAX()) {
            $no_induk = $this->request->getVar('no_induk');
            $siswa = $this->SiswaModel->getByNoInduk($no_induk);

            if ($siswa != null) {
                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function verify()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $akun = $this->SiswaModel->getByEmail($email);

        if ($akun != null) {
            $user = $this->SiswaModel->getByEmail($email);
        } else {
            $user = $this->GuruModel->getByEmail($email);
        }

        if ($user != null) {
            $user_token = $this->TokenModel->getByEmailAndToken($email, $token);
            if ($user_token != null) {
                // CEK APAKAH TOKEN SUDAH LEBIH DARI 1 HARI
                if (time() - $user_token->date_created < (60 * 60 * 24)) {

                    if ($user->role == 2) {
                        $this->SiswaModel
                            ->set('is_active', 1)
                            ->where('email', $email)
                            ->update();

                        $this->TokenModel->delete($user_token->id_user_token);

                        session()->setFlashdata(
                            'pesan',
                            "swal({
                                title: 'Berhasil!',
                                text: '" . $email . " Sudah aktif',
                                type: 'success',
                                padding: '2em'
                            })"
                        );
                        return redirect()->to('auth');
                    } else {
                        $this->GuruModel
                            ->set('is_active', 1)
                            ->where('email', $email)
                            ->update();

                        $this->TokenModel->delete($user_token->id_user_token);

                        session()->setFlashdata(
                            'pesan',
                            "swal({
                                title: 'Berhasil!',
                                text: '" . $email . " Sudah aktif',
                                type: 'success',
                                padding: '2em'
                            })"
                        );
                        return redirect()->to('auth');
                    }
                } else {

                    if ($user->role == 3) {
                        $this->GuruModel->delete($user->id_guru);
                    } else {
                        $this->SiswaModel->delete($user->id_siswa);
                    }
                    $this->TokenModel->delete($user_token->id_user_token);

                    session()->setFlashdata(
                        'pesan',
                        "swal({
                            title: 'Oops!',
                            text: 'Aktivasi gagal, Token Kadaluarsa!',
                            type: 'error',
                            padding: '2em'
                        })"
                    );
                    return redirect()->to('auth');
                }
            } else {
                session()->setFlashdata(
                    'pesan',
                    "swal({
                        title: 'Oops!',
                        text: 'Aktivasi gagal, Token salah!',
                        type: 'error',
                        padding: '2em'
                    })"
                );
                return redirect()->to('auth');
            }
        } else {
            session()->setFlashdata(
                'pesan',
                "swal({
                    title: 'Oops!',
                    text: 'Aktivasi gagal, email salah!',
                    type: 'error',
                    padding: '2em'
                })"
            );
            return redirect()->to('auth');
        }
    }

    public function recovery()
    {
        return view('forgot-password');
    }
    public function recovery_()
    {
        // CEK EMAIL
        $email = $this->request->getVar('email');

        // Cek email ke siswa
        $siswa = $this->SiswaModel->getByEmail($email);
        if ($siswa != null) {
            // Fungsi Siswa

            $token = random_string('alnum', 32);
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // KIRIM EMAIL
            $smtp = $this->SmtpModel->asObject()->first();
            $config['SMTPHost'] = $smtp->smtp_host;
            $config['SMTPUser'] = $smtp->smtp_user;
            $config['SMTPPass'] = $smtp->smtp_pass;
            $config['SMTPPort'] = $smtp->smtp_port;
            $config['SMTPCrypto'] = $smtp->smtp_crypto;
            $config['mailType'] = 'html';

            $this->email->initialize($config);

            $this->email->setNewline("\r\n");

            $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
            $this->email->setTo($email);

            $this->email->setSubject('Forgot Password');
            $this->email->setMessage('
                <div style="color: #000; padding: 10px;">
                    <div style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                        UJIAN CBT
                    </div>
                    <small style="color: #000;">V 1.0 by Coding Center</small>
                    <br>
                    <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $this->request->getVar('nama') . ' <br>
                        <span style="color: #000;">Klik Tombol dibawah ini untuk melanjutkan proses</span><br>
                        </p>
                    <a href="' . base_url() . '/auth/change_password?email=' . $email . '&token=' . $token .  '" style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">
                        resset Password        
                    </a>
                </div>
            ');

            if (!$this->email->send()) {
                echo $this->email->printDebugger();
                die();
            } else {
                $this->TokenModel->save($user_token);
                session()->setFlashdata('pesan', "
                    swal({
                        title: 'Berhasil!',
                        text: 'silahkan buka email untuk melanjutkan prosses',
                        type: 'success'
                    })
                ");
                return redirect()->to('auth');
            }
        } else {
            // Cek email ke Guru
            $guru = $this->GuruModel->getByEmail($email);
            if ($guru != null) {

                $token = random_string('alnum', 32);
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                // KIRIM EMAIL
                $smtp = $this->SmtpModel->asObject()->first();
                $config['SMTPHost'] = $smtp->smtp_host;
                $config['SMTPUser'] = $smtp->smtp_user;
                $config['SMTPPass'] = $smtp->smtp_pass;
                $config['SMTPPort'] = $smtp->smtp_port;
                $config['SMTPCrypto'] = $smtp->smtp_crypto;
                $config['mailType'] = 'html';

                $this->email->initialize($config);

                $this->email->setNewline("\r\n");

                $this->email->setFrom($smtp->smtp_user, 'UJIAN CBT');
                $this->email->setTo($email);

                $this->email->setSubject('Forgot Password');
                $this->email->setMessage('
                    <div style="color: #000; padding: 10px;">
                        <div style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                            UJIAN CBT
                        </div>
                        <small style="color: #000;">V 1.0 by Coding Center</small>
                        <br>
                        <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $this->request->getVar('nama') . ' <br>
                            <span style="color: #000;">Klik Tombol dibawah ini untuk melanjutkan proses</span><br>
                            </p>
                        <a href="' . base_url() . 'auth/change_password?email=' . $email . '&token=' . $token .  '" style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">
                            resset Password        
                        </a>
                    </div>
                ');

                if (!$this->email->send()) {
                    echo $this->email->printDebugger();
                    die();
                } else {
                    $this->TokenModel->save($user_token);
                    session()->setFlashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'silahkan buka email untuk melanjutkan prosses',
                            type: 'success'
                            })
                        ");
                    return redirect()->to('auth');
                }
            } else {
                // Cek email ke Guru
                session()->setFlashdata('pesan', "
                            swal({
                                title: 'Oops!',
                                text: 'Email tidak ditemukan',
                                type: 'error',
                                padding: '2em'
                                })
                            ");
                return redirect()->to('auth/recovery');
            }
        }
    }
    public function change_password()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $cek_user_token = $this->TokenModel->getByEmailAndToken($email, $token);

        if ($cek_user_token == null) {
            return redirect()->to('auth');
        }

        $data['email'] = $email;
        $data['token'] = $token;
        return view('reset-password', $data);
    }
    public function change_password_()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        $new_password = $this->request->getVar('password');
        $user = $this->SiswaModel->getByEmail($email);
        if ($user == null) {
            $user = $this->GuruModel->getByEmail($email);
        }

        if ($user != null) {
            $user_token = $this->TokenModel->getByEmailAndToken($email, $token);
            if ($user_token != null) {
                if (time() - $user_token->date_created < (60 * 60 * 24)) {
                    if ($user->role == 2) {
                        $this->SiswaModel
                            ->set('password', password_hash($new_password, PASSWORD_DEFAULT))
                            ->where('email', $email)
                            ->update();

                        $this->TokenModel->delete($user_token->id_user_token);

                        session()->setFlashdata(
                            'pesan',
                            "swal({
                                    title: 'Berhasil!',
                                    text: 'password diganti',
                                    type: 'success'
                                })"
                        );
                        return redirect()->to('auth');
                    } else {
                        $this->GuruModel
                            ->set('password', password_hash($new_password, PASSWORD_DEFAULT))
                            ->where('email', $email)
                            ->update();

                        $this->TokenModel->delete($user_token->id_user_token);

                        session()->setFlashdata(
                            'pesan',
                            "swal({
                                    title: 'Berhasil!',
                                    text: 'password diganti',
                                    type: 'success'
                                })"
                        );
                        return redirect()->to('auth');
                    }
                } else {

                    $this->TokenModel->delete($user_token->id_user_token);

                    session()->setFlashdata(
                        'pesan',
                        "swal({
                                title: 'Oops!',
                                text: 'Aktivasi gagal, Token Expired!',
                                type: 'error'
                            })"
                    );
                    return redirect()->to('auth');
                }
            } else {
                session()->setFlashdata(
                    'pesan',
                    "swal({
                            title: 'Oops!',
                            text: 'Aktivasi gagal, Token salah!',
                            type: 'error'
                        })"
                );
                return redirect()->to('auth');
            }
        } else {
            session()->setFlashdata(
                'pesan',
                "swal({
                        title: 'Oops!',
                        text: 'Aktivasi gagal, email salah!',
                        type: 'error',
                        padding: '2em'
                    })"
            );
            return redirect()->to('auth');
        }
    }

    public function logout()
    {
        session()->destroy();

        session()->setFlashdata('pesan', "
            swal({
                title: 'Berhasil!',
                text: 'berhasil logout',
                type: 'success',
                padding: '2em'
            })
        ");
        return redirect()->to('auth');
    }
}
