<?php

namespace Database\Seeders;

use App\Models\ProfilBem;
use Illuminate\Database\Seeder;

class ProfilBemSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'nama_bem' => 'BEM Polbis',
            'nama_kampus' => 'Politeknik Bisnis Digital Indonesia',
            'periode' => '2025/2026',
            'ketua_bem' => 'Ketua BEM',
            'sambutan_ketua' => 'Dengan penuh semangat dan dedikasi, BEM Polbis hadir sebagai jembatan aspirasi seluruh mahasiswa Politeknik Bisnis Digital Indonesia. Kami berkomitmen untuk menciptakan lingkungan kampus yang aktif, kreatif, dan berdampak nyata bagi seluruh civitas akademika.',
            'visi' => 'Menjadi Badan Eksekutif Mahasiswa yang unggul, inovatif, dan berdaya saing dalam mewujudkan mahasiswa Politeknik Bisnis Digital Indonesia yang berkarakter, berprestasi, dan bermanfaat bagi masyarakat.',
            'misi_1' => 'Meningkatkan kualitas sumber daya mahasiswa melalui program-program pengembangan diri yang terstruktur dan berkelanjutan.',
            'misi_2' => 'Membangun komunikasi yang harmonis antara mahasiswa, dosen, dan civitas akademika untuk menciptakan lingkungan kampus yang kondusif.',
            'misi_3' => 'Mengembangkan kreativitas dan inovasi mahasiswa melalui kegiatan seni, budaya, dan kewirausahaan.',
            'misi_4' => 'Meningkatkan kepedulian sosial dan kontribusi nyata mahasiswa terhadap masyarakat sekitar.',
            'email' => 'bem@polbis.ac.id',
            'instagram' => 'https://instagram.com/bem_polbis',
            'youtube' => '',
            'tiktok' => '',
            'alamat' => 'Politeknik Bisnis Digital Indonesia',
            'telepon' => '',
            'sejarah' => 'BEM Polbis berdiri sebagai wadah organisasi kemahasiswaan di Politeknik Bisnis Digital Indonesia. Dibentuk atas dasar semangat kebersamaan dan tekad untuk memajukan kehidupan kampus, BEM Polbis terus bertumbuh dan berinovasi dalam setiap periode kepengurusannya.',
            'logo_bem' => '',
            'logo_kampus' => '',
            'foto_ketua' => '',
        ];

        foreach ($data as $key => $value) {
            ProfilBem::set($key, $value);
        }
    }
}
