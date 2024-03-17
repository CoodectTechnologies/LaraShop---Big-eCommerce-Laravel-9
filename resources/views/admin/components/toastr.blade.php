<script>
    $(document).ready(function(){
        @if(session()->has('alert'))
            alertToastr('{{ session()->get("alert-type") }}', '{{ session()->get("alert") }}');
        @endif
        Livewire.on('alert', (type, alert) => {
            alertToastr(type, alert);
        });
    });
    
    function alertToastr(type, alert){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };  
        if(type == 'success')
            toastr.success(alert);
        else if(type == 'info')
            toastr.info(alert);
        else if(type == 'warning')
            toastr.warning(alert);
        else if(type == 'error')
            toastr.error(alert);
        else
            toastr.error('Tipo de alerta desconocida');
    }
    </script>