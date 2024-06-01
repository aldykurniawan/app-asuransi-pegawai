@extends('emails.template')

@section('content')
    <table id="u_content_text_20" style="font-family:'Open Sans',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
        <tbody>
            <tr>
                <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:5px 50px 30px;font-family:'Open Sans',sans-serif;" align="left">
                    <div class="v-text-align" style="font-size: 14px; line-height: 160%; text-align: center; word-wrap: break-word;">
                        <p style="line-height: 160%;color: #fff !important;">
                            {!! $content !!}.
                        </p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
