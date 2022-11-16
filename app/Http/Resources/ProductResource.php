<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $product = [
            'idData' => $this->id,
            'tahun_pengundangan' => $this->year,
            'tanggal_pengundangan' => $this->determination_date,
            'jenis' => $this->category->title,
            'noPeraturan' => $this->rule_number,
            'judul' => $this->category->description . " Nomor " . $this->rule_number . " Tahun " . $this->year . " Tentang " . $this->title,
            'noPanggil' => "-",
            'singkatanJenis' => $this->category->short_title,
            'tempatTerbit' => "Suwawa",
            'penerbit' => "-", //untuk dokumen bertipe monografi
            'deskripsiFisik' => "-", //khusus untuk monografi/buku
            'sumber' => "-", //Lembar daerah atau menyesuaikan
            'subjek' => "-", //Kata kunci dari dokumen hukum
            'isbn' => "-", //khusus untuk monografi/buku
            'status' => $this->status(),
            'bahasa' => "Indonesia",
            'bidangHukum' => "-",
            'teuBadan' => "Gorontalo.Kabupaten Bone Bolango",
            'nomorIndukBuku' => "-",
            'fileDownload' => substr($this->file, 12, 100),
            'urlDownload' => "https://jdih.bonebolangokab.go.id/download/" . $this->file,
            'urlDetailPeraturan' => "https://jdih.bonebolangokab.go.id/produk/" . $this->slug . "%0A",
            'operasi' => 4,
            'display' => 1,
        ];

        return str_replace(array('[', ']'), '', $product);
    }
}
