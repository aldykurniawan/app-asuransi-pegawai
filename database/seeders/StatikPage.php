<?php

namespace Database\Seeders;

use App\Models\DataMaster\Statik;
use Illuminate\Database\Seeder;

class StatikPage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Statik::create([
        //     'title'   => 'statik Kasir',
        //     'slug'    => 'statik-kasir',
        //     'status'  => 'kasir',
        //     'content' => [
        //         'tentang_kami' => [
        //             'type'    => 'texteditor',
        //             'content' => "<h2>Apakah Lorem Ipsum itu?<\/h2><p><br><\/p><p class=\"ql-align-justify\"><strong>Lorem Ipsum<\/strong>&nbsp;Adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.<\/p><p><br><\/p><h2>Mengapa kita menggunakannya?<\/h2><p><br><\/p><p class=\"ql-align-justify\">Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya. Maksud penggunaan Lorem Ipsum adalah karena ia kurang lebih memiliki penyebaran huruf yang normal, ketimbang menggunakan kalimat seperti \"Bagian isi disini, bagian isi disini\", sehingga ia seolah menjadi naskah Inggris yang bisa dibaca. Banyak paket Desktop Publishing dan editor situs web yang kini menggunakan Lorem Ipsum sebagai contoh teks. Karenanya pencarian terhadap kalimat \"Lorem Ipsum\" akan berujung pada banyak situs web yang masih dalam tahap pengembangan. Berbagai versi juga telah berubah dari tahun ke tahun, kadang karena tidak sengaja, kadang karena disengaja (misalnya karena dimasukkan unsur humor atau semacamnya)<\/p><p><br><\/p>",
        //         ],
        //         'alamat' => [
        //             'type'    => 'text',
        //             'content' => 'Jl. Raya Jember No. 1',
        //         ],
        //         'no_hp' => [
        //             'type'    => 'text',
        //             'content' => '08123456789',
        //         ],
        //         'email' => [
        //             'type'    => 'text',
        //             'content' => 'kasir@',
        //         ],
        //     ],
        // ]);
    }
}
