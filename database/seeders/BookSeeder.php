<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $fiksi = Category::where('name', 'Fiksi')->first()?->id ?? 1;
        $nonFiksi = Category::where('name', 'Non-Fiksi')->first()?->id ?? 2;
        $sains = Category::where('name', 'Sains')->first()?->id ?? 3;
        $sejarah = Category::where('name', 'Sejarah')->first()?->id ?? 4;
        $bisnis = Category::where('name', 'Bisnis')->first()?->id ?? 5;
        $selfHelp = Category::where('name', 'Self-Help')->first()?->id ?? 6;

        $books = [
            ['category_id' => $fiksi, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'isbn' => '978-979-073-381-2', 'publisher' => 'Bentang Pustaka', 'year' => 2005, 'pages' => 534, 'stock' => 5, 'description' => 'Novel pertama karya Andrea Hirata yang bercerita tentang kehidupan 10 anak dari keluarga miskin yang bersekolah di Belitung.'],
            ['category_id' => $fiksi, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'isbn' => '978-979-411-028-4', 'publisher' => 'Hasta Mitra', 'year' => 1980, 'pages' => 535, 'stock' => 3, 'description' => 'Novel pertama dari Tetralogi Buru yang mengisahkan kehidupan Minke di masa kolonial Belanda.'],
            ['category_id' => $fiksi, 'title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'isbn' => '978-979-073-517-5', 'publisher' => 'Bentang Pustaka', 'year' => 2006, 'pages' => 292, 'stock' => 4, 'description' => 'Sekuel dari Laskar Pelangi yang menceritakan petualangan Ikal dan Arai.'],
            ['category_id' => $fiksi, 'title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'isbn' => '978-979-229-164-2', 'publisher' => 'Gramedia', 'year' => 2009, 'pages' => 424, 'stock' => 3, 'description' => 'Novel tentang kehidupan santri di pondok pesantren yang penuh inspirasi.'],
            ['category_id' => $fiksi, 'title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'isbn' => '978-979-224-178-8', 'publisher' => 'Bentang Pustaka', 'year' => 2009, 'pages' => 444, 'stock' => 2, 'description' => 'Novel romantis yang mengisahkan Kugy dan Keenan yang memiliki mimpi besar.'],
            ['category_id' => $nonFiksi, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'isbn' => '978-0-735-21129-2', 'publisher' => 'Avery', 'year' => 2018, 'pages' => 320, 'stock' => 4, 'description' => 'Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'],
            ['category_id' => $selfHelp, 'title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'isbn' => '978-602-03-8144-5', 'publisher' => 'Kompas', 'year' => 2018, 'pages' => 320, 'stock' => 3, 'description' => 'Buku tentang filsafat Stoa yang dikemas dengan gaya modern dan relevan.'],
            ['category_id' => $sains, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'isbn' => '978-0-06-231609-7', 'publisher' => 'Harper', 'year' => 2014, 'pages' => 464, 'stock' => 2, 'description' => 'Sejarah singkat umat manusia dari zaman prasejarah hingga era modern.'],
            ['category_id' => $bisnis, 'title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'isbn' => '978-1-612-68017-5', 'publisher' => 'Plata Publishing', 'year' => 1997, 'pages' => 336, 'stock' => 4, 'description' => 'Buku tentang literasi keuangan yang membandingkan dua pola pikir tentang uang.'],
            ['category_id' => $sejarah, 'title' => 'Pulang', 'author' => 'Tere Liye', 'isbn' => '978-602-03-2453-4', 'publisher' => 'Republika', 'year' => 2015, 'pages' => 400, 'stock' => 3, 'description' => 'Novel tentang Bujang yang pulang ke kampung halamannya setelah bertahun-tahun merantau.'],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['title' => $book['title'], 'author' => $book['author']],
                $book
            );
        }
    }
}
