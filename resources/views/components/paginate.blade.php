<div>
    <select id="paginator" name="paginate" class="p-5">
        <option value="5">select pagination</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
    </select>
    <script>
        $(document).ready(function(){
            var url = new URL(window.location.href);
            $("#paginator").on('change', function() {
                paginate = this.value;
                url.searchParams.set('paginate', paginate);
                window.location.replace(url.href);
            });
        });
    </script>
</div>
