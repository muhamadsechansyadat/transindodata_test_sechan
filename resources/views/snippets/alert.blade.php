@if ($message = Session::get('success'))
<script>
    iziToast.success({
        title: 'Success!',
        message: `{!! $message ?? 'Success' !!}`,
        position: 'topRight'
    });
</script>
@endif
@if ($message = Session::get('error'))
<script>
    iziToast.error({
        title: 'Error!',
        message: `{!! $message ?? 'Something went wrong!' !!}`,
        position: 'topRight'
    });
</script>
@endif
@if ($errors->any())
<script>
    iziToast.info({
        title: 'Info!',
        message: `{!! $message ?? 'Info' !!}`,,
        position: 'topRight'
    });
</script>
@endif
