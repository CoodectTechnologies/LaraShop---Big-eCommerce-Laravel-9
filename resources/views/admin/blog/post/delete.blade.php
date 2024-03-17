<a href="#" onclick="event.preventDefault(); confirmDestroyPost('{{ $post->slug }}')" class="btn btn-light-danger btn-shadow ms-2">{{ __('Delete') }}</a>
@once
    @push('footer')
        <script>
            function confirmDestroyPost(slug){
                swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You will not be able to retrieve this record') }}",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> <span class='font-weight-bold'>{{ __('Yes, delete') }}</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i>  <span class='text-dark font-weight-bold'>{{ __('No, cancel') }}</span>",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', slug);
                    }
                });
            }
        </script>
    @endpush
@endonce
