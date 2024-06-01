<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    @yield('title')
  </title>
  <style>
    @page {
      margin: 0px;
    }

    * {
      margin: 0;
      padding: 0;
    }

    body {
      margin: 1cm 2cm 2cm 2cm;
      padding: 0;
      font-size: 12pt;
      font-family: 'Times New Roman', Times, serif;
    }

    .text-left {
      text-align: left;
    }

    .table-head td {}

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right
    }

    .capital {
      text-transform: uppercase;
    }

    h3 {
      font-size: 15pt;
    }

    hr.double {
      border-top: 3px double #000;
    }

    .mb-1 {
      margin-bottom: 1cm;
    }

    .mb-half {
      margin-bottom: .5cm;
    }

    .ml-half {
      margin-left: .5cm;
    }

    .mt-1 {
      margin-top: 1cm;
    }

    .body {
      margin-top: 1cm;
    }

    .table-content td {
      padding: 5px;
    }

    .text-capital {
      text-transform: capitalize;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 1cm;
      right: 1cm;
      height: 70px;
      /** Extra personal styles **/
      color: rgb(120, 120, 120);
      text-align: left;
      font-size: 10pt;
    }


    .barcode {
      width: 110px;
      height: 110px;
    }

    .keterangan-tte {
      border: 2px solid #000;
      width: auto;
      height: 107px;
      font-size: 10pt;
    }


    .table-top td {
      padding: 1px;
      vertical-align: top;
    }

    .collapse {
      border-collapse: collapse;

    }

    .collapse tr td {
      border: 1px solid #000;
      padding: 3px;
    }
    .title1 {
      font-size: 16px;
      font-weight: 200 !important;
      margin-bottom: 5px;
    }
    .title2 {
      font-size: 14px;
      font-weight: bold !important;
      margin-bottom: 5px;
    }
    .title3{
      font-size: 12px;
      font-weight: 200 !important;
    }
    .divider {
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .table_panel {
      width: 100%;
      border-collapse: collapse;
    }
    .table_panel th {
      padding: 15px 5px;
      border-top: 0.8px solid #c0c0c0a9;
      vertical-align: top;
      font-size: 12px;
      font-weight: 400;
      /* color: #464646; */
      color: #000;
      text-align: left;
    }
    .border_th_manual {
      border: 0.8px solid #c0c0c0a9;
    }
    .table_panel td {
      border: 0.8px solid #c0c0c0a9;
      padding: 15px 5px;
      font-size: 10px;
      font-weight: 400;
      color: #000;
      text-align: left;
    }
    .mt-3 {
      margin-top: 20px;
    }
    .mt-5 {
      margin-top: 50px;
    }
    .border_top_th_manual {
      border-bottom: 0.8px solid #c0c0c0a9;
    }
    .font_ttd {
      font-size: 12px;
      font-weight: bold;
      color: #000;
    }
    .qr_code_not_found {
      color: #c0c0c0a9;
      font-size: 12px;
      font-weight: bold;
    }
    .displayWithoutWithheight {
      width: 0;
      height: 0;
      display: none !important;
    }
    .withOutborder {
      border: 0;
    }
    .withOutborder td {
      border: 0;
    }
    .withOutborder th {
      border: 0;
    }
    .border-top {
        border-top: 1px solid #b0aeae;
    }
  </style>
  @yield('style')
</head>

<body>
  <table width="100%" class="withOutborder">
    <tr>
        <td class="text-center">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/kutim.png'))) }}" width="80"
                alt="">
        </td>
        <td class="text-center" style="vertical-align: middle">
            <h3 class="capital title1">PEMERINTAH KABUPATEN KUTAI TIMUR</h3>
            <h3 class="capital title2">
                DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN
            </h3>
            <h3 class="capital title3">
                LAPORAN SI-GAP
            </h3>
        </td>
        <td class="text-center">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/sigap.png'))) }}" width="110"
                alt="">
        </td>
    </tr>
  </table>
  <div class="divider border-top" style="padding-bottom: 30px;"></div>
  @yield('content')

  {{-- <footer>
    <table width="100%">
      <tr>
        <td width="15%">
          <img src="{{ public_path('img/logo-bsre.png') }}" width="100" alt="">
        </td>
        <td>
          Dokumen Ini Ditandatangani Secara Elektronik Menggunakan Sertifikat Elektronik Yang Diterbitkan Oleh Balai
          Sertifikasi Elektronik (BSRE), Badan Siber dan Sandi Negara (BSSN)
        </td>
      </tr>
    </table>
  </footer> --}}
</body>

</html>
