
        $(document).ready(function() {
            <?php $kelas = $this->db->get('kelas')->result(); ?>

            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // var ss = $(".select2-input").select2({
            //     tags: true,
            // });

            


            $('#datatable-table').DataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "tampilkan halaman _PAGE_ dari _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Cari Data...",
                    "sLengthMenu": "Hasil :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [
                    [-1, 5, 10, 25, 50],
                    ["All", 5, 10, 25, 50]
                ]
            });

            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    padding: '2em'
                }).then(function(result) {
                    if (result.value) {
                        document.location.href = href
                    }
                });
            });


            



            

            // END TAMBAH SOAL PG

            var oneUpload = new FileUploadWithPreview('fileMateri');
            var secondUpload = new FileUploadWithPreview('videoMateri');

            var oneUpload = new FileUploadWithPreview('e_fileMateri');
            var secondUpload = new FileUploadWithPreview('e_videoMateri');

            // END MATERI
        })