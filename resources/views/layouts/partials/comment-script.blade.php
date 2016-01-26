<script>
    $(function(){
        $('.comment').on('keydown',function(e){
            if(e.ctrlKey && e.keyCode == 13)
            {
                $(this).closest('form').submit();
            }
        });
        $('.form-comment__post-btn').hide();
    });
</script>