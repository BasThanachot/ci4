<div class="flex items-center gap-[30px] mr-[30px] bg-red-600">
    <div id="btn_main_orderlist" class="px-2.5 py-1 cursor-pointer">
        <i class="fas fa-wrench"></i>
    </div>

    <div class="px-2.5 py-1 cursor-pointer">
        <i class="fas fa-wrench"></i>
    </div>
</div>
<script>
    $('#btn_main_orderlist').click(function() {
        $.post("<?php echo site_url('module/lab/main'); ?>", 
            { bdiv: 'main_content' }, function(data) 
        {
            $("div#main_content").html(data);
        });
    });
</script>