<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            ajax: '<?= route_to('categories.get.all'); ?>',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name',
                },
                {
                    data: 'slug',
                },
                {
                    data: 'actions',
                },
            ],
        });
    });
</script>