@extends('layouts.dosen')

@section('content')
<!-- Memastikan Tailwind dimuat agar kelas styling button (bg-blue-600) bekerja -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto p-6 bg-white shadow-xl rounded-xl">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Input Klaim Metode</h2>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('klaim_metode.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Fakultas</label>
                <select name="fakultas_id" id="fakultas" class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="">Pilih Fakultas</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Departemen</label>
                <select name="departemen_id" id="departemen" class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="">Pilih Departemen</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Semester</label>
                <select name="semester_id" id="semester" class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="">Pilih Semester</option>
                    @foreach($semester as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_semester }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Mata Kuliah</label>
                <select name="mata_kuliah_id" id="mata_kuliah" class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="">Pilih Mata Kuliah</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Metode</label>
                <select name="metode_id" class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="">Pilih Metode</option>
                    @foreach($metode as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_metode }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" class="border border-gray-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" placeholder="Contoh: 2025/2026">
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <h3 class="font-bold text-xl mb-4 text-gray-700">Komponen Penilaian</h3>
        <div id="komponen-wrapper">
            <!-- Komponen awal -->
            <div class="flex flex-col md:flex-row gap-4 mb-3 items-center">
                <input type="text" name="komponen[nama][]" placeholder="Nama Komponen" class="border border-gray-300 rounded-lg p-3 flex-1 focus:ring-2 focus:ring-blue-500 transition duration-150">
                <input type="number" name="komponen[persentase][]" placeholder="Persentase (%)" class="border border-gray-300 rounded-lg p-3 w-full md:w-32 focus:ring-2 focus:ring-blue-500 transition duration-150">
            </div>
        </div>
        
        <!-- Tombol Tambah Komponen -->
        <button type="button" id="add-komponen" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md w-full md:w-auto block mt-4 transition duration-150 ease-in-out transform hover:scale-[1.02]">
            Tambah Komponen
        </button>

        <hr class="my-6 border-gray-300">

        <label class="block font-semibold mb-2 text-gray-700">Dokumen Pendukung (boleh lebih dari 1)</label>
        <input type="file" name="dokumen[]" multiple class="border border-gray-300 rounded-lg p-3 w-full mb-6">

        <!-- Tombol Simpan -->
        <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-xl w-full md:w-auto block mt-8 transition duration-150 ease-in-out transform hover:scale-[1.02]">
            Simpan Klaim Metode
        </button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // FUNGSI JAVASCRIPT UNTUK DROPDOWN DINAMIS (TIDAK BERUBAH)
    $('#fakultas').change(function(){
        let fakultas_id = $(this).val();
        // Cek jika fakultas_id kosong, kosongkan departemen
        if (!fakultas_id) {
            $('#departemen').html('<option value="">Pilih Departemen</option>');
            $('#mata_kuliah').html('<option value="">Pilih Mata Kuliah</option>');
            return;
        }

        $.get('/dosen/departemen/' + fakultas_id, function(data){
            let options = '<option value="">Pilih Departemen</option>';
            data.forEach(d => {
                options += `<option value="${d.id}">${d.nama_departemen}</option>`;
            });
            $('#departemen').html(options);
            $('#mata_kuliah').html('<option value="">Pilih Mata Kuliah</option>'); // Reset MK
        }).fail(function() {
            console.error("Gagal memuat departemen.");
        });
    });

    $('#departemen, #semester').change(function(){
        let departemen_id = $('#departemen').val();
        let semester_id = $('#semester').val();
        
        if(departemen_id && semester_id){
            $.get(`/dosen/mata-kuliah/${departemen_id}/${semester_id}`, function(data){
                let options = '<option value="">Pilih Mata Kuliah</option>';
                data.forEach(mk => {
                    options += `<option value="${mk.id}">${mk.nama_mk}</option>`;
                });
                $('#mata_kuliah').html(options);
            }).fail(function() {
                console.error("Gagal memuat mata kuliah.");
            });
        } else {
             $('#mata_kuliah').html('<option value="">Pilih Mata Kuliah</option>');
        }
    });

    // FUNGSI JAVASCRIPT UNTUK TAMBAH KOMPONEN (DITAMBAH TOMBOL HAPUS)
    $('#add-komponen').click(function(){
        $('#komponen-wrapper').append(`
            <div class="flex flex-col md:flex-row gap-4 mb-3 items-center komponen-item">
                <input type="text" name="komponen[nama][]" placeholder="Nama Komponen" class="border border-gray-300 rounded-lg p-3 flex-1 focus:ring-2 focus:ring-blue-500 transition duration-150">
                <input type="number" name="komponen[persentase][]" placeholder="Persentase (%)" class="border border-gray-300 rounded-lg p-3 w-full md:w-32 focus:ring-2 focus:ring-blue-500 transition duration-150">
                <button type="button" class="remove-komponen text-red-500 hover:text-red-700 p-2 rounded-full transition duration-150" aria-label="Hapus Komponen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>
        `);
    });

    // FUNGSI HAPUS KOMPONEN
    $('#komponen-wrapper').on('click', '.remove-komponen', function() {
        $(this).closest('.komponen-item').remove();
    });
</script>
@endsection