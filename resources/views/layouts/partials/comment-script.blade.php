<script>
    $(function(){
        $('.comment').on('keydown',function(e){
            if(e.ctrlKey && e.keyCode == 13)
            {
                $(this).closest('form').submit();
            }
        });
    });
</script>