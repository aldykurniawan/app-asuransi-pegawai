@extends('pdf.layout')
@section('title', 'Laporan SI-GAP')
@section('style')
    <style>
        table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
        background-color: transparent;
        }

        table th, table td {
        padding: 0.75rem;
        vertical-align: top;
        border: 1px solid #dee2e6;
        }

        .table-active {
        background-color: #f8f9fa;
        }

        .text-center {
        text-align: center;
        }

        .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        }

        .bg-success {
        background-color: #28a745;
        }

        .bg-danger {
        background-color: #dc3545;
        }

        .badge.bg-success, .badge.bg-danger {
        color: #fff;
        }
        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }
        li {
            margin-bottom: 10px;
        }
        /* first li has margin-top */
        li:first-child {
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
<div class="text-center" style="margin-top: 5px; margin-bottom: 40px;">
    <h4>Laporan Penangan Laporan SI-GAP</h4>
</div>
<table style="width: 100%; border-collapse: collapse;">
    <thead style="background-color: #f8f9fa;">
        <tr>
            <th style="border: 1px solid #dee2e6; text-align: center; padding: 8px;">No</th>
            <th style="border: 1px solid #dee2e6; padding: 8px;">Pelapor</th>
            <th style="border: 1px solid #dee2e6; padding: 8px;">Tanggal Laporan</th>
            <th style="border: 1px solid #dee2e6; padding: 8px;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $index => $value)
        <tr>
            <td style="border: 1px solid #dee2e6; text-align: center; padding: 8px;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #dee2e6; vertical-align: middle; padding: 8px;text-align: center;">
                <b>{{ $value->warga->nama }}</b>
            </td>
            <td style="border: 1px solid #dee2e6; vertical-align: middle; padding: 8px;text-align: center;">
                {{ $value->tanggal_laporan }}
            </td>
            <td style="border: 1px solid #dee2e6; vertical-align: middle; padding: 8px;text-align: center;">
                @if($value->status == 'open')
                <span
                    style="background-color: #28a745; color: white; padding: .25em .6em; border-radius: .25rem;">Open</span>
                @else
                <span
                    style="background-color: #dc3545; color: white; padding: .25em .6em; border-radius: .25rem;">Close</span>
                @endif
            </td>
        </tr>
        @if($value->keterangan)
        <tr>
            <td colspan="4" class="px-4" style="border: 1px solid #dee2e6; padding: 8px;">
                <b>Keterangan</b>: {{ $value->keterangan }}
            </td>
        </tr>
        @endif
        @if(count($value->laporanposko) > 0)
        <tr>
            <td colspan="4" style="border: 1px solid #dee2e6; padding: 8px;">
                <div class="px-4">
                    Laporan telah diteruskan pada:
                    <ol class="px-4">
                        @foreach($value->laporanposko as $tanggapan)
                        <li>{{ $tanggapan->posko->nama }} jarak dari posko {{ $tanggapan->jarak }} meter</li>
                        @endforeach
                    </ol>
                </div>
            </td>
        </tr>
        @else
        {{-- <tr>
            <td colspan="4" style="border: 1px solid #dee2e6; text-align: center; padding: 8px;">
                Tidak Ada Aksi untuk laporan ini
            </td>
        </tr> --}}
        @endif
        @endforeach
    </tbody>
</table>
@endsection
