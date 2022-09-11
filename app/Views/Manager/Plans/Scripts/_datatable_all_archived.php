<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            ajax: '<?= route_to('plans.get.all.archived'); ?>',
            columns: [{
                    data: 'code'
                },
                {
                    data: 'name',
                },
                {
                    data: 'is_highlighted',
                },
                {
                    data: 'details',
                },
                {
                    data: 'actions',
                },
            ],
        });
    });
</script>