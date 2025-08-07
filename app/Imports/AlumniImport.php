<?php

namespace App\Imports;

use App\Models\Alumni;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AlumniImport implements
    ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsEmptyRows,
    WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            // Pisahkan tempat dan tanggal lahir jika TTL format: "Kota, YYYY-MM-DD"
            [$tempat, $tanggal] = $this->parseTTL($row['ttl'] ?? '');

            Alumni::updateOrCreate(
                ['nis' => $row['nis']], // Kriteria unik (ganti kalau perlu pakai ID atau kombinasi lain)
                [
                    'nama'          => $row['nama'],
                    'sex'           => $this->mapJenisKelamin($row['sex'] ?? null),
                    'ttl'           => $tempat . ',' . $tanggal,
                    'bin'           => $row['bin'] ?? null,
                    'tahun_lulus'   => $row['thn'],
                    'kelas'         => $row['kelas'] ?? null,
                    'status'        => $row['status'] ?? null,
                ]
            );
        }
    }

    public function rules(): array
    {
        return [
            '*.nama'        => 'required|string|max:255',
            '*.thn'         => 'required|numeric',
            '*.sex'         => 'nullable|string|in:L,P,Laki-laki,Perempuan',
            '*.ttl'         => 'nullable|string', // Validasi parsial
        ];
    }

    public function chunkSize(): int
    {
        return 500; // Sesuaikan dengan kapasitas server kamu
    }

    private function mapJenisKelamin($value)
    {
        return match (strtolower($value)) {
            'l', 'laki-laki' => 'L',
            'p', 'perempuan' => 'P',
            default => null,
        };
    }

    private function parseTTL(string $ttl): array
    {
        $parts = explode(',', $ttl, 2);
        $tempat = trim($parts[0] ?? '');
        $tanggal = isset($parts[1]) ? trim($parts[1]) : null;

        // Format tanggal ke Y-m-d jika memungkinkan
        if ($tanggal) {
            try {
                $tanggal = \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
            } catch (\Exception $e) {
                $tanggal = null; // Abaikan jika format salah
            }
        }

        return [$tempat, $tanggal];
    }
}
