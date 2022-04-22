<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
// use App\Models\Modelberita;
// use App\Models\Modelfoto;
// use App\Models\Modelgallery;
// use App\Models\Modelstaf;
// use App\Models\Modelmapel;
// use App\Models\Modelguru;
// use App\Models\Modelkategori;
// use App\Models\Modelsiswa;
// use App\Models\Modelkelas;
// use App\Models\Modelkelulusan;
use App\Models\Modelkonfigurasi;
// use App\Models\Modelpengumuman;
// use App\Models\Modelspp;

// Tambahan Baru (Dipakai)
use App\Models\Modeluser;
use App\Models\Modelpeserta;
use App\Models\Modelprogram;
use App\Models\Modelprogrambayar;
use App\Models\Modelspp1;
use App\Models\Modelspp2;
use App\Models\Modelspp3;
use App\Models\Modelspp4;
use App\Models\Modelinfaq;
use App\Models\Modelbayarlain;
use App\Models\Modelbayarmodul;
use App\Models\Modelpesertakelas;
use App\Models\Modelprogramdata;
use App\Models\Modelpengajar;
use App\Models\Modellevel;
use App\Models\Modelkantor_cabang;
use App\Models\Modelbank;
use App\Models\Modellog;
use App\Models\Modelabsenpeserta;
use App\Models\Modelabsenpengajar;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'Tgl_indo'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();
		// $this->staf = new Modelstaf;
		// $this->mapel = new Modelmapel;
		// $this->guru = new Modelguru;
		// $this->siswa = new Modelsiswa($request);
		// $this->kelas = new Modelkelas;
		// $this->spp = new Modelspp($request);
		// $this->kategori = new Modelkategori;
		// $this->berita = new Modelberita;
		// $this->gallery = new Modelgallery;
		// $this->foto = new Modelfoto;
		// $this->pengumuman = new Modelpengumuman;
		// $this->kelulusan = new Modelkelulusan($request);
		$this->konfigurasi = new Modelkonfigurasi;
		$this->user = new Modeluser($request);
		$this->peserta = new Modelpeserta($request);
		$this->program = new Modelprogram;
		$this->program_bayar = new Modelprogrambayar;
		$this->spp1 = new Modelspp1;
		$this->spp2 = new Modelspp2;
		$this->spp3 = new Modelspp3;
		$this->spp4 = new Modelspp4;
		$this->infaq = new Modelinfaq;
		$this->bayar_lain = new Modelbayarlain;
		$this->bayar_modul = new Modelbayarmodul;
		$this->peserta_kelas = new Modelpesertakelas;
		$this->program_data = new Modelprogramdata;
		$this->pengajar = new Modelpengajar;
		$this->level = new Modellevel;
		$this->kantor_cabang = new Modelkantor_cabang;
		$this->bank = new Modelbank;
		$this->log = new Modellog;
		$this->absen_peserta = new Modelabsenpeserta;
		$this->absen_pengajar = new Modelabsenpengajar;
	}
}
