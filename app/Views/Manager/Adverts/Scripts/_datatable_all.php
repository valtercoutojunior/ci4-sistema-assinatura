<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "pagingType": 'numbers',
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            ajax: '<?= route_to('get.all.my.adverts'); ?>',
            columns: [{
                    data: 'image'
                },
                {
                    data: 'title',
                },
                {
                    data: 'code',
                },
                {
                    data: 'category',
                },
                {
                    data: 'is_published',
                },
                {
                    data: 'address',
                },
                {
                    data: 'actions',
                },
            ],
        });
    });
</script>