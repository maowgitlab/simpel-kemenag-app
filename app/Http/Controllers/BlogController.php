<?php

namespace App\Http\Controllers;

use App\Mail\ApplicantMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\ListService;
use App\Models\Media;
use App\Models\Service;
use App\Models\ServiceApplicant;
use App\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    protected $media, $category, $tag, $serviceApplicant, $listService, $service, $comment;

    public function __construct(Media $media, Category $category, Tag $tag, ServiceApplicant $serviceApplicant, ListService $listService, Service $service, Comment $comment)
    {
        $this->media = $media;
        $this->category = $category;
        $this->tag = $tag;
        $this->serviceApplicant = $serviceApplicant;
        $this->listService = $listService;
        $this->service = $service;
        $this->comment = $comment;
    }

    private function generateSuccessMessage($text)
    {
        return '<script>
            Swal.fire({
                title: "Berhasil!",
                text: "' . $text . '",
                icon: "success",
                showConfirmButton: true
            });
        </script>';
    }

    private function generateErrorMessage($text)
    {
        return '<script>
            Swal.fire({
                title: "Gagal!",
                text: "' . $text . '",
                icon: "error",
                showConfirmButton: true
            });
        </script>';
    }

    public function home(Request $request, $slug = null)
    {
        if (auth()->check()) {
            return back();
        }

        $search = $request->query('cari');
        $singleMedia = $request->query('media');
        $mediaByCategory = $request->query('kategori');

        $mediasQuery = $this->media->select('id', 'user_id', 'category_id', 'judul', 'slug', 'gambar', 'konten', 'created_at', 'jumlah_dibaca')->with(['category', 'tags', 'user', 'comments'])->latest();

        if ($singleMedia) {
            $viewed = $this->media->where('slug', $singleMedia)->firstOrFail();
            if (!session()->has('media_viewed_' . $viewed->id)) {
                $viewed->increment('jumlah_dibaca');
                session(['media_viewed_' . $viewed->id => true]);
            }
            $medias = $mediasQuery->where('slug', $singleMedia)->get();
        } else {
            if ($mediaByCategory) {
                $category = $this->category->where('slug', $mediaByCategory)->firstOrFail();
                if (!session()->has('category_viewed_' . $category->id)) {
                    $category->increment('jumlah_dibaca');
                    session(['category_viewed_' . $category->id => true]);
                }
                if ($category) {
                    $medias = $mediasQuery->where('category_id', $category->id)->paginate(5)->withQueryString();
                } else {
                    $medias = collect(); // Return empty collection or handle accordingly
                }
            } elseif ($search) {
                $medias = $mediasQuery->where('judul', 'LIKE', "%{$search}%")->paginate(5)->withQueryString();
            } else {
                $medias = $mediasQuery->take(7)->get();
            }
        }

        $categories = Category::select('id', 'nama_kategori', 'slug')->get();

        $trendingMedias = $this->media->select('id', 'category_id', 'judul', 'slug', 'created_at')
            ->orderByDesc('jumlah_dibaca')
            ->limit(5)
            ->get();

        $importantMedias = $this->media->select('id', 'category_id', 'judul', 'slug', 'gambar', 'konten')
            ->with(['category'])
            ->where('penting', 1)
            ->latest()
            ->take(4)
            ->get();

        $trendingCategoriesOne = $this->category->select('id', 'nama_kategori', 'slug')->with(['medias' => function ($query) {
            $query->select('user_id', 'category_id', 'judul', 'slug', 'gambar', 'konten', 'created_at', 'jumlah_dibaca')->orderByDesc('jumlah_dibaca')->limit(10);
        }])
            ->withCount('medias')
            ->orderByDesc('medias_count')
            ->first();

        $popularMedias = $this->media->select('id', 'category_id', 'judul', 'slug', 'created_at')->with(['category'])
            ->whereDate('created_at', '>=', now()->subMonth())
            ->orderByDesc('jumlah_dibaca')
            ->take(5)
            ->get();

        $latestMedias = $this->media->select('id', 'category_id', 'judul', 'slug', 'created_at', 'gambar')->with(['category'])
            ->latest()
            ->take(5)
            ->get();

        $tags = $this->tag->select('id', 'nama_tag')->orderByDesc('jumlah_dibaca')->get();

        $first = $medias->slice(0, 1);
        $second = $medias->slice(1, 3);
        $third = $medias->slice(4, 3);

        $category = $this->category->select('id', 'nama_kategori')->where('slug', $mediaByCategory)->first();

        $listServices = $this->listService->select('id', 'judul')->latest()->get();
        $services = $this->service->select('list_id', 'judul', 'file_sop', 'file_persyaratan')->with('list')->latest()->get();
        $serviceApplicants = session('serviceApplicants', collect());
        return view('blog.pages.home', compact(
            'first',
            'second',
            'third',
            'trendingMedias',
            'importantMedias',
            'trendingCategoriesOne',
            'categories',
            'medias',
            'popularMedias',
            'latestMedias',
            'tags',
            'category',
            'listServices',
            'services',
            'serviceApplicants',
        ));
    }

    public function serviceStatus(Request $request)
    {
        $data = $request->validate([
            'email_status' => 'required|email',
        ], [
            'email_status.required' => 'Email wajib diisi',
            'email_status.email' => 'Email tidak valid',
        ]);

        $serviceApplicants = $this->serviceApplicant->where('email', $data['email_status'])->latest()->get();

        if ($serviceApplicants->isEmpty()) {
            $message = $this->generateErrorMessage('Data yang Anda masukan tidak ditemukan.');
            return redirect()->route('home', [
                'layanan' => 'pelayanan-publik',
            ])->with('message', $message);
        }

        return redirect()->route('home', [
            'layanan' => 'pelayanan-publik',
        ])->with('serviceApplicants', $serviceApplicants);
    }

    public function getServicesByCategory($id)
    {
        $services = $this->service->where('list_id', $id)->get();
        return response()->json($services);
    }

    public function getServiceDetail($id)
    {
        $service = $this->service->find($id);
        return response()->json($service);
    }

    public function createNewApplicant(Request $request)
    {
        $isFilePersyaratanRequired = $request->post('is_file_persyaratan_required');
        $request->validate([
            'kategori_layanan' => 'required',
            'email' => 'required|email',
            'layanan' => 'required',
            'nama' => 'required',
            'pesan' => 'required',
            'file_persyaratan' => $isFilePersyaratanRequired == 1 ? 'required|mimes:pdf|max:1024' : '',
        ], [
            'kategori_layanan.required' => 'Kategori Layanan wajib dipilih',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'layanan.required' => 'Layanan wajib dipilih',
            'nama.required' => 'Nama wajib diisi',
            'pesan.required' => 'Pesan wajib diisi',
            'file_persyaratan.required' => 'File persyaratan wajib diisi',
            'file_persyaratan.mimes' => 'File persyaratan harus berupa PDF',
            'file_persyaratan.max' => 'File persyaratan maksimal 1 MB',
        ]);
        $faker = Faker::create();
        if ($request->hasFile('file_persyaratan')) {
            $data = $this->serviceApplicant->create([
                'kode_layanan' => $faker->unique->numerify('PLYN#####'),
                'list_id' => $request->post('kategori_layanan'),
                'service_id' => $request->post('layanan'),
                'nama' => $request->post('nama'),
                'email' => $request->post('email'),
                'pesan' => $request->post('pesan'),
                'status' => 'pending',
                'file_persyaratan' => $request->file('file_persyaratan')->store('file/persyaratan'),
            ]);
            Mail::to($data->email)->send(new ApplicantMail($data));
            $message = $this->generateSuccessMessage('Permohonan berhasil dibuat. Silahkan Periksa Status Secara berkala menggunakan Email.');
            // return response()->json(['msg' => $message], 200);
            return back()->with('message', $message);
        }
        $data = $this->serviceApplicant->create([
            'kode_layanan' => $faker->unique->numerify('PLYN#####'),
            'list_id' => $request->post('kategori_layanan'),
            'service_id' => $request->post('layanan'),
            'nama' => $request->post('nama'),
            'email' => $request->post('email'),
            'pesan' => $request->post('pesan'),
            'status' => 'pending',
        ]);
        Mail::to($data->email)->send(new ApplicantMail($data));
        $message = $this->generateSuccessMessage('Permohonan berhasil dibuat. Silahkan Periksa Status Secara berkala menggunakan Email.');
        // return response()->json(['msg' => $message], 200);
        return back()->with('message', $message);
    }

    public function detailApplicant(Request $request)
    {
        $kodeLayanan = $request->query('kode_layanan');
        $serviceApplicant = $this->serviceApplicant->with(['list', 'service'])->where('kode_layanan', $kodeLayanan)->first();

        if ($serviceApplicant) {
            return response()->json($serviceApplicant);
        }

        return response()->json(['error' => 'Data tidak ditemukan.'], 404);
    }

    public function sendComment(Request $request)
    {
        $data = $request->validate([
            'media_id' => 'required',
            'perangkat' => 'required',
            'komentar' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'komentar.required' => 'Komentar wajib diisi',
            'g-recaptcha-response.required' => 'Captcha dibutuhkan.',
            'g-recaptcha-response.captcha' => 'Validasi Captcha Gagal, Silahkan coba lagi.',
        ]);
        $this->comment->create($data);
        return back()->with('message', $this->generateSuccessMessage('Komentar berhasil dikirim.'));
    }

    public function setUniqueID()
    {
        $uniqueID = Cookie::get('uniqueID');
        if (!$uniqueID) {
            $uniqueID = strtoupper(bin2hex(random_bytes(3))); // Generate 6-character unique ID
            Cookie::queue('uniqueID', $uniqueID, 60 * 24 * 365); // Cookie untuk 1 tahun
        }
        return response()->json(['uniqueID' => $uniqueID]);
    }

    public function reportComment($id)
    {
        $comment = $this->comment->find($id);
        $comment->update(['spam' => 1]);
        return back()->with('message', $this->generateSuccessMessage('Komentar berhasil di laporkan.'));
    }

    public function feedback(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'email' => 'required|email',
        ]);

        \App\Models\Feedback::create([
            'email' => $validated['email'],
            'tipe_feedback' => $request->post('feedbackType'),
            'url' => $request->post('url'),
            'pesan' => $validated['message'],
        ]);

        return response()->json(['message' => 'Feedback submitted successfully.'], 200);
    }
}
