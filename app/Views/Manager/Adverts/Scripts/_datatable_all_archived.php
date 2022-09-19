<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "pagingType": 'numbers',
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            ajax: '<?= route_to('get.archived.manager.adverts'); ?>',
            columns: [{
                    data: 'title',
                },
                {
                    data: 'code',
                },
                {
                    data: 'actions',
                },
            ],
        });
    });
</script>