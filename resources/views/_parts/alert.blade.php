<!-- フェードインアラート -->
@php $session_alerts = [ 'alert-primary','alert-success','alert-info','alert-warning','alert-danger' ]; @endphp
@foreach ($session_alerts as $alert_name)

    @if ( session( $alert_name ) )
        <div class="fadein-alert-box">
            <div class="container-1200">
                <p class="alert {{ $alert_name }} alert-dismissible text-dark fade show" role="alert">
                    {!! nl2br( e( session( $alert_name ) ) ) !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </p>
            </div>
        </div>
    @endif

@endforeach
