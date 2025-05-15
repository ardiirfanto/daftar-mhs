@extends('app')

@section('content')
    <div class="p-6 bg-white border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Detil Data Mahasiswa</h3>
        <p class="mt-1 text-gray-600">
            Halaman ini menampilkan detil data mahasiswa beserta informasi terkait biodata dan judul skripsi.
        </p>
        <div class="mt-6">
            <form action="{{ route('admin.mahasiswa.update') }}" method="post">
                @csrf
                <input name="id" value="{{ encrypt($mahasiswa->id) }}" type="hidden">
                <table class="table-auto w-full">
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2 font-bold">NIM</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">NAMA</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">EMAIL</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">PRODI</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->prodi->nama_prodi }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">FAKULTAS</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->prodi->fakultas->nama_fakultas }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">TAHUN MASUK</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->tahun_masuk }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">ALAMAT</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">NO.HP</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->no_hp }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">JUDUL SKRIPSI</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">DOSEN PEMBIMBING</td>
                            <td class="border px-4 py-2">{{ $mahasiswa->dosen_pembimbing }}</td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">STATUS</td>
                            <td class="border px-4 py-2">
                                <div class="flex flex-row gap-2">
                                    <div
                                        class="bg-{{ Render::status($mahasiswa->status_skripsi) }} text-xs text-center font-semibold rounded-xl py-1 px-1 w-[20%]">
                                        {{ ucwords(str_replace('_', ' ', $mahasiswa->status_skripsi)) }}
                                    </div>
                                    <select name="status_skripsi" class="border rounded-lg px-2 text-sm">
                                        <option {{ $mahasiswa->status_skripsi == 'belum_mulai' ? 'SELECTED' : '' }}
                                            value="belum_mulai">Belum Mulai</option>
                                        <option {{ $mahasiswa->status_skripsi == 'proposal' ? 'SELECTED' : '' }}
                                            value="proposal">Proposal</option>
                                        <option {{ $mahasiswa->status_skripsi == 'penelitian' ? 'SELECTED' : '' }}
                                            value="penelitian">Penelitian</option>
                                        <option {{ $mahasiswa->status_skripsi == 'sidang' ? 'SELECTED' : '' }}
                                            value="sidang">Sidang</option>
                                        <option {{ $mahasiswa->status_skripsi == 'selesai' ? 'SELECTED' : '' }}
                                            value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2 font-bold">TANGGAL SIDANG</td>
                            <td class="border px-4 py-2">
                                <input type="date" name="tanggal_sidang" id="tanggal_sidang"
                                    value="{{ $mahasiswa->tanggal_sidang }}">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="border px-4 py-2">
                                <button type="submit"
                                    class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-2 text-sm rounded">
                                    Simpan Perubahan
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
@endsection
