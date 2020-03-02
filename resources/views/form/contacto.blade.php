<!DOCTYPE html>
<html>
<body>
    @foreach( $elementos AS $k => $v )
    @isset( $$k )
    <p><strong>{{ $v }}:</strong> {{ $$k }}</p>
    @endisset
    @endforeach
</body>
</html>