<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;
use App\Models\Cashflow;
use Illuminate\Support\Facades\Session;

class PdfController extends Controller
{
    public function uploadFile(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10048', // Hanya menerima file PDF dengan ukuran maksimum 10MB
        ]);

        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path('uploadsPdf'), $pdfFileName);

            // Konversi PDF ke Text
            $pdfText = (new Pdf(__DIR__ . '/../../../poppler-22.04.0/Library/bin/pdftotext')
            )->setPdf(public_path('uploadsPdf/' . $pdfFileName))->text();

            // tanggal
            $patternTanggal = '/\d{2}\/\d{2}/';
            preg_match_all($patternTanggal, $pdfText, $matchesTanggal);
            $tanggal = $matchesTanggal[0];

            // keterangan
            $patternKeterangan = '/\d{2}\/\d{2} (.+)/';
            preg_match_all($patternKeterangan, $pdfText, $matchesKeterangan);
            $keterangan = $matchesKeterangan[0];

            // mutasi
            $patternMutasi = '/(\d+(?:,\d{3})*(?:\.\d+)?(?:\s?(?:CR|DB))?)/';
            preg_match_all($patternMutasi, $pdfText, $matchesMutasi);
            $mutasi = $matchesMutasi[0];

            // saldo
            $pattrenSaldo = '/(\d+(?:,\d{3})*(?:\.\d+)?)/';
            preg_match_all($pattrenSaldo, $pdfText, $matchesSaldo);
            $saldo = $matchesSaldo[0];

            $data = [];
            for ($i = 0; $i < count($tanggal); $i++) {
                $tgl = isset($tanggal[$i]) ? $this->convertToValidDate($tanggal[$i]) : '';
                $ket = isset($keterangan[$i]) ? $keterangan[$i] : '';
                $mut = isset($mutasi[$i]) ? $this->convertToValidDecimal($mutasi[$i]) : '';

                // Generate category_id secara acak, misalnya antara 1 dan 5
                $category_id = mt_rand(1, 4);

                // Generate type secara acak, true atau false
                $type = mt_rand(0, 1);


                $data[] = [
                    'category_id' => $category_id,
                    'title' => $ket,
                    'type' => $type,
                    'amount' => $mut,
                    'created_at' => $tgl,
                ];
            }
            Cashflow::insert($data);
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "File PDF Berhasil di Uploads"
            ]);
            return redirect()->back();
        }
        Session::flash("flash_notification", [
            "level" => "error",
            "message" => "Terjadi Kesalahan Pada Saat Mengunggah File Pdf"
        ]);
        return redirect()->back();
    }

    private function convertToValidDate($inputDate)
    {
        // Pecah tanggal menjadi bagian DD dan MM
        list($day, $month) = explode('/', $inputDate);

        // Set the year to 2023
        $year = 2021;

        // Ubah format ke 'YYYY-MM-DD'
        return date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    }


    private function convertToValidDecimal($inputValue)
    {
        $value = str_replace(',', '', $inputValue); // Menghilangkan koma jika ada


        // Mengonversi nilai menjadi string
        $stringValue = strval($value);

        // Tambahkan "00" di belakang jika hanya ada satu angka desimal
        if (strpos($stringValue, '.') !== false) {
            $parts = explode('.', $stringValue);
            if (strlen($parts[1]) == 1) {
                $stringValue .= '00';
            }
        } else {
            $stringValue .= '00';
        }

        $value2 = floatval($stringValue); // Mengonversi ke float (desimal)
        return $value2;
    }
}
