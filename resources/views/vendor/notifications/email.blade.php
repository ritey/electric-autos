@extends('layouts.email')

@section('subject')
@if (! empty($greeting))
    {{ $greeting }}
@else
    @if ($level == 'error')
        Whoops!
    @else
        Hello!
    @endif
@endif
@endsection

@section('content')
    <!-- Intro -->
    @foreach ($introLines as $line)
        <p>
            {{ $line }}
        </p>
    @endforeach

    <!-- Action Button -->
    @if (isset($actionText))
        <table align="center" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <?php
                        switch ($level) {
                            case 'success':
                                $actionColor = 'button--green';
                                break;
                            case 'error':
                                $actionColor = 'button--red';
                                break;
                            default:
                                $actionColor = 'button--blue';
                        }
                    ?>

                    <a href="{{ $actionUrl }}"
                        style="display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none; background-color: #22BC66;"
                        class="button"
                        target="_blank">
                        {{ $actionText }}
                    </a>
                </td>
            </tr>
        </table>
    @endif

    <!-- Outro -->
    @foreach ($outroLines as $line)
        <p>
            {{ $line }}
        </p>
    @endforeach

<!-- Salutation -->
<p>
    Regards,<br>{{ config('app.name') }}
</p>

<!-- Sub Copy -->
@if (isset($actionText))
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <p>
                    If you’re having trouble clicking the "{{ $actionText }}" button,
                    copy and paste the URL below into your web browser:
                </p>

                <p>
                    <a href="{{ $actionUrl }}" target="_blank">
                        {{ $actionUrl }}
                    </a>
                </p>
            </td>
        </tr>
    </table>
@endif

@endsection
